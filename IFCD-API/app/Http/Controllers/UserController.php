<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\InscriptionMessage;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $exists = User::where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function createAdmin(Request $request)
    {
  
      //validation request
  
      $this->validate($request, [
        'name' => 'required',
        'email' => 'bail|required|email|unique:users',
        'password' => 'bail|required|min:6',
        'role_id' => 'required'
      ]);
  
      $password = bcrypt($request->password);
  
      $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => $password,
        'role_id' => $request->role_id,
        'pays'=>$request->pays
      ];
  
      // Vérifie si $request->photo n'est pas vide
      if ($request->photo !== null) {
        // Si $request->photo n'est pas vide, ajoutez-le aux données utilisateur
        $userData['photo'] = $request->photo;
      }
  
      $user = User::create($userData);
  
  
  
      return response()->json([
        'admin' => new UserResource($user)
      ]);
    }

    public function index()
    {
    
        $userD = User::with('role', 'compagnies')->orderBy('id', 'desc')->get();
        $user9D = User::with('role', 'compagnies')->orderBy('id', 'desc')->paginate(9);


        return response()->json([ 
            'usersD' => $userD,
            'user9D' => $user9D,
        ]);
    }

    public function getAdmins()
  {

    $admins = User::WhereNotNull('email')->orderBy('id', 'desc')->get();

    return response()->json([
      'admins' => UserResource::collection($admins)
    ]);
  }


   //Edit Admin
   public function editAdmin(Request $request)
   {
 
     $password = bcrypt($request->password);
 
     $role = Role::where('name', $request->role)->first();
 
     $userData = [
       'name' => $request->name,
       'email' => $request->email,
       'role_id' => $role->id,
       'pays'=>$request->pays
     ];
 
     // Ajouter le mot de passe seulement s'il est défini
     if ($request->filled('password')) {
         $userData['password'] = bcrypt($request->password);
     }
 
 
     // Vérifie si $request->photo n'est pas vide
     if ($request->photo) {
       // Si $request->photo n'est pas vide, ajoutez-le aux données utilisateur
       $userData['photo'] = $request->photo;
     }
 
 
     $user = User::where('id', $request->id)->update($userData);
 
 
 
     return response()->json([
       'user' => $user
     ]);
   }

   public function deleteAdmin(Request $request)
  {
    $this->validate($request, [
      'id' => 'required|exists:users,id'
    ]);

    $user = Auth::user();

    $userToDelete = User::find($request->id);
    
   /* $blogsS = Blog::where('user_id', $request->id)->get();

          if ($blogsS) {
              foreach($blogsS as $bls){
                $bls->update([
                  'user_id'=>$user->id
                ]);
            }
          }*/
    /*
          $newUser = User::where('name', 'Com F.G. OKE')->first();
      
          if ($newUser && $newUser->id !== $userToDelete->id) {
              // Mettez à jour les blogs associés au nouvel utilisateur
              $userToDelete->blogs()->update(['user_id' => $newUser->id]);
          } else {
              // Si le nouvel utilisateur n'est pas trouvé ou est le même que l'utilisateur à supprimer,
              // mettez à jour les blogs avec l'ID de l'utilisateur authentifié
              $userToDelete->blogs()->update(['user_id' => Auth()->user()->id]);
          }
      
          // Supprime tous les blogs associés à l'utilisateur à supprimer
          $userToDelete->blogs()->delete();*/

    // Supprime l'utilisateur
    $userToDelete->delete();

    return response()->json(['message' => 'Utilisateur supprimé avec succès']);
  }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'regex:/[!@#$%^&*(),.?":{}|<>]/' // Vérifie la présence de caractères spéciaux
            ],
            'role_id' => 'required|exists:roles,id',
            'compagny_id' => 'required|array',
            'compagny_id.*' => 'exists:compagnies,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;

        // Attacher les compagnies à l'utilisateur
        $user->compagnies()->attach($request->compagny_id);

        // Récupérer l'utilisateur avec ses relations
        $user = User::with('role', 'compagnies')->where('id', $user->id)->first();

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::with('role')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function searchUser($str)
    {
  
      if (!empty($str)) {
  
        $user = User::where('name', 'LIKE', "%{$str}%")->orderBy('id', 'desc')->get();
  
        return response()->json([
          'user' => UserResource::collection($user),
        ]);
      }
    }


    public function lignePro()
    {
        $user = Auth::user();
    
        if ($user) {
            // Join tables using the query builder
            $userInfo = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->join('settings', 'settings.id', '=', DB::raw('1')) // Assuming there's a single setting with id 1
                ->where('users.id', $user->id)
                ->select('users.*', 'roles.name as role_name', 'roles.add as role_add', 'roles.edit as role_edit', 'roles.remove as role_remove', 'roles.setting as role_setting', 'settings.roles as settings_roles')
                ->first();
    
            if ($userInfo) {
                // Decode the settings.roles JSON to include permissions
                $settingsRoles = json_decode($userInfo->settings_roles, true);
    
                // Filter to get the settings role that matches the user's role name
                $matchingRole = null;
                foreach ($settingsRoles as $role) {
                    if ($role['name'] === $userInfo->role_name) {
                        $matchingRole = $role;
                        break;
                    }
                }
    
                return response()->json([
                    'user' => [
                        'id' => $userInfo->id,
                        'name' => $userInfo->name,
                        'email' => $userInfo->email,
                        'email_verified_at' => $userInfo->email_verified_at,
                        'photo' => $userInfo->photo,
                        'role_id' => $userInfo->role_id,
                        'created_at' => $userInfo->created_at,
                        'updated_at' => $userInfo->updated_at,
                        'settings_roles' => $matchingRole // Return only the matching role
                    ]
                    /*'role' => [
                        'id' => $userInfo->role_id,
                        'name' => $userInfo->role_name,
                        'add' => $userInfo->role_add,
                        'edit' => $userInfo->role_edit,
                        'remove' => $userInfo->role_remove,
                        'setting' => $userInfo->role_setting,
                    ]*/
                ]);
            }
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }
    
    

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        } else {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
    }

    // Mettre à jour les informations d'un utilisateur par son ID
    public function update(Request $request, $id)
    {
        $user = User::with('role', 'compagnies')->find($id);
        if ($user) {
            $user->update($request->all());
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // Supprimer un utilisateur par son ID
    public function delete($id)
    {
        $user = User::find($id);
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
          $request->photo->move(public_path('/images/customer/photo'), $picName);
    
          // Générez le lien complet de l'image
    
    
          return response()->json(['image_url' => "/images/customer/photo/$picName"]);
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
            return User::with('role', 'compagnies')->orderBy('id','desc')->where('name', 'like', '%'.$name.'%' )->get();
        }

        public function show($id)
        {
            $user = User::with('role', 'compagnies')->find($id);
            if ($user) {
                return response()->json(['user' => $user]);
            } else {
                return response()->json(['message' => 'User not found']);
            }
        }

        public function online()
        {
            $userO = Auth::user();
            $user = User::with('role', 'compagnies')->find($userO->id);
            if ($user) {
                return response()->json(['user' => $user]);
            } else {
                return response()->json(['message' => 'User not found']);
            }
        }

}
