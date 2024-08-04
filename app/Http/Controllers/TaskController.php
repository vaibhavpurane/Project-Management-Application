<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\TaskStatus;
use App\Models\Project;
use App\Models\Milestone;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $project = Project::find($request->project);
        $milestone = Milestone::find($request->milestone);
        $taskStatuses = TaskStatus::all();
        $tasks = Task::where('milestone_id',$request->milestone)->orderBy('order')->get();
        return view('projects.milestones.tasks.index', compact('project','milestone','taskStatuses','tasks'));
    }

    public function reorder(Request $request)
    {
        $taskIds = $request->taskIds;
        $statusId = $request->statusId;
        if ($taskIds) {
            foreach ($taskIds as $index => $taskId) {
                Task::where('id', $taskId)->update(['order' => $index+1, 'status_id' => $statusId]);
            }
        }
        return response()->json(['success' => true]);
    }

    public function sortlist(Request $request){
        $taskIds = $request->taskIds;
        if ($taskIds) {
            foreach ($taskIds as $index => $taskId){
                Task::where('id', $taskId)->update(['order' => $index+1]);
            }
        }
        return response()->json(['success' => true]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($project, $milestone)
    {
        // $project = Project::find($project);
        // $milestone = Milestone::find($milestone);
        // return view('projects.milestones.tasks.create', compact('project', 'milestone'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, $project, $milestone)
    {
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'milestone_id' => $milestone,
            'status_id' => 1,
        ]);
        if ($task) {
            $taskIds= Task::where('status_id', $task->status_id)->pluck('id')->toArray();
            if ($taskIds) {
                foreach ($taskIds as $index => $taskId){
                    Task::where('id', $taskId)->update(['order' => $index+1]);
                }
            }
            $taskHtml = view('projects.milestones.partials._show_tasks', compact('task'))->render();
            return response()->json([
                'taskHtml' => $taskHtml,
                'statusId' => '1'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {

        // return response()->json(['message'=>'list reorder succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
