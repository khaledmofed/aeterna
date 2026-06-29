<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterLinksController extends Controller
{
    public function index()
    {
        $links = FooterLink::orderBy('group_name')->orderBy('sort_order')->get()->groupBy('group_name');
        return view('admin.footer-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.footer-links.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateLink($request);
        FooterLink::create($validated);
        Cache::forget('footer_links');
        return redirect()->route('admin.footer-links.index')->with('success', 'Link created.');
    }

    public function edit(FooterLink $footerLink)
    {
        return view('admin.footer-links.form', ['link' => $footerLink]);
    }

    public function update(Request $request, FooterLink $footerLink)
    {
        $validated = $this->validateLink($request);
        $footerLink->update($validated);
        Cache::forget('footer_links');
        return redirect()->route('admin.footer-links.index')->with('success', 'Link updated.');
    }

    public function destroy(FooterLink $footerLink)
    {
        $footerLink->delete();
        Cache::forget('footer_links');
        return redirect()->route('admin.footer-links.index')->with('success', 'Link deleted.');
    }

    private function validateLink(Request $request): array
    {
        $v = $request->validate([
            'group_name'    => 'required|array',
            'group_name.en' => 'required|string',
            'group_name.*'  => 'nullable|string',
            'label'         => 'required|array',
            'label.en'      => 'required|string',
            'label.*'       => 'nullable|string',
            'url'           => 'required|string|max:500',
            'sort_order'    => 'integer',
            'is_active'     => 'boolean',
        ]);
        $v['is_active'] = $request->boolean('is_active');
        return $v;
    }
}
