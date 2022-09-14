<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    public function daily($operation_date)
    { 
        $sql = "SELECT * FROM uv_daily_journal "
             . "WHERE "
             . " operation_date = '" .  $operation_date . "'" 
             ;
        $journals = DB::select($sql);
        return view('journal.daily', compact('journals', 'operation_date'));
    }

    public function monthly($operation_month)
    {
        $sql = "SELECT "
             . " operation_date "
             . " , MIN(id) id "
             . "FROM "
             . " journal_headers "
             . "WHERE "
             . " FORMAT(operation_date, 'yyyy-MM') = '" . $operation_month . "'" 
             . "GROUP BY "
             . " operation_date "
             . "ORDER BY "
             . " operation_date "
             ;
        $journals = DB::select($sql);
        return view('journal.monthly', compact('journals'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journals = Journal::all();
        return view('journal.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('journal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Journal::create($request->all());
        return redirect()->route('journal.index')->with('success', '新規登録完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Journal::find($id);
        return view('journal.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Journal::find($id);
        return view('journal.edit', compact('report'));
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
        Journal::where('id', $id)->update($update);
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
        Journal::where('id', $id)->delete();
        return redirect()->route('journal.index')->with('success', '削除完了しました');
    }
}
