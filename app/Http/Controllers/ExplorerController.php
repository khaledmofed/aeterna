<?php

namespace App\Http\Controllers;

use App\Models\ExplorerPage;
use App\Models\NavItem;
use App\Models\FooterLink;
use Illuminate\Support\Facades\Cache;

class ExplorerController extends Controller
{
    private function sharedData(): array
    {
        return [
            'navItems' => Cache::remember('nav_items', 3600, fn() =>
                NavItem::with('children')->active()->topLevel()->orderBy('sort_order')->get()
            ),
            'footerLinks' => Cache::remember('footer_links', 3600, fn() =>
                FooterLink::active()->get()
            )->groupBy('group_name'),
        ];
    }

    public function show(string $slug)
    {
        $page = ExplorerPage::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $allPages = ExplorerPage::active()->orderBy('sort_order')->get();
        return view('public.explorer.show', array_merge($this->sharedData(), compact('page', 'allPages')));
    }
}
