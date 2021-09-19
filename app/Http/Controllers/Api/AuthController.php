<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Event;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request, $id)
    {
        $event = Event::find($id);
        $profile = $event->profiles()->firstOrCreate(
            ['email' => $request->email],
            ['properties' => json_encode($request->all())]
        );

        if ($profile->wasRecentlyCreated === true) {
            // $profile wasn't found and have been created in the database
            return response()->json([
                'msg' => 'user registered successfully',
                'url' => 'event url'
            ]);
        } else {
            // $profile was found and returned from the database
            return response()->json([
                'err' => 'email is found before',
            ]);
        }

    }

    public function login(Request $request)
    {

        if (Profile::where('email', '=', $request->email)->exists()) {
            // user found
            $user = Profile::where('email', $request->email)->first();
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'url' => 'event url',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'url' => 'register url',
            ]);
        }


    }

    public function user(Request $request){
        if (Auth::check()) {
            $user= Profile::where('id', $request->user()->id)->first();
            return new ProfileResource($user);
        }else {
            return response()->json([
                "error" => "Not authenticated",
            ],Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'success'
        ],Response::HTTP_OK);
    }
}
