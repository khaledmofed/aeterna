<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NavigationController extends Controller
{
    public function index()
    {
        $navItems = NavItem::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();
        return view('admin.navigation.index', compact('navItems'));
    }

    public function create()
    {
        $parents = NavItem::whereNull('parent_id')->orderBy('sort_order')->get();
        return view('admin.navigation.form', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'      => 'required|array',
            'label.en'   => 'required|string',
            'label.*'    => 'nullable|string',
            'url'        => 'required|string|max:255',
            'target'     => 'in:_self,_blank',
            'parent_id'  => 'nullable|exists:nav_items,id',
            'sort_order' => 'integer',
            'is_active'  => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        NavItem::create($validated);
        Cache::forget('nav_items');
        return redirect()->route('admin.navigation.index')->with('success', 'Nav item created.');
    }

    public function edit(NavItem $navigation)
    {
        $parents = NavItem::whereNull('parent_id')->where('id', '!=', $navigation->id)->orderBy('sort_order')->get();
        return view('admin.navigation.form', ['item' => $navigation, 'parents' => $parents]);
    }

    public function update(Request $request, NavItem $navigation)
    {
        $validated = $request->validate([
            'label'      => 'required|array',
            'label.en'   => 'required|string',
            'label.*'    => 'nullable|string',
            'url'        => 'required|string|max:255',
            'target'     => 'in:_self,_blank',
            'parent_id'  => 'nullable|exists:nav_items,id',
            'sort_order' => 'integer',
            'is_active'  => 'boolean',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $navigation->update($validated);
        Cache::forget('nav_items');
        return redirect()->route('admin.navigation.index')->with('success', 'Nav item updated.');
    }

    public function destroy(NavItem $navigation)
    {
        $navigation->delete();
        Cache::forget('nav_items');
        return redirect()->route('admin.navigation.index')->with('success', 'Nav item deleted.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->items as $index => $id) {
            NavItem::where('id', $id)->update(['sort_order' => $index]);
        }
        Cache::forget('nav_items');
        return response()->json(['success' => true]);
    }
}
