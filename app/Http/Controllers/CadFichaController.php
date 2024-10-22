<?php

namespace App\Http\Controllers;

use app\GlobalServices;
use Illuminate\Http\Request;
use App\Services\GlobalService;
use Illuminate\Support\Facades\Log;

class CadFichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("cadficha");
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
    public function update(Request $request)
    {
        //dd($request);
        //Log::warning($request). "teste";
        GlobalService::gravaInsumosItem($request);
        //return redirect()->back()->with('success', 'Dados salvos com sucesso!')->withInput();
        return redirect()->back()->withInput();
        //return view("cadficha");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public static function func6(Request $request){
        //Log::warning($request). "teste";
        //$result = GlobalService::gravaInsumosItem();
        //return $result;
    }

}
