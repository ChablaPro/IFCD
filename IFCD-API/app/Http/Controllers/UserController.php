<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\InscriptionMessage;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

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
