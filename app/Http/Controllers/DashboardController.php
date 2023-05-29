<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            
            $countManager = User::manager()->count();
            $countRepresentative = User::representative()->count();

            $workflowTemplates = auth()->user()->templates()->get();

            $data = [
                'countManager',
                'countRepresentative',
                'workflowTemplates'
            ];

            return Inertia::render('Admin/Home', compact($data));
        }
    }
}
