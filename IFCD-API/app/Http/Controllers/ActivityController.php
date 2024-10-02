<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Arrondissement;
use App\Models\Chaine;
use App\Models\Commune;
use App\Models\Department;
use App\Models\Domaine;
use App\Models\EventName;
use App\Models\Juridique;
use App\Models\Maillon;
use App\Models\Pay;
use App\Models\Position;
use App\Models\Village;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function activities()
    {

        $users = Activity::with(['user', 'actors'])->orderBy('id', 'desc')->paginate(6);


        return response()->json([ 
            'activities' => $users,
        ]);

    }

    public function utilities()
    {

        $pays = Pay::select('name')->orderBy('id', 'desc')->get();
        $chaines = Chaine::select('name')->orderBy('id', 'desc')->get();
        $domaines = Domaine::select('name')->orderBy('id', 'desc')->get();
        $communes = Commune::select('name')->orderBy('id', 'desc')->get();
        $departs = Department::select('name')->orderBy('id', 'desc')->get();
        $events = EventName::select('name')->orderBy('id', 'desc')->get();


        return response()->json([ 
            'pays' => $pays,
            'chaines' => $chaines,
            'domaines' => $domaines,
            'departs' => $departs,
            'events' => $events,
            'communes' => $communes
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
        $actor = Activity::where('id', $request->id)->update([
            'state' => $request->state,
        ]);

        // Optionally, you can return the updated company
        return response()->json([
            'activity' => $actor
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'titre' => 'required|string',
            'objectif' => 'required|string',
            'type' => 'required|string',
            'domaine' => 'required|string',
            'pays' => 'required|string',
            'etat' => 'required|string',
            'commune' => 'required|string',
            'bassin' => 'required|string',
            'date' => 'required|date',
            'lieu' => 'required|string',
        ]);

        // Création de l'activité avec les nouveaux attributs
        $activity = Activity::create([
            'titre' => $request->titre,
            'objectif' => $request->objectif,
            'type' => $request->type,
            'domaine' => $request->domaine,
            'picture' => $request->picture,
            'pays' => $request->pays,
            'etat' => $request->etat,
            'commune' => $request->commune,
            'bassin' => $request->bassin,
            'date' => $request->date,
            'lieu' => $request->lieu,
            'user_id' => $user->id
        ]);

        // Récupération des activités avec relations
        $compagnies = Activity::with(['user', 'actors'])
            ->orderBy('id', 'desc')
            ->paginate(6);

        return response()->json([
            'activities' => $compagnies
        ]);
    }


   


    // Mettre à jour les informations d'un utilisateur par son ID
    public function update(Request $request)
    {
        $user = Activity::with(['user', 'actors'])->find($request->id);
        $dataToUpdate = $request->except(['id', 'user', 'actors' ,'created_at', 'updated_at']); // Exclure 'user'
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
        $user = Activity::find($request->id);
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
          $request->photo->move(public_path('/images/activities/photo'), $picName);
    
          // Générez le lien complet de l'image
    
    
          return response()->json(['image_url' => "/images/activities/photo/$picName"]);
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
            return Activity::with(['user', 'actors'])->orderBy('id','desc')->where('name', 'like', '%'.$name.'%' )->get();
        }

        public function show($id)
        {
            $user = Activity::with(['user', 'actors'])->find($id);
            if ($user) {
                return response()->json(['user' => $user]);
            } else {
                return response()->json(['message' => 'User not found']);
            }
        }

}
