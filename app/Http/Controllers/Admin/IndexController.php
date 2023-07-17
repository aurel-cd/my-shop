<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{
public function index(){
    $roles = Role::all();
    return view('admin.index', compact('roles'));
}
}
