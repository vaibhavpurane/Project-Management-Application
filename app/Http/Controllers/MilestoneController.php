<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\MilestoneStatus;
use App\Http\Requests\StoreMilestoneRequest;
use App\Http\Requests\UpdateMilestoneRequest;
use DataTables;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $project)
    {
        // dd($project);
        if($request->ajax()){
            $data = Milestone::where('project_id',$project)->get();
            // dd($project);
            return Datatables::of($data)
                    ->addColumn('name', function($row) {
                        return ucfirst($row->name);
                    })
                    ->addColumn('action', function($row) use ($request){
                        $projectId = $request->project;

                        $btn ='<a href="'.route("projects.milestones.tasks.index", ['project' => $projectId, 'milestone' => $row->id]).'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="View" class="me-2 show btn btn-outline-info btn-sm showMilestone"><i class="fa-regular fa-eye"></i>  <i class="bi bi-eye"></i></a>';

                        $btn = $btn.'<a href="'.route("projects.milestones.edit", ['project' => $projectId, 'milestone' => $row->id]).'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="me-2 edit btn btn-outline-primary btn-sm editMilestone"><i class="fa-regular fa-pen-to-square"></i>  <i class="bi bi-pencil-square"></i></a>';

                        $btn = $btn.'<a href="'.route("projects.milestones.destroy", ['project' => $projectId, 'milestone' => $row->id]).'" type="delete" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="me-2 btn btn-outline-danger btn-sm deleteMilestone"><i class="fa-solid fa-trash"></i>  <i class="bi bi-trash"></i></a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $project = Project::find($request->project);
        return view('projects.milestones.index', compact('project'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($project)
    {
        $project = Project::find($project);
        $milestones = Milestone::all();
        $statuses = MilestoneStatus::all();
        // dd($statuses);
        return view('projects.milestones.create',compact( 'milestones','project', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMilestoneRequest $request, $project)
    {
        // dd($request);
        $milestone= Milestone::create([
            'name' => $request->name,
            'due_date' => $request->due_date,
            'project_id' => $project,
            'statuses_id' => 1,
        ]);
        // dd($milestone);
        return redirect()->route('projects.milestones.index', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show($project, $id)
    {
        // dd($id,$project);
        $projects = Project::find($project);
        $milestone = Milestone::find($id);
        // dd($milestone);
        return view('projects.milestones.show', compact('projects','milestone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($project, $id)
    {
        // dd($id);
        $projects= Project::find($project);
        $milestone= Milestone::find($id);
        $statuses = MilestoneStatus::all();
        return view('projects.milestones.edit', compact('projects','milestone', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMilestoneRequest $request,  $project , $id,)
    {
        // dd($project);
        $milestone = Milestone::find($id);
        // dd($milestone);
        $milestone->name = $request->name;
        $milestone->due_date = $request->due_date;
        $milestone->statuses_id = $request->statuses_id;
        $milestone->save();

        return redirect()->route('projects.milestones.show',['project' => $project, 'milestone' => $milestone->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Milestone $milestone)
    {
        try {
            $milestone->delete();
        return response()->json(['status' => 'success', 'message' => 'Successfullly deleted']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}

