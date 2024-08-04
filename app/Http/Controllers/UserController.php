<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use DataTables;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                    ->addColumn('name', function($row) {
                        return ucfirst($row->name);
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route("users.show",['user'=>$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View" class="me-2 btn btn-outline-info btn-sm showUser"><i class="fa-regular fa-eye"></i>  <i class="bi bi-eye"></i></a>';

                           $btn = $btn. '<a href="'.route("users.edit",['user'=>$row->id]).'"  data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="me-2 edit btn btn-outline-primary btn-sm editUser"><i class="fa-regular fa-pen-to-square"></i><i class="bi bi-pencil-square"></i></a>';

                           $btn = $btn.'<a method="delete" href="'.route("users.destroy",$row->id).'" type="delete" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-outline-danger btn-sm deleteUser"><i class="fa-solid fa-trash"></i><i class="bi bi-trash"></i></a>';

                           return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('public',$imageName);
        }
        else {
            $imageName = null;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => $request->is_active,
            'colour_pallate'=> $request->colour_pallate,
            'image'=>$imageName,
        ]);
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if ($request->hasFile('image')) {
            if($user->image){
                Storage::delete('public/'.$user->image);
            }
            $file = $request->file('image');
            $imageNameUpdate = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('public',$imageNameUpdate);
            $user->image = $imageNameUpdate;
        }
        $user->name = $request->name;
        $user->phone=$request->phone;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->is_active = $request->is_active;
        $user->colour_pallate = $request->colour_pallate;
        $user->save();
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if($user->image){
                Storage::delete('public/'.$user->image);
            }
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'Successfullly deleted']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
