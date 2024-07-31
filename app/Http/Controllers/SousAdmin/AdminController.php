<?php

namespace App\Http\Controllers\SousAdmin;

use App\Http\Controllers\Controller;
use App\Models\PasswordDefault;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SousAdmin =  User::where('type','2')->get();
        return view('admin.index',compact('SousAdmin'));
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

        if ($password) {
            # code...
            try {
                 // Valider les données du formulaire
                    $request->validate([
                        'email' => 'nullable|string',
                        'nom' => 'nullable|string',
                        'prenom' => 'nullable|string',
                        'photo' => 'nullable|string',
                        'telephone' => 'nullable|string',
                        'sexe' => 'nullable|string',
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
                    $livreur = new User([
                        'email' => $request->address,
                        'name' => $request->nom,
                        'lastname' => $request->prenom,
                        'telephone' => $request->telephone,
                        'sexe' => $request->sexe,
                        'password' => Hash::make($password->value),
                        'photo' => $photo, // Stockage du chemin de l'image dans la base de données
                        'type' => '2',
                    ]);

                    // Sauvegarder le livreur dans la base de données
                    $livreur->save();
                    toastr()->success('Data has been saved successfully!');

                    return redirect()->back();
             } catch (\Exception $th) {
                // dd($th->getLine());
                toastr()->error('An error has occurred please try again later.');
                return redirect()->back();

            }
        }else {
                toastr()->error('Veuillez d\'abord configurer les mot de passe des admins');
                return redirect()->back();

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
        $password = PasswordDefault::first();

        try {
             // Valider les données du formulaire
                $request->validate([
                    'email' => 'nullable|string',
                    'nom' => 'nullable|string',
                    'prenom' => 'nullable|string',
                    'photo' => 'nullable|string',
                    'telephone' => 'nullable|string',
                    'sexe' => 'nullable|string',
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
                $livreur =  User::find($request->id_update);
                $livreur->email = $request->adresse;
                $livreur->name  = $request->nom;
                $livreur->lastname  = $request->prenom;
                $livreur->telephone  = $request->telephone;
                $livreur->sexe = $request->sexe;
                $livreur->photo  = $photo; // Stockage du chemin de l'image dans la base de données
                // Sauvegarder le livreur dans la base de données
                $livreur->save();
                toastr()->success('Data has been saved successfully!', 'Congrats');
                return redirect()->back();
                } catch (\Throwable $th) {
                    dd($th);
                    toastr()->error('Oops! Something went wrong!', 'Oops!');
                     return redirect()->back();

                }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $livreur =  User::find($id);
            $livreur->delete();
            return response()->json(['status'=> 'success']);
             } catch (\Throwable $th) {
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return redirect()->back();
            }
    }

    public function partenaire_associes($id){
        try{
            $users =  User::find($id);
            $partenaires = $users->partenaires;
            return view('admin.part_admin',compact('partenaires', 'users'));

        }catch(\Throwable $th){

        }
    }
}
