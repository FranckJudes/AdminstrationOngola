<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use function Flasher\Toastr\Prime\toastr;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Set a warning toast, with no title
        return view('Auth.auth-login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(){


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

            try {

                $credentials = $request->validate([
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]);

                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();

                    toastr()->success('Ravie de vous revoir');
                    return to_route('dashboard.index');
                }
                toastr()->error('Email ou mot de passe incorrect');
                return redirect()->back();

            } catch (\Throwable $th) {
                dd($th->getMessage());
                toastr()->error('Une erreur est survenue');
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
    public function setLang($locale)
    {
        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }


    public function logout(Request $request): RedirectResponse
    {

        try {
            //code...
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            toastr()->success('Good Bye');
            return to_route('auth.index');

        } catch (\Throwable $th) {
            //throw $th;
            toastr()->error('Au revoir a vous');
            return redirect()->back();
        }


    }
}
