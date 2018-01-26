<?php

namespace App\Http\Controllers;

use App\Arta;
use App\Like;
use App\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function add(Request $request) {
        if (!$request->session()->has('id')) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "not login!"
            ]);
            return;
        }
        $like = new Like();
        $user = User::where('id', $request->user_id)->first();
        $arta = Arta::where('id', $request->arta_id)->first();

        if ($user == null || $arta == null) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "bad params!"
            ]);
            return;
        }

        $like->arta_id = $request->arta_id;
        $like->user_id = $request->user_id;

        $like->save();

        $arta->likes += 1;
        $arta->save();

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => "Added!"
        ]);
    }

    public function is_liked(Request $request) {
        if (!$request->session()->has('id')) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "not login!"
            ]);
            return;
        }
        $like = Like::where('arta_id', $request->arta_id)
                        ->where('user_id', $request->user_id)
                        ->first();
        if ($like == null) {
            echo json_encode([
                "result" => false,
                "extra" => "",
                "message" => "not liked!"
            ]);
        } else {
            echo json_encode([
                "result" => true,
                "extra" => "",
                "message" => "liked!"
            ]);
        }
    }
}
