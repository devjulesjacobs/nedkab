<?php

namespace App\Http\Controllers;

use App\Cable;
use App\Imports\CablesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cables = Cable::orderBy('created_at', 'DESC')->take(100)->get();

        return $cables;
    }

    public function search(Request $request)
    {
        $cable = Cable::where('description', 'LIKE', "%$request->input%")->orderBy('description', 'ASC')->take(10)->get();

        return $cable;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cable = Cable::create($request->all());

        $cable->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cable  $cable
     * @return \Illuminate\Http\Response
     */
    public function show(Cable $cable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cable  $cable
     * @return \Illuminate\Http\Response
     */
    public function edit(Cable $cable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cable  $cable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cable $cable)
    {
        //
    }

    public function destroy(Request $request)
    {
        $cable = Cable::find($request->id);
        $cable->delete();
    }
}
