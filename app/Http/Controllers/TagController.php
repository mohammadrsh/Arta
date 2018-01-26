<?php

namespace App\Http\Controllers;

use App\Arta;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function get(Request $request) {
        $name = $request->name;

        $page = 0;
        if ($request->page != null)
            $page = $request->page;

        $artas = Arta::where('tags', 'like', "%$name%")
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
