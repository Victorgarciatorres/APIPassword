<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helper\Token;
use App\Category;

class user_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = new User();
        $user->register($request);

        $data_token = [
            "email" => $user->email,
        ];

        $token = new Token($data_token);
        $token_encode = $token->encode();

        return response()->json([
            "token" => $token_encode
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $email = $request->data_token->email;

        $user = User::where('email', $email)->first();
        $category = Category::where('user_id', $user->id)->get();

        return response()->json([
            "User" => $user,
            "Categories" => $category
            ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $email = $request->data_token->email;
        $user = User::where('email', $email)->first();
        //var_dump($user);exit;

        $user->delete();
        return response()->json([
            "message" => "Usuario borrado"
        ], 401);
    }

    public function login(Request $request)
    {
        $data_token = [
            'email' => $request->email
        ];

        $user = User::where($data_token)->first();

        if ($user->password == $request->password) {

            $token = new Token($data_token);
            $token_encode = $token->encode();

            return response()->json([
                "token" => $token_encode
            ], 200);
        }

        return response()->json([
            "message" => "Unauthorized"
        ], 401);

    }






}
