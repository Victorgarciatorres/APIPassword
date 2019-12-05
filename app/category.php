<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'user_id'];

    public function add_category(Request $request, $user)
    {
    	$category = new Category();
    	$category->name = $request->name;
    	$category->user_id = $user->id;
    	$category->save();
    }
}
