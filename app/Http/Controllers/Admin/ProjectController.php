<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')
                            ->paginate(8);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $method = "POST";
        $route = route('admin.projects.store');
        $project = null;
        $action = "Add";
        $types = Type::all();
        return view('admin.projects.create-edit', compact('project', 'method', 'route', 'action', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        $new_project = new Project();
        $new_project->slug = Project::generateSlug($form_data['name']);
        $new_project->is_done = $form_data['is_done'];

        // If it finds a key named 'image' in $form_data it fills the fields
        if(array_key_exists('image', $form_data)){
            $form_data['original_img_name'] = $request->file('image')->getClientOriginalName();

            $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
        }

        $new_project->fill($form_data);
        $new_project->save();
        if(array_key_exists('technologies', $form_data)){
            $new_project->technologies()->attach($form_data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if($project->image_path){
            $img_path = $project->image_path;

        }else{
            $img_path = 'uploads/default-image.jpeg';

        }
        return view('admin.projects.show', compact('project', 'img_path'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $method = "PUT";
        $route = route('admin.projects.update' , $project);
        $action = "Edit";
        $types = Type::all();
        return view('admin.projects.create-edit', compact('project', 'method', 'route', 'action', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if($project->name !== $form_data['name']){
            $project->slug = Project::generateSlug($form_data['name']);
        }else{
            $form_data['slug'] = $project->slug;
        }

        if(array_key_exists('image', $form_data)){

            if($project->image_path){
                Storage::disk('public')->delete($project->image_path);
            }

            $form_data['original_img_name'] = $request->file('image')->getClientOriginalName();

            $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
        }

        if(array_key_exists('technologies', $form_data)){
            $project->technologies()->sync($form_data['technologies']);
        }else {
            $project->technologies()->detach();
        }

        $project->update($form_data);

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->image_path){
            Storage::disk('public')->delete($project->image_path);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', "<strong> $project->name </strong> deleted successfully");
    }
}
