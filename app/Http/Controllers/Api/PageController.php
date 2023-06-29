<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\DB;

use Paginator\Paginate;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('type', 'technologies')->paginate(8);
        return response()->json($projects);
    }

    public function filteredTechnology($id){
        $projects = Project::with('type','technologies')
                            ->whereHas('technologies', function(Builder $query) use($id){
                       $query->where('technology_id', $id);
                    })->paginate(8);

        return response()->json($projects);
    }

    public function filteredType($id){
        $projects = Project::where('type_id', $id)->with('type', 'technologies')->paginate(8);
        return response()->json($projects);
    }

    public function types(){
        $types = Type::all();
        return response()->json($types);
    }

    public function technologies(){
        $technologies = Technology::all();
        return response()->json($technologies);
    }

    public function getBySlug($slug){
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        return response()->json($project);
    }

    public function getByName($nameToSearch){
        $project = Project::where('name', 'LIKE', "%$nameToSearch%")->with('type', 'technologies')->paginate(8);
        return response()->json($project);
    }

}
