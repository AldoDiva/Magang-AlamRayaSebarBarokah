<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class AjaxProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['projects'] = Project::orderBy('id','desc')->paginate(5);
   
        return view('home',$data);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function all()
    {
      $data['projects'] = Project::all();
        return Response()->json(
             $data);
    }
     
    public function store(Request $request)
    {
        


        $project   =   Project::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'nama' => $request->nama, 
                        'no_telp' => $request->no_telp,
                        'nama_project' => $request->nama_project,
                        'tim' => $request->tim,
                        'deadline' => $request->deadline,
                        'progress' => $request->progress,
                        
                        
                    ]);
    
        return response()->json(['success' => true]);
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   

        $where = array('id' => $request->id);
        $project  = Project::where($where)->first();
 
        return response()->json($project);
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $project = Project::where('id',$request->id)->delete();
   
        return response()->json(['success' => true]);
    }

    public function startproject(Request $request)


    {
        $project = Project::where('id',$request->id)->first();
        $start=now();
        $deadline=now()->parse($project->deadline);
        $waktu=$start->diffInDays($deadline)+1;
        $project->start=now();
        $project->save();
        return response()->json(['sucess' => true]);
        
    }

    public function showproject(Request $request)
    {
        $project = Project::where('id',$request->id)->with('tasks')->first();
        return response()->json([
            'sucess' => true,
            'data' => $project,
        ]);
    }

    
}