<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
  public function RoleRenitial(){
    // Récupérer tous les articles
    $blogs = Role::all();

    foreach ($blogs as $blog) {

       if ($blog->id != 1 && $blog->id != 2 &&  $blog->id != 3) {
          $blog->users()->delete();
          // Supprimer l'article
          $blog->delete();
       }
        
    }

    return response()->json([
        'message' => 'All blogs and associated images have been deleted successfully.'
    ]);
}
     
    //Ajout de Role d'un blog 

    public function addRole(Request $request)
    {
        //validate request
        $this->validate($request, [
            'name' => 'required'
        ]);

         $create = Role::create([
            'name' => $request->name 
        ]);

        $users = Role::orderBy('id', 'desc')->paginate(6);

        return response()->json([ 
            'roles' => $users,
        ]);


    }




    public function roles()
    {

        $users = Role::orderBy('id', 'desc')->paginate(6);

        return response()->json([ 
            'roles' => $users,
        ]);

    }






    //Affichage de Roles par ordre décroissant
    public function getRoles()
    {

        $roles= Role::orderBy('id', 'desc')->get();

        return response()->json([
            'roles' => RoleResource::collection($roles)
          ]);

    }



    //Affichage de Roles par ordre croissant
    public function getRolesO()
    {

        $roles= Role::orderBy('id', 'asc')->get();

        return response()->json([
            'roles' => $roles
          ]);

    }




     //Affichage d'un Role
     public function getRole($id)
     {
         $role= Role::where('id', $id)->first();

         return response()->json([
            'role' => $role
          ]);
     }



     
    //Modification de Role
    public function editRole(Request $request)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);

         
         $create = Role::where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'role' => $create
          ]);

    }



    //Suppression de Role
    public function deleteRole(Request $request)
    {

     Role::where('id', $request->id)->delete();

     return response()->json([
        'message' => "Role Supprimé avec succès"
      ]);

    }


    public function search($str)
    {
  
      if (!empty($str)) {
        
        $role = Role::where('name', 'LIKE', "%{$str}%")->orderBy('id', 'desc')->get();
  
        return response()->json([
          'role' => RoleResource::collection($role),
        ]);
  
      }
  
    }

}
