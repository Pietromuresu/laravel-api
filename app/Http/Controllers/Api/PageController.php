<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

use Paginator\Paginate;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('type', 'technologies')->paginate(8);
        return response()->json($projects);
    }
}
