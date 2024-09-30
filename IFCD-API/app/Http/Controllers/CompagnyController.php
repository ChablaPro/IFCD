<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use App\Models\Commune;
use App\Models\Compagny;
use App\Models\Department;
use App\Models\Juridique;
use App\Models\Maillon;
use App\Models\Position;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;

class CompagnyController extends Controller
{
    public function utilities()
    {
        $arrondissements = Arrondissement::select('name')->orderBy('id', 'desc')->get();
        $communes = Commune::select('name')->orderBy('id', 'desc')->get();
        $departs = Department::select('name')->orderBy('id', 'desc')->get();
        $juris = Juridique::select('name')->orderBy('id', 'desc')->get();
        $maillons = Maillon::select('name')->orderBy('id', 'desc')->get();
        $positions = Position::select('name')->orderBy('id', 'desc')->get();
        $villages = Village::select('name')->orderBy('id', 'desc')->get();

        return response()->json([
            'arrondissements' => $arrondissements,
            'communes' => $communes,
            'departs' => $departs,
            'juris' => $juris,
            'maillons' => $maillons,
            'positions' => $positions,
            'villages' => $villages,
        ]);
    }

    public function compagnies()
    {
        $compagnies = Compagny::with('user')->orderBy('id', 'desc')
            ->paginate(6);

        return response()->json([
            'compagnies' => $compagnies
        ]);
    }


    public function create(Request $request)
    {
        $user = $request->user();
        $request->validate([
            "user_id" => 'required',
            "typeOPA" => 'required',
            "addressOrg" => 'required',
            "nameOPAOrg" => 'required',
            "dateOPAOrg" => 'required',
            "contactOPAOrg" => 'required',
            "contactOrg" => 'required',
            "emailOrg" => 'required',
            "totalMemberOrg" => 'required',
            "totalMenOrg" => 'required',
            "totalWomenOrg" => 'required',
            "totalYMenOrg" => 'required',
            "totalYWomenOrg" => 'required',
            "serviceOrg" => 'required',
            "manageOPA" => 'required',
            "boardOPA" => 'required',
            "executiveOPA" => 'required',
            "commissionOPA" => 'required',
            "yearOrg" => 'required',
            "depOrg" => 'required',
            "comOrg" => 'required',
            "arrOrg" => 'required',
            "vilOrg" => 'required',
            "maiOrg" => 'required',
            "posOrg" => 'required',
            "newOPAOrg" => 'required',
        ]);


        Compagny::create([
            'year' => $request->yearOrg,
            'newOpa' => $request->newOPAOrg,
            'departement' => $request->depOrg,
            'arrondissement' => $request->arrOrg,
            'village' => $request->vilOrg,
            'adresse' => $request->addressOrg,
            'typeOpa' => $request->typeOPA,
            'juridique' => $request->jurOrg,
            'denominationOpa' => $request->nameOPAOrg,
            'dateCreaction' => $request->dateOPAOrg,
            'personneContact' => $request->contactOPAOrg,
            'contact' => $request->contactOrg,
            'courriel' => $request->emailOrg,
            'maillon' => $request->maiOrg,
            'totalMembre' => $request->totalMemberOrg,
            'nbrHomme' => $request->totalMenOrg,
            'nbrFemme' => $request->totalWomenOrg,
            'nbrJFemme' => $request->totalYWomenOrg,
            'nbrJHomme' => $request->totalYMenOrg,
            'services' => $request->serviceOrg,
            'position' => $request->posOrg,
            'gestionOpa' => $request->manageOPA,
            'administrationOpa' => $request->boardOPA,
            'surveillanceOpa' => $request->commissionOPA,
            'bureauOpa' => $request->executiveOPA,
            'user_id' => $user->id,
        ]);


        Department::firstOrCreate(['name' => $request->depOrg]);
        Commune::firstOrCreate(['name' => $request->comOrg]);
        Arrondissement::firstOrCreate(['name' => $request->arrOrg]);
        Village::firstOrCreate(['name' => $request->vilOrg]);
        Maillon::firstOrCreate(['name' => $request->maiOrg]);
        if ($request->jurOrg != "") {
            Juridique::firstOrCreate(['name' => $request->jurOrg]);
            Position::firstOrCreate(['name' => $request->posOrg]);
        }


        $compagnies = Compagny::with('user') // Include user_id in the select statement
            ->orderBy('id', 'desc')
            ->paginate(6);
        return response()->json([
            'compagnies' => $compagnies
        ]);
    }

    public function validated(Request $request)
    {
        // Validate the request
        $request->validate([
            "id" => 'required|integer|exists:compagnies,id', // Validate that ID exists
            "state" => 'required', // Ensure state is provided
        ]);

        // Update the company's state
        $compagny = Compagny::where('id', $request->id)->update([
            'state' => $request->state,
        ]);

        // Optionally, you can return the updated company
        return response()->json([
            'compagny' => $compagny,
        ]);
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            "id" => 'required|integer|exists:compagnies,id', // Validate that ID exists
            // Add other validation rules for the fields that can be updated
        ]);

        // Exclure les clés qui ne doivent pas être mises à jour
        $dataToUpdate = $request->except(['id', 'user', 'created_at', 'updated_at']); // Exclure 'user'

        // Update the company with the request data
        $compagny = Compagny::where('id', $request->id)->update($dataToUpdate);

        // Return the result of the update operation
        return response()->json([
            'compagny' => $compagny,
        ]);
    }


    public function delete(Request $request)
    {
        // Validate the request
        $request->validate([
            "id" => 'required|integer|exists:compagnies,id', // Validate that ID exists
        ]);

        // Delete the company
        $compagny = Compagny::where('id', $request->id)->delete();

        // Return success message or status
        return response()->json([
            'deleted' => $compagny, // Consider returning a message or status instead
        ]);
    }
}
