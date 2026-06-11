<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExplorerPage;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function index()
    {
        $pages = ExplorerPage::orderBy('sort_order')->get();
        return view('admin.explorer.index', compact('pages'));
    }

    public function edit(ExplorerPage $explorer)
    {
        return view('admin.explorer.form', ['page' => $explorer]);
    }

    public function update(Request $request, ExplorerPage $explorer)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:150',
            'description'  => 'nullable|string|max:500',
            'tag'          => 'nullable|string|max:50',
            'icon_svg'     => 'nullable|string',
            'content_json' => 'nullable|string',
            'sort_order'   => 'integer',
            'is_active'    => 'boolean',
        ]);

        // Validate JSON
        if (!empty($validated['content_json'])) {
            json_decode($validated['content_json']);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['content_json' => 'Invalid JSON: ' . json_last_error_msg()])->withInput();
            }
        }

        $validated['is_active'] = $request->boolean('is_active');
        $explorer->update($validated);

        return redirect()->route('admin.explorer.index')->with('success', 'Explorer page updated.');
    }
}
