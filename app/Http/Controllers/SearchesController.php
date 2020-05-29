<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

use App\ReportType;

use Carbon\Carbon; 

use Illuminate\Support\Facades\DB;

class SearchesController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $query = Report::query();
        $totalQuery = ReportType::select(DB::raw('type, sum(amount) as total')) 
                         ->join('reports', 'report_types.report_id', '=', 'reports.id');
        if (!empty($request->form_year) && !empty($request->from_month) && !empty($request->from_day) ) {
             $from_date = Carbon::createFromDate($request->form_year, $request->from_month, $request->from_day);
             $query->whereDate("created_at", '>=', $from_date->toDateString());
             $totalQuery->whereDate("created_date", '>=', $from_date->toDateString());
        }
        if (!empty($request->to_year) && !empty($request->to_month) && !empty($request->to_day) ) {
             $to_date = Carbon::createFromDate($request->to_year, $request->to_month, $request->to_day);
             $query->whereDate("created_at", '<=', $to_date->toDateString());
             $totalQuery->whereDate("created_date", '<=', $to_date->toDateString());
        }
        if (!empty($keyword)) {
            $query->where('content', 'LIKE', "%{$keyword}%");
        }
        $reports = $query->orderBy('created_at', 'desc')->paginate(10);
        $totals = $totalQuery->groupBy('type')->get();
        
        return view('reports.search', ['reports' => $reports, 'totals' => $totals]);
     }         
}
