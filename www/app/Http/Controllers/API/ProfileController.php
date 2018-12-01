<?php

namespace App\Http\Controllers\API;

use Auth;
use App\User;
use App\Http\Resources\Profile as ProfileResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
  function __construct(){

      return $this->middleware('auth:api');

   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $profile = User::where('id', '=', Auth::user()->id)->get();

      return ProfileResource::collection($profile);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $profile = $request->isMethod('put') ? User::findOrFail($request->user()->id) : new Profile;

      $profile->id = $request->input('id');
       $profile->name = $request->input('name');
       $profile->email = $request->input('email');

      if($profile->save()) {
          return new ProfileResource($profile);
      }

    }

}
