<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Compagny;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActorController extends Controller
{
    public function actors()
    {
        $users = Actor::with(['organisation', 'user', 'activities'])->orderBy('id', 'desc')->paginate(6);


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
        // Récupérer l'utilisateur connecté
        $user = $request->user();

        // Valider les champs
        $request->validate([
            'name' => 'required',
            'avatar' => 'required',
            'genre' => 'required',
            'age' => 'required|integer',
            'langue' => 'required',
            'niveau' => 'required',
            'compagny_id' => 'required|exists:compagnies,id' // Ajout de la validation pour compagny_id
        ]);

        // Générer un code unique
        do {
            $code = 'IFDC' . Str::random(10);
        } while (Actor::where('code', $code)->exists());

        // Créer un nouvel acteur (user)
        $actor = Actor::create([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'genre' => $request->genre,
            'age' => $request->age,
            'langue' => $request->langue,
            'niveau' => $request->niveau,
            'superficie' => $request->superficie, 
            'handicap' => $request->handicap, 
            'occupation' => $request->occupation, 
            'nbrBetail' => $request->nbrBetail,
            'compagny_id' => $request->compagny_id, // Utilisation du bon champ
            'user_id' => $user->id,
            'code' => $code,  // Code unique
        ]);

        // Récupérer les acteurs paginés avec les relations
        $actors = Actor::with(['organisation', 'user', 'activities'])
            ->orderBy('id', 'desc')
            ->paginate(6);

        // Retourner la réponse JSON
        return response()->json([
            'users' => $actors
        ]);
    }



   


    // Mettre à jour les informations d'un utilisateur par son ID
    public function update(Request $request)
    {
        $user = Actor::with(['organisation','user' , 'activities'])->find($request->id);
        $dataToUpdate = $request->except(['id', 'user', 'organisation', 'activities' ,'created_at', 'updated_at']); // Exclure 'user'
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
            return Actor::with(['organisation','user' , 'activities'])->orderBy('id','desc')->where('name', 'like', '%'.$name.'%' )->get();
        }

        public function show($id)
        {
            $user = Actor::with(['organisation','user' , 'activities'])->find($id);
            if ($user) {
                return response()->json(['user' => $user]);
            } else {
                return response()->json(['message' => 'User not found']);
            }
        }


}
