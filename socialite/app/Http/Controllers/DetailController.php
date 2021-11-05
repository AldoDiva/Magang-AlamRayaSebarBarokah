<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
class DetailController extends Controller
{

 /**
     * Create a new controller instance.
     *
     * @return void
     */


   
    public function index()
    {
        $data['projects'] = Project::withCount(["tasks as totalskor"=>function($q){
            $q->where('status',TRUE)->select(DB::raw('sum(skor)as totalskor'));
        }])->orderBy('id','desc')->paginate(6);
  
        return view('detail',$data);



    }    

    public function goal(Request $request)

    {
        
        $task = new Task();
        $task->project_id = $request->project_id;
        $task->task = $request->task;
        $task->skor= $request->skor;
        $task->save();    
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

        $where = array('project_id' => $request->project_id);
        $task  = Task::where($where)->first();
 
        return response()->json($task);
    }
 
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function hapus(Request $request)
    {
        
        $task = Task::wherein('id',$request->task)->delete();
   
        return response()->json(['success' => true]);
    
    }
   
    public function sumskor(Request $request){

        $totalskor = Task::select(['tasks' => Total::selectRaw('sum(skor) as total')
        ->whereColumn('project_id', 'project.id')
        ->groupBy('project_id')
        ])
        ->orderBy('total', 'desc')
        ->get()
        ->toArray();
        
    }

    public function status(Request $request){
        
        $status = Task::wherein('id',$request->task)->update(["status"=>TRUE]);
        return response()->json(['success' => true]);
    }
       
        
}