<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\Project;
class DashController extends Controller
{
    
    public function dashboard(Request $request)
    {
        $data['projects'] = Project::orderBy('id','desc')->paginate(6);
   
        

        $title         = 'Dashboard';
        $akun          = User::count();
        $project       = Project::count();
        $label         = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $bulan         = [];


        for ($i=1; $i <= count($label) ; $i++) { 
            $tahun=date('Y');
            $str=strlen($i);
            $month=$i.'-'.$tahun;
            if ($str<2) {
                $month='0'.$i.'-'.$tahun;
            }

            array_push($bulan,$month);

        }
        $jumlah_user=[];
        $jumlah_project=[];
        foreach ($bulan as $key => $value) {
            $count=User::where(DB::raw('date_format(created_at, "%m-%Y")'), $value)->count();
            array_push($jumlah_user,$count);
            $count_project=Project::where(DB::raw('date_format(created_at, "%m-%Y")'), $value)->count();
            array_push($jumlah_project,$count_project);
        }

        if ($request->mobile==true) {
            return response()->json([
                'jumlah_user'=> $jumlah_user,
                'jumlah_project'=> $jumlah_project,
                'project'=> $project,
            ]);
            
        }
        
        return view('dash',compact('data','title','akun','project','label','jumlah_user','jumlah_project'));
    }

    
}
