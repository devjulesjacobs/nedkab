<?php

namespace App\Http\Controllers;

use App\Emballage;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

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
        $emballage = Emballage::where('id', $id)->with('user')->first();

        return $emballage;
    }

    public function userEmballage()
    {
        $emballages = Emballage::where('user', auth()->user()->id)->orderBy('created_at', 'DESC')->take(20)->get();

        return $emballages;
    }

    public function setApproved(Request $request, $id)
    {
        $emballage = Emballage::where('id', $id)->first();

        $emballage->update([
            'status' => $request->status
        ]);

        // Send mail
    }

    public function setSubmitted(Request $request, $id)
    {
        $emballage = Emballage::where('id', $id)->first();

        $emballage->update([
            'status' => $request->status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();
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
            'picture' => $request->picture, // ToDo: Check if it can be deleted
        ]);

        if($data['picture']) {
            switch($_FILES['picture']['type']) {
                case 'image/png': $extension = '.png'; break;
                case 'image/jpeg': $extension = '.jpg'; break;

                default: return response()->json([
                    'image' => ['Not the right filetype, choose .png or .jpg']
                ], 404);
            }

            $img = Image::make($request->file('picture'));
            $img->fit( 1280, 720);

            $path = public_path("img/emballage/"); // set your own directory name there
            $filename = time().'-emballage'.$extension; // get your own filename here

            $img->save($path.$filename);

            $data['picture'] = $filename;
        }

        $emballage = Emballage::create($data);

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
