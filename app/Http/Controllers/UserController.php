<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if ($user == null) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "user not found!"
            ]);
        } else {
            if (Hash::check($password, $user->password)) {
                echo json_encode([
                    "result" => true,
                    "extra" => [
                        "id" => $user->id
                    ],
                    "message" => "success!"
                ]);
                session(['id' => $user->id]);
            } else {
                echo json_encode([
                    "result" => false,
                    "extra" => "",
                    "message" => "wrong password!"
                ]);
            }
        }
    }

    public function logout() {
        session()->forget('id');

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => "logout success!"
        ]);
    }

    public function register(Request $request) {
        $email = $request->email;
        if ($email == null) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "please insert email!"
            ]);
            return;
        }
        $user = User::where('email', $email)->first();

        if ($user == null) {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_peremium = 0;
            $user->imei = $request->imei;
            $user->save();

            echo json_encode([
                "result" => true,
                "extra" => "",
                "message" => "added!"
            ]);
        } else {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "email exist!"
            ]);
        }
    }

    public function update(Request $request) {
        if (!$request->session()->has('id')) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "not login!"
            ]);
            return;
        }
        $id = $request->id;
        $user = User::where('id', $id)->first();

        if ($user == null) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "user not found!"
            ]);
        } else {
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->postcode = $request->postcode;
            $user->save();

            echo json_encode([
                "result" => true,
                "extra" => "",
                "message" => "edited!"
            ]);
        }
    }
}
