<?php

namespace App\Http\Controllers;

use App\Catagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
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
        $cat = new Catagory();
        $cat->title = $request->title;
        $cat->img = $request->img;
        $cat->save();

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => "Added!"
        ]);
    }

    public function all() {
        $cats = Catagory::all();

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => $cats

        ]);
    }

    public function get(Request $request) {
        $id = $request->id;

        $page = 1;
        if ($request->page != null)
            $page = $request->page;

        $artas = Catagory::where('id', $id)->first()->artas()
            ->join('counters', 'artas.id', '=', 'counters.arta_id')
            ->offset(($page - 1) * 20)
            ->limit(20)
            ->get();

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => $artas
        ]);
    }
}
