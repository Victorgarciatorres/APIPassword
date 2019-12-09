<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Password;
use App\User;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class password_controller extends Controller
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
        $category_name = $request->category_id;
        $category = Category::where('name', $category_name)->first();
        
        $password = new Password();
        $password->add_password($request, $category);
        return response()->json([
            "message" => "nueva contraseña"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       $user = User::where('email',$request->data_token->email)->first();
       $passwords = array();
       $categories = Category::where('user_id',$user->id)->get();

           foreach ($categories as $key => $category) {
               $password = Password::where('category_id',$category->id)->get();
               array_push($passwords,$password);
           }
            return response()->json([ "Passwords" => $passwords]);
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
    public function update(Request $request)
    {
        $password_name = $request->old_title;
        $password = Password::where('title', $password_name)->first();

        $password->title = $request->new_title;
        $password->password = $request->new_password;
    
        $password->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $password_title = $request->password_title;
        $password = Password::where('title', $password_title)->first();

        $password->delete();  
    }
}
