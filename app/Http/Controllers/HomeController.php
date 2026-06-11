<?php

namespace App\Http\Controllers;

use App\Models\ArchitectureLayer;
use App\Models\EmailSubscriber;
use App\Models\FooterLink;
use App\Models\HeroSection;
use App\Models\Investor;
use App\Models\NavItem;
use App\Models\RoadmapStage;
use App\Models\Solution;
use App\Models\Tokenomic;
use App\Models\ExplorerPage;
use App\Models\UseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HeroSection::where('is_active', true)->first();
        $layers = ArchitectureLayer::active()->get();
        $solutions = Solution::active()->orderBy('sort_order')->get();
        $tokenomics = Tokenomic::first();
        $investors = Investor::active()->get();
        $roadmap = RoadmapStage::active()->get();
        $useCases = UseCase::active()->get();
        $explorerPages = ExplorerPage::active()->orderBy('sort_order')->get();

        $navItems = Cache::remember('nav_items', 3600, fn() =>
            NavItem::with('children')
                ->active()
                ->topLevel()
                ->orderBy('sort_order')
                ->get()
        );

        $footerLinks = Cache::remember('footer_links', 3600, fn() =>
            FooterLink::active()->get()->groupBy('group_name')
        );

        return view('public.home', compact(
            'hero', 'layers', 'solutions', 'tokenomics', 'investors',
            'roadmap', 'useCases', 'navItems', 'footerLinks', 'explorerPages'
        ));
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $exists = EmailSubscriber::where('email', $request->email)->exists();
        if ($exists) {
            return response()->json(['message' => 'You are already subscribed!'], 200);
        }

        EmailSubscriber::create([
            'email'         => $request->email,
            'subscribed_at' => now(),
            'is_active'     => true,
        ]);

        return response()->json(['message' => 'Successfully subscribed! Welcome to Aeterna.'], 200);
    }
}
