<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'user_id'];


    public function addCategory (Request $request, $user)
    {
    	$category = new Category();
    	$category->name = $request->name;
    	$category->user_id = $request->user;
    	$category->save();
    }

}
