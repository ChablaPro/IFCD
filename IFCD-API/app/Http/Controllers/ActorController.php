<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Compagny;
use App\Models\User;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function actors()
    {
        $users = Actor::with(['organisation', 'user'])->orderBy('id', 'desc')->paginate(6);


        return response()->json([ 
            'users' => $users,
        ]);
    }

    public function utilities()
    {
        $users = Compagny::orderBy('id', 'desc')->get();


        return response()->json([ 
            'compagnies' => $users,
        ]);
    }

    public function validated(Request $request)
    {
        // Validate the request
        $request->validate([
            "id" => 'required', // Validate that ID exists
            "state" => 'required', // Ensure state is provided
        ]);

        // Update the company's state
        $actor = Actor::where('id', $request->id)->update([
            'state' => $request->state,
        ]);

        // Optionally, you can return the updated company
        return response()->json([
            'actor' => $actor
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name' => 'required',
            'avatar' => 'required',
            'genre' => 'required',
            'age' => 'required',
            'langue' => 'required',
            'niveau' => 'required',
            'compagny_id' => 'required',
            'compagny_id.*' => 'exists:compagnies,id'
        ]);

        $user = Actor::create([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'genre' => $request->genre,
            'age' => $request->age,
            'langue' => $request->langue,
            'niveau' => $request->niveau,
            'compagny_id' => $request->compagny_id,
            'user_id' => $user->id,
        ]);
        // Récupérer l'utilisateur avec ses relations
        //$user = Actor::with('organisation','user')->where('id', $user->id)->first();

        $compagnies = Actor::with(['organisation','user']) // Include user_id in the select statement
        ->orderBy('id', 'desc')
        ->paginate(6);
        return response()->json([
            'users' => $compagnies
        ]);
    }

   


    // Mettre à jour les informations d'un utilisateur par son ID
    public function update(Request $request)
    {
        $user = Actor::with(['organisation','user'])->find($request->id);
        $dataToUpdate = $request->except(['id', 'user', 'organisation' ,'created_at', 'updated_at']); // Exclure 'user'
        if ($user) {
            $user->update($dataToUpdate);
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // Supprimer un utilisateur par son ID
    public function delete(Request $request)
    {
        $user = Actor::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function upload(Request $request){
  
        $request->validate([
          'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Vous pouvez ajuster ces règles selon vos besoins
        ]);
    
        if ($request->hasFile('photo')) {
    
          $picName = time() . '.' . $request->photo->extension();
          $request->photo->move(public_path('/images/actors/avatar'), $picName);
    
          // Générez le lien complet de l'image
    
    
          return response()->json(['image_url' => "/images/actors/avatar/$picName"]);
        }
    
        return response()->json(['error' => 'Aucune image n\'a été téléchargée.'], 400);
      }


      public function deleteimg(Request $request, $hasFullPath = false){
            $request->validate([
                'photo'=>'required'
            ]);

            if (!$hasFullPath) {
                $filePath = public_path() .$request->photo;
            }

            if(file_exists($filePath)){
                @unlink($filePath);
            }

            return response()->json([
                'message' => 'The photo has been successfully deleted.'
            ]);
        }

        public function search($name){
            return Actor::with(['organisation','user'])->orderBy('id','desc')->where('name', 'like', '%'.$name.'%' )->get();
        }

        public function show($id)
        {
            $user = Actor::with(['organisation','user'])->find($id);
            if ($user) {
                return response()->json(['user' => $user]);
            } else {
                return response()->json(['message' => 'User not found']);
            }
        }


}
