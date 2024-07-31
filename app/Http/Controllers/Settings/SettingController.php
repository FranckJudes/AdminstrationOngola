<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\PasswordDefault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings.index');
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
        //
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

    public function livreur_password(){
        $password = PasswordDefault::first();
        return view('settings.password-livreur',compact('password'));
    }

    public function update_theme_app(Request $request){
        try {
            $user =  Auth::user();
            $user->theme_preference = $request->my_color_theme;
            $user->save();
            toastr()->success('Operation avec success');
            return redirect()->back();

        } catch (\Throwable $th) {
            toastr()->error('Une erreur est survenue');
            return redirect()->back();

        }
    }
}
