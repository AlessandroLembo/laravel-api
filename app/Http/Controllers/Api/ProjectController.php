<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('is_published', true)->with('type', 'technologies')->orderBy('updated_at', 'DESC')->paginate(3);

        // Giro su ogni progetto e controllo se ha un'immagine, se si costruisco l'url intero
        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('type', 'technologies')->find($id);
        if (!$project) return response(null, 404);
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Funzione per raggruppare i progetti per tipo, quindi mi serve l'id del singolo type
    public function typeProjectsIndex(string $id)
    {
        // recupero il type 

        $type = Type::find($id);
        if (!$type) return response(null, 404);

        $projects = Project::where('type_id', $type->id)->with('technologies', 'type')->paginate(2);

        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
        }
        return response()->json(compact('projects', 'type'));
    }

    // public function technologiesProjectsIndex(string $id)
    // {
    //     $technologies = Technology::find($id);
    //     if (!$technologies) return response(null, 404);

    //     $projects = Project::where('technologies_id', $technologies->id)->get();
    //     return response()->json(compact('projects', 'technologies'));
    // }
}
