<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($id)
    {

    }
    
    public function store(Request $request)
    {
        auth()->user()->projects()
            ->create($request->all());
        
        return redirect()->route('dashboard');
    }
}
