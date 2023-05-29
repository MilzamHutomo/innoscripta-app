<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkflowTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $template = auth()->user()->templates()->create([
            'name' => $request->name,
            'is_active' => TRUE
        ]);

        for ($i=0; $i < count($request->boards); $i++) { 
            $template->boards()->create([
                'name' => $request->boards[$i],
                'order' => $i
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
