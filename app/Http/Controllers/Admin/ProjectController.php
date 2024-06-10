<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Category;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(5);
        //dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('technologies', 'categories'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|nullable|',
        ]);
        $form_data = $request->all();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        $path = Storage::put('uploads', $form_data['image']);
        if ($request->hasFile('image')) {
            $name = $request->image->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $form_data['image'] = $path;
        }
        $newProject = Project::create($form_data);
        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
            $newProject->technologies()->attach($request->tags);
        }
        return redirect()->route('admin.projects.show', $newProject->slug)->with('message', 'New project created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //dd($project);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'technologies', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $form_data = $request->all();
        $project->update($form_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.show', $project->slug)->with('message', '{$project->title} updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', $project->title .''. 'deleted successfully');
    }
}
