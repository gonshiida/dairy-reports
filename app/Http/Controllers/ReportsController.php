<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

use App\ReportType;

class ReportsController extends Controller
{
    // getでreports/にアクセスされた場合の「一覧表示処理」
     public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $reports = $user->reports()->get();
            
            $data = [
                'user' => $user,
                'reports' => $reports,
            ];
        }
        
        return view('reports.index', $data);
    }
    // getでreports/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $report = new Report;
        $typeOptions = ['選択してください', 'クッキー', 'フィナンシェ', 'マドレーヌ', 'パウンド', 'スポンジ'];

        return view('reports.create', [
            'report' => $report,
            'typeOptions' => $typeOptions,
        ]);
    }

    // postでreports/にアクセスされた場合の「新規登録処理」
        public function store(Request $request)
    {
        $typeOptions = ['選択してください', 'クッキー', 'フィナンシェ', 'マドレーヌ', 'パウンド', 'スポンジ'];
        
        $report = new Report;
        $report->content = $request->content;
        $report->user_id = \Auth::user()->id;
        $report->created_date = $request->created_date;
        $report->save();
        
        $count = 0;
            foreach($request->new_type as $key => $type){
                if ($type == 0){
                    continue;
                }else{
                    $reportType = new ReportType;
                    $reportType->report_id = $report->id;
                    $reportType->type = $typeOptions[$type];
                    $reportType->amount = $request->new_amount[$key];
                    $reportType->save();
                }
            }
        return redirect('/');
    }
    

    // getでreports/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $report = Report::find($id);
        $reportTypes = $report->reportTypes()->get();

        
        if (\Auth::id() === $report->user_id) {
            return view('reports.show', [
            'report' => $report,
            'reportTypes' => $reportTypes,

            ]);
        }
        return redirect('/');
    }

    // getでreports/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $typeOptions = ['選択してください', 'クッキー', 'フィナンシェ', 'マドレーヌ', 'パウンド', 'スポンジ'];
        $report = Report::find($id);
        $reportTypes = $report->reportTypes()->get();

        if (\Auth::id() === $report->user_id) {
            return view('reports.edit', [
            'report' => $report,
            'reportTypes' => $reportTypes,
            'typeOptions' => $typeOptions,
        ]);
            
        }
        return redirect('/');
    }

    // putまたはpatchでreports/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        
        $typeOptions = ['選択してください', 'クッキー', 'フィナンシェ', 'マドレーヌ', 'パウンド', 'スポンジ'];
        $report = Report::find($id);
         if (\Auth::id() === $report->user_id) {
            $report->content = $request->content;
            $report->user_id = \Auth::user()->id;
            $report->created_date = $request->created_date;
            $report->save();
        
            if(!empty($request->type)){
                foreach($request->type as $key => $type){
                    if ($type == 0){
                        $reportType = ReportType::find($request->id[$key]);
                        $reportType->delete();
                    }else{
                        $reportType = ReportType::find($request->id[$key]);
                        $reportType->type = $typeOptions[$type];
                        $reportType->amount = $request->amount[$key];
                        $reportType->save();
                    }
                }
            }
            if(!empty($request->new_type)){
                foreach($request->new_type as $key => $type){
                    if ($type == 0){
                        continue;
                    }else{
                        $reportType = new ReportType;
                        $reportType->report_id = $report->id;
                        $reportType->type = $typeOptions[$type];
                        $reportType->amount = $request->new_amount[$key];
                        $reportType->save();
                    }
                }
            }
        return redirect('/');
        }
    }

    // deleteでreports/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
       
        
        $report = \App\Report::find($id);
        
        if (\Auth::id() === $report->user_id) {
            $report->delete();
        }
        return redirect('/');
        
    }
    public function delete($id)
    {
         $reportType = \App\ReportType::find($id);
        $reportType->delete();
        return back();
    }
}
