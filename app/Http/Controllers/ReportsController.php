<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

class ReportsController extends Controller
{
    // getでreports/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $reports = Report::all();

        return view('reports.index', [
            'reports' => $reports,
        ]);
    }
    // getでreports/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $report = new Report;

        return view('reports.create', [
            'report' => $report,
        ]);
    }

    // postでreports/にアクセスされた場合の「新規登録処理」
        public function store(Request $request)
    {
        $report = new Report;
        $report->content = $request->content;
        $report->save();

        return redirect('/');
    }

    // getでreports/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $report = Report::find($id);

        return view('reports.show', [
            'report' => $report,
        ]);
    }

    // getでreports/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $report = Report::find($id);

        return view('reports.edit', [
            'report' => $report,
        ]);
    }

    // putまたはpatchでreports/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->content = $request->content;
        $report->save();

        return redirect('/');
    }

    // deleteでreports/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();

        return redirect('/');
    }
}
