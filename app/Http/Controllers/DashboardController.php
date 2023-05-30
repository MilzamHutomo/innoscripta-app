<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkflowTemplate;
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

        $projects = auth()->user()->projects;
        
        $admins = User::admin()->get()->pluck('id');

        $userIds = [...$admins, auth()->user()->id];

        $workflowTemplates = WorkflowTemplate::with('boards:workflow_template_id,name')
            ->whereIn('user_id', $userIds)
            ->active()
            ->get();

        $data = [
            'projects',
            'workflowTemplates'
        ];

        return Inertia::render(
            'Dashboard', 
            compact($data)
        );
    }
}
