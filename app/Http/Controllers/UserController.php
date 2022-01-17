<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $users = User::where('type', 'app')->take(100)->get();

        return $users;
    }

    public function getAllCount()
    {
        $count = User::where('type', 'app')->count();

        return $count;
    }

    public function getEmployees()
    {
        $employees = User::where('type', 'admin')->get();

        return $employees;
    }

    public function search(Request $request)
    {
        $users = User::where('name', 'LIKE', "%$request->input%")->where('type', 'app')->orderBy('name', 'ASC')->get();

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('NedkabMedewerker2022!'),
            'type' => 'admin'
        ]);

        $user->save();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        return $user;
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if($user) {
            if($user->id === auth()->user()->id) {
                $user->update($request->all());

                return response()->json([
                    'message' => 'Gegevens bijgewerkt'
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Not authorized.'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Gebruiker niet gevonden.'
            ], 404);
        }
    }

    public function avatar(Request $request, $id)
    {
        $user = User::find($id);

        switch($_FILES['image']['type']) {
            case 'image/png': $extension = '.png'; break;
            case 'image/jpeg': $extension = '.jpg'; break;

            default: return response()->json([
                'message' => 'Dit type foto is niet toegestaan. U kunt .png en .jpg/.jpeg gebruiken.'
            ], 404);
        }

        if(!empty($user->avatar)) {
            $old_image = public_path('img/user/').$user->avatar;

            if (file_exists($old_image)) {
                chmod($old_image, 0644);
                unlink($old_image);
            }
        }

        $img = Image::make($request->file('image'));
        $img->fit( 500, 500);

        $path = public_path("img/user/");
        $filename = 'U'.$user->id.'T'.time().$extension;

        $img->save($path.$filename);

        $user->update([
            'avatar' => $filename
        ]);

        return response()->json([
            'message' => 'Profielfoto bijgewerkt.',
            'image' => $filename
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user && $user->id !== auth()->user()->id && !$user->super_admin) {
            if(!empty($user->avatar)) {
                $old_image = public_path('img/user/').$user->avatar;

                if (file_exists($old_image)) {
                    chmod($old_image, 0644);
                    unlink($old_image);
                }
            }

            $user->delete();

            return response()->json([
                'message' => 'Account succesvol verwijderd.'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Kan deze admin niet verwijderen.'
            ], 404);
        }
    }
}
