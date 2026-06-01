<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionsController extends Controller
{
    public function index()
    {
        $solutions = Solution::orderBy('sort_order')->get();
        return view('admin.solutions.index', compact('solutions'));
    }

    public function create()
    {
        return view('admin.solutions.form', ['solution' => new Solution, 'action' => route('admin.solutions.store'), 'method' => 'POST']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'challenge'        => 'required|string|max:255',
            'current_state'    => 'required|string',
            'aeterna_solution' => 'required|string',
            'sort_order'       => 'integer',
            'is_active'        => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Solution::create($data);
        return redirect()->route('admin.solutions.index')->with('success', 'Solution row added.');
    }

    public function edit(Solution $solution)
    {
        return view('admin.solutions.form', ['solution' => $solution, 'action' => route('admin.solutions.update', $solution), 'method' => 'PUT']);
    }

    public function update(Request $request, Solution $solution)
    {
        $data = $request->validate([
            'challenge'        => 'required|string|max:255',
            'current_state'    => 'required|string',
            'aeterna_solution' => 'required|string',
            'sort_order'       => 'integer',
            'is_active'        => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $solution->update($data);
        return redirect()->route('admin.solutions.index')->with('success', 'Solution row updated.');
    }

    public function destroy(Solution $solution)
    {
        $solution->delete();
        return back()->with('success', 'Deleted.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $i => $id) {
            Solution::where('id', $id)->update(['sort_order' => $i + 1]);
        }
        return response()->json(['ok' => true]);
    }
}
