<?php

namespace App\Http\Controllers\Livreurs;

use App\Http\Controllers\Controller;
use App\Models\Livreurs;
use App\Models\PasswordDefault;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class LivreurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livreurs = Livreurs::all();
        return view('livreurs.index',compact('livreurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = PasswordDefault::first();
        try {
             // Valider les données du formulaire
          $request->validate([
            'address' => 'nullable|string',
            'nom' => 'nullable|string',
            'prenom' => 'nullable|string',
            'photo' => 'nullable|string',
            'telephone' => 'nullable|string',
            'sexe' => 'nullable|string',
            'password' => 'nullable|string',
            'situation_matrimoniale' => 'nullable|string',
            'status' => 'nullable|in:1,2', // Assurez-vous que le statut soit 1 ou 2
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = $image->getClientOriginalName(); // Nom original de l'image

            // Stockage de l'image dans le dossier "public/storage/photos"
            $image->storeAs('storage/photos', $imageName);

            // Stockage du chemin de l'image dans la base de données
            $photo = 'storage/photos/' . $imageName;
        } else {
            // Aucune image n'a été téléchargée
            $photo = null;
        }
        $livreur = new Livreurs([
            'adresse' => $request->address,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'sexe' => $request->sexe,
            'password' => Hash::make($password->value),
            'photo' => $photo, // Stockage du chemin de l'image dans la base de données
            // 'situation_matrimoniale' => $request->situation_matrimoniale,
            'status' => 1,
        ]);

        // Sauvegarder le livreur dans la base de données
        $livreur->save();
        Toastr::success('Messages in here', 'Title');
        return redirect()->back();
         } catch (\Throwable $th) {
             Toastr::error('Messages in here', 'Title');
             return redirect()->back();
            dd($th);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try {
            // Valider les données du formulaire
                $request->validate([
                'adresse' => 'nullable|string',
                'nom' => 'nullable|string',
                'prenom' => 'nullable|string',
                'photo' => 'nullable|string',
                'telephone' => 'nullable|string',
                'sexe' => 'nullable|string',
                'password' => 'nullable|string',
                'situation_matrimoniale' => 'nullable|string',
                'status' => 'nullable|in:1,2', // Assurez-vous que le statut soit 1 ou 2
            ]);

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = $image->getClientOriginalName(); // Nom original de l'image

                // Stockage de l'image dans le dossier "public/storage/photos"
                $image->storeAs('public/photos', $imageName);

                // Stockage du chemin de l'image dans la base de données
                $photo = 'storage/photos/' . $imageName;
            } else {
                // Aucune image n'a été téléchargée
                $photo = null;
            }
            $livreur =  Livreurs::find($request->id_update);

            $livreur->adresse = $request->adresse;
            $livreur->nom = $request->nom;
            $livreur->prenom = $request->prenom;
            $livreur->telephone = $request->telephone;
            $livreur->sexe = $request->sexe;
            $livreur->photo = $photo; // Stockage du chemin de l'image dans la base de données

            // Sauvegarder le livreur dans la base de données
            $livreur->save();
        Toastr::success('Messages in here', 'Title');
        return redirect()->back();
            } catch (\Throwable $th) {
                dd($th->getMessage());
            Toastr::error('Messages in here', 'Title');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $livreur =  Livreurs::find($id);
            $livreur->delete();
            return response()->json(['status'=> 'success']);
             } catch (\Throwable $th) {
                Toastr::error('Messages in here', 'Title');
            }
    }

    public function suspendre_livreur($id){

        try {
            $livreur =  Livreurs::where('id',$id)->first();
            $livreur->status = '2';
            $livreur->save();
            Toastr::success('Messages in here', 'Title');
            return redirect()->back();
             } catch (\Throwable $th) {

                Toastr::error('Messages in here', 'Title');
            }
    }

    public function activer_livreur($id){

        try {
            $livreur =  Livreurs::where('id',$id)->first();
            $livreur->status = '1';
            $livreur->save();
            Toastr::success('Messages in here', 'Title');
            return redirect()->back();
             } catch (\Throwable $th) {

                Toastr::error('Messages in here', 'Title');
            }
    }
}
