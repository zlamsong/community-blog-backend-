<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Http\Resources\Profile as ProfileResource;

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
        $profiles = Profile::orderBy('created_at', 'desc')->paginate(5);

        //return articles as a resource
        return ProfileResource::collection($profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = $request->user()->profile()->create($request->all());
        return new ProfileResource($profile);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // if($request->user()->id !== $profile->user_id){

        //     return response()->json(['error'=>'unauthorized action'], 401);
        // }
        $profile = Profile::distinct()->where('user_id', $request->id)->first();
        return new ProfileResource($profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        if($request->user()->id !== $profile->user_id){

            return response()->json(['error'=>'unauthorized action'], 401);
        }

        $profile->update($request->all());

        return new ProfileResource($profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
