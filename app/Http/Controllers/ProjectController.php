<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:andamento,pendente,concluido',
            'start_date' => 'required|date',
        ]);
        $validated['user_id'] = Auth::id();
        Project::create($validated);
        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    public function show(Project $project)
    {
        $this->authorizeProject($project);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorizeProject($project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeProject($project);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:andamento,pendente,concluido',
            'start_date' => 'required|date',
        ]);
        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        $this->authorizeProject($project);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projeto excluído com sucesso!');
    }

    private function authorizeProject(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }
}
