<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\Technology;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=Project::all();

        return view("admin.project.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();

        return view("admin.project.create", compact("technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        

        
    
        $project=new Project();
        $project->name=$data["name"];
        $project->description=$data["description"];
        $project->github_link=$data["github_link"];
        $project->save();

        

        if ($request->has("technologies")) {
            $project->technologies()->attach($data["technologies"]);
        }

        return redirect()->route("admin.projects.show", $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project=Project::find($id);

        return view("admin.project.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::find($id);
        if(!$project){
            abort(404, "Ritenta");
        }

        $technologies = Technology::all();

        return view("admin.project.edit", compact("project", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data = $request->all();

        
        if (key_exists("cover_img", $data)) {
            
            $path=Storage::disk('public')->put("projects", $data["cover_img"]);

            
            Storage::disk('public')->delete($project->cover_img);
        }

        $project->update([
            ...$data,
            
            "cover_img" => $path ?? $project->cover_img
        ]);

        $project->technologies()->sync($data["technologies"]);

        return redirect()->route("admin.projects.show", compact("project"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Project::findOrFail($id);
        

        if ($project->cover_img) {
            Storage::disk('public')->delete($project->cover_img);
        }

        $project->delete();

        return redirect()->route("admin.projects.index");
    }
}
