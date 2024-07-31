<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\PasswordDefault;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
class PasswordController extends Controller
{
    //

    public function store(Request $request){
        try {
            $pass = PasswordDefault::first();
            if ($pass) {
                $pass->value = $request->password;
                $pass->save();
                toastr()->success('Data has been saved successfully!');
                return redirect()->back();
            }else {
              $password = new PasswordDefault();
              $password->value = $request->password;
              $password->save();
              toastr()->success('Data has been saved successfully!');
              return redirect()->back();
            }
        } catch (\Throwable $th) {
            toastr()->error('An error has occurred please try again later.');
            return redirect()->back();
        }
    }
}
