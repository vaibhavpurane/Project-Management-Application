<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use DataTables;
use App\Models\User;
use App\Models\Milestone;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::all();
            return Datatables::of($data)
                    ->addColumn('name', function($row) {
                        return ucfirst($row->name);
                    })
                    ->addColumn('action', function($row){
                            $btn = '<a href="' . route("projects.milestones.index", ['project' => $row->id]) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="View Milestones" class="me-2 btn btn-outline-info btn-sm"><i class="fa-regular fa-eye"></i> <i class="bi bi-eye"></i></a>';

                           $btn = $btn. '<a href="'.route("projects.edit",['project'=>$row->id]).'"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="me-2 edit btn btn-outline-primary btn-sm editProject"><i class="fa-regular fa-pen-to-square"></i><i class="bi bi-pencil-square"></i></a>';

                           $btn = $btn.'<a method="delete" href="'.route("projects.destroy",$row->id).'" type="delete" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-outline-danger btn-sm deleteProject"><i class="fa-solid fa-trash"></i><i class="bi bi-trash"></i></a>';

                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('projects.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project= Project::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'active' => 1,

        ]);
        $userIds = $request->user_id;
        $project->users()->attach($userIds);
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::with('users')->find($id);
        // $milestones = Milestone::where('project_id', $id)->get();
        // return redirect()->route('projects.redirect.milestones', ['projectId' => $project->id]);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $users = User::all();
        return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->start_date = $request->start_date;
        $project->active = $request->active;
        $project->save();
        $userIds = $request->user_id;
        $project->users()->sync($userIds);
        return redirect()->route('projects.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $project = Project::find($id);
            $project->users()->detach();
            $project->delete();
            return response()->json(['status' => 'success', 'message' => 'Successfullly deleted']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
