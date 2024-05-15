<?php

namespace App\Http\Controllers\Partenaires;

use App\Http\Controllers\Controller;
use App\Models\Partenaires;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('type','2')->get();
        $partenaires =  Partenaires::all();
        return view('partenaires.add_admin',compact('partenaires','users'));
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
        // dd($request);
        $partenairesArray = explode(',', $request->partenaires); // Convertir la chaîne en tableau

        // Supprimer les éléments 'on' du tableau
        $partenairesArray = array_filter($partenairesArray, function($value) {
            return $value !== 'on';
        });

        // dd($partenairesArray);
        try {
            foreach ($request->Admin as $value) {
               $user = User::find($value);
               foreach ($partenairesArray as $part) {


                   $user->partenaires()->attach($part);

               }
               $user->save();

               Toastr::success('Messages in here', 'Title');
               return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $th;
            Toastr::error('Messages in here', 'Title');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
