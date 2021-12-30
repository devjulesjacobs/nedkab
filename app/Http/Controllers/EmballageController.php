<?php

namespace App\Http\Controllers;

use App\Emballage;
use Auth;
use App\User;
use Illuminate\Http\Request;

class EmballageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emballages = Emballage::all();

        return $emballages;
    }

    public function getEmballageCount()
    {
        $count = Emballage::count();

        return $count;
    }

    public function getSubmitted()
    {
        $emballages = Emballage::query()->with('user')->get();

        return $emballages;
    }

    public function getEmballage($id)
    {
        $emballage = Emballage::where('id', $id)->first();

        return $emballage;
    }

    public function userEmballage()
    {
        $emballages = Emballage::where('user', auth()->user()->id)->orderBy('created_at', 'DESC')->take(20)->get();

        return $emballages;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $emballage = Emballage::create($request->all());

        $user = User::find(auth()->user()->id);

        $user->update([
            'customer_fullname' => $request->customer_fullname,
            'customer_contact' => $request->customer_contact,
            'customer_contact_phone' => $request->customer_contact_phone,
            'street' => $request->street,
            'house_number' => $request->house_number,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'contact' => $request->contact,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'user' => $request->user,
            'picture' => $request->picture,
        ]);

        if($emballage->save()) {
            return response()->json([
                'message' => 'Je ontvangt een bevestigingsmail.'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Fout bij aanmaken van emballage, controleer het formulier en probeer nogmaals ...'
            ], 404);
        }
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
     * @param  \App\Emballage  $emballage
     * @return \Illuminate\Http\Response
     */
    public function show(Emballage $emballage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emballage  $emballage
     * @return \Illuminate\Http\Response
     */
    public function edit(Emballage $emballage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emballage  $emballage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emballage $emballage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emballage  $emballage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emballage $emballage)
    {
        //
    }
}
