<?php

namespace App\Http\Controllers;

use App\Arta;
use App\Counter;
use App\Like;
use App\Pic;
use App\Slider;
use App\Step;
use App\Tag;
use App\Tool;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtaController extends Controller
{
    public function home(Request $request)
    {
        $page = 1;
        if ($request->page != null)
            $page = $request->page;

        $sliders = Slider::all();


        $artas = Arta::offset(($page - 1) * 20)
            ->limit(20)
            ->get();

        foreach ($artas as $arta) {
            $arta->views += 1;
            $arta->save();
        }

        $tags = DB::table('tags')
            ->select(DB::raw('count(*) as cnt, name'))
            ->groupBy('name')
            ->orderBy('cnt', 'desc')
            ->take(20)
            ->get();

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => [
                "tags" => $tags,
                "posts" => $artas,
                "slider" => $sliders
            ]
        ]);
    }

    public function add(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        $arta = new Arta();
        $arta->title = $request->title;
        $arta->subtitle = $request->subtitle;
        $arta->tags = $request->tags;
        $arta->img = $request->img;
        $arta->dotime = $request->dotime;
        $arta->difficulty = $request->difficulty;
        $arta->desc = $request->desc;
        $arta->steps = $request->steps;
        $arta->price = $request->price;
        $arta->status = $request->status;
        $arta->type = $request->type;
        $arta->cat_id = $request->cat_id;
        $arta->save();

        $user->artas()->save($arta);

        foreach ($request->pics as $url) {
            $pic = new Pic();
            $pic->link = $url;
            $arta->pics()->save($pic);
        }

        $cont = new Counter();
        $cont->like = 0;
        $cont->view = 0;
        $cont->comments = 0;
        $arta->counter()->save($cont);


        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => "Added!"
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $page = 1;
        if ($request->page != null)
            $page = $request->page;

        $artas = Arta::offset(($page - 1) * 20)
            ->limit(20)
            ->where('title', 'like', "%$keyword%")
            ->orWhere('desc', 'like', "%$keyword%")
            ->get();


        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => $artas
        ]);
    }

    public function get(Request $request)
    {
        $arta = Arta::where('id', $request->id)->first();
        $steps = Step::where('steps.arta_id', $request->id)
            ->join('stepmedia', 'steps.id', '=', 'stepmedia.step_id')
            ->get();
        $tags = Tag::where('arta_id', $request->id)->get();
        $tools = Tool::where('arta_id', $request->id)->get();

        echo json_encode([
            "result" => true,
            "extra" => "",
            "message" => [
                "info" => $arta,
                "tags" => $tags,
                "steps" => $steps,
                "tools" => $tools,
            ]
        ]);
    }
}
