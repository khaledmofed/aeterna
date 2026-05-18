<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchitectureLayer;
use App\Models\EmailSubscriber;
use App\Models\Investor;
use App\Models\RoadmapStage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSubscribers  = EmailSubscriber::count();
        $activeSections    = ArchitectureLayer::where('is_active', true)->count();
        $investorsCount    = Investor::where('is_active', true)->count();
        $roadmapStages     = RoadmapStage::where('is_active', true)->count();
        $recentSubscribers = EmailSubscriber::latest('subscribed_at')->take(10)->get();

        return view('admin.dashboard', compact(
            'totalSubscribers', 'activeSections', 'investorsCount',
            'roadmapStages', 'recentSubscribers'
        ));
    }
}
