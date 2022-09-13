<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // public function daily()
    public function daily($work_date)
    {
        // $reports = Report::all()->where('work_date', $work_date);
        $sql = "SELECT "
             . " * "
             . "FROM "
             . " reports "
             . "WHERE "
             . " work_date = '" . $work_date . "'" 
             ;
        $reports = DB::select($sql);
        // $reports = Report::all()->where('work_date', $work_date);
        return view('report.daily', compact('reports', 'work_date'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT "
             . " work_date "
             . " , MIN(id) id "
             . "FROM "
             . " reports "
             . "WHERE "
             . " FORMAT(work_date, 'yyyy-MM') = '2022-09'" 
             . "GROUP BY "
             . " work_date "
             . "ORDER BY "
             . " work_date "
             ;
        $reports = DB::select($sql);
        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Report::create($request->all());
        return redirect()->route('report.index')->with('success', '新規登録完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);
        return view('report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        return view('report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = [
            'work_date' => $request->work_date,
            'author_id' => $request->author_id,
            'content' => $request->content
        ];
        Report::where('id', $id)->update($update);
        return back()->with('success', '編集完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Report::where('id', $id)->delete();
        return redirect()->route('report.index')->with('success', '削除完了しました');
    }
}
