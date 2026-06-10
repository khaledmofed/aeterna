<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvestorsController extends Controller
{
    public function index()
    {
        $investors = Investor::orderBy('sort_order')->get();
        return view('admin.investors.index', compact('investors'));
    }

    public function create()
    {
        return view('admin.investors.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'logo_url'    => 'nullable|string|max:500',
            'logo_file'   => 'nullable|image|max:2048',
            'website_url' => 'nullable|string|max:500',
            'glow_color'  => 'nullable|string|max:20',
            'type'        => 'required|in:lead,strategic,partner',
            'sort_order'  => 'integer',
            'is_active'   => 'boolean',
        ]);
        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('investors', 'public');
            $validated['logo_url'] = Storage::url($path);
        }
        unset($validated['logo_file']);
        $validated['is_active'] = $request->boolean('is_active');
        Investor::create($validated);
        return redirect()->route('admin.investors.index')->with('success', 'Investor created.');
    }

    public function edit(Investor $investor)
    {
        return view('admin.investors.form', compact('investor'));
    }

    public function update(Request $request, Investor $investor)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'logo_url'    => 'nullable|string|max:500',
            'logo_file'   => 'nullable|image|max:2048',
            'website_url' => 'nullable|string|max:500',
            'glow_color'  => 'nullable|string|max:20',
            'type'        => 'required|in:lead,strategic,partner',
            'sort_order'  => 'integer',
            'is_active'   => 'boolean',
        ]);
        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('investors', 'public');
            $validated['logo_url'] = Storage::url($path);
        }
        unset($validated['logo_file']);
        $validated['is_active'] = $request->boolean('is_active');
        $investor->update($validated);
        return redirect()->route('admin.investors.index')->with('success', 'Investor updated.');
    }

    public function destroy(Investor $investor)
    {
        $investor->delete();
        return redirect()->route('admin.investors.index')->with('success', 'Investor deleted.');
    }
}
