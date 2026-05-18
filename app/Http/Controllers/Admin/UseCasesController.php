<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UseCase;
use Illuminate\Http\Request;

class UseCasesController extends Controller
{
    public function index()
    {
        $useCases = UseCase::orderBy('sort_order')->get();
        return view('admin.use-cases.index', compact('useCases'));
    }

    public function create()
    {
        return view('admin.use-cases.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCase($request);
        $validated['features_json'] = $this->parseFeatures($request);
        UseCase::create($validated);
        return redirect()->route('admin.use-cases.index')->with('success', 'Use case created.');
    }

    public function edit(UseCase $useCase)
    {
        return view('admin.use-cases.form', compact('useCase'));
    }

    public function update(Request $request, UseCase $useCase)
    {
        $validated = $this->validateCase($request);
        $validated['features_json'] = $this->parseFeatures($request);
        $useCase->update($validated);
        return redirect()->route('admin.use-cases.index')->with('success', 'Use case updated.');
    }

    public function destroy(UseCase $useCase)
    {
        $useCase->delete();
        return redirect()->route('admin.use-cases.index')->with('success', 'Use case deleted.');
    }

    private function validateCase(Request $request): array
    {
        $v = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string',
            'icon_svg'    => 'nullable|string',
            'category'    => 'nullable|string|max:50',
            'sort_order'  => 'integer',
            'is_active'   => 'boolean',
        ]);
        $v['is_active'] = $request->boolean('is_active');
        return $v;
    }

    private function parseFeatures(Request $request): array
    {
        $features = [];
        foreach (($request->features ?? []) as $f) {
            if (!empty($f['title'])) $features[] = $f;
        }
        return $features;
    }
}
