<?php

namespace App\Http\Controllers;

use DB;
use Exception;

use app\GlobalServices;
use Illuminate\Http\Request;
use App\Services\GlobalService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class CatProdController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view("catprod");
    }

    public function show()
    {
        return view("catprod");
    }



    public static function func3(){

        $result = GlobalService::populaTabelas();

        //return response()->json([$result]);
        return $result;
    }

    public static function func4(){

        $result = GlobalService::populaTabelasCombo();

        return $result;
    }

    public static function func5($id){
        //Log::warning($id). "teste";
        $result = GlobalService::populaInsumosItem($id);
        return $result;
    }

}

