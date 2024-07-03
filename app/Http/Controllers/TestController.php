<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {

        // $user = User::find(1);
        // $role = $user->roles->first();
        // dd($role->pivot);

        // $user = User::find(2);
        // $role = Role::find(1);

        // $result = $user->roles()->save($role);
        // $result = $user->roles()->detach($role);
        // dd($result);


        $category = Category::find(1);
        dd($category->comments);
    }
}
