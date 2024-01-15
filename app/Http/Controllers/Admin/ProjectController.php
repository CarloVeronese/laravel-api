<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->all();
        if(isset($data['title'])) {
            $query = Project::where('project_name', 'like', "%{$data['title']}%");
        }
        $projects = isset($query) ? $query->paginate(20) : Project::paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $technologies = Technology::orderBy('name', 'ASC')->get();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|max:255|string|unique:projects',
            'type_id' => 'nullable|exists:types,id',
            'github_link' => 'max:255|string|unique:projects',
            'project_status' => Rule::in(['to start', 'in progress', 'completed']),
            'technologies' => 'exists:technologies,id'
        ]);
        $data = $request->all();
        $data['github_link'] = 'https://github.com/CarloVeronese/'. Str::slug($data['project_name']);
        $new_project = Project::create($data);
        if ($request->has('technologies')) {
            $new_project->technologies()->attach($data['technologies']);
        }
        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $technologies = Technology::orderBy('name', 'ASC')->get();

        return view('admin.projects.edit', compact('project', 'types', 'technologies    '));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => ['required', 'max:255', 'string', Rule::unique('projects')->ignore($project->id)],
            'project_status' => Rule::in(['to start', 'in progress', 'completed']),
            'category_id' => 'nullable|exists:categories,id',
            'technologies' => 'exists:technologies,id'
        ]);
        $data = $request->all();
        $data['github_link'] = 'https://github.com/CarloVeronese/'. Str::slug($data['project_name']);
        $project->update($data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }
        return redirect()->route('admin.projects.show', $project);
    }
    
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
