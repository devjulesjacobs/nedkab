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
        $cables = Cable::all();

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

        return $request->fileToImport;

        if($request->hasFile('fileToImport')){
            Excel::import(new CablesImport, $request->fileToImport);

            return true;
        }

        return false;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cable  $cable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cable $cable)
    {
        //
    }
}
