<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JournalHeader;
use App\Models\JournalDetail;
use App\Models\Employee;
use App\Models\Operator;
use App\Models\Process;
use App\Models\Machines;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Rule\Parameters;

class JournalController extends Controller
{
    public function daily($operation_date)
    {
        // SQL Server ---------------------------------------------
        // $sql = "     SELECT "
        //     . "  MIN(v1.process_id) process_id "
        //     . "  , MIN(v1.process_name) process_name "
        //     . "  , MIN(v1.operation_hours) operation_hours "
        //     . "  , MIN(v1.detail_id) detail_id "
        //     . "  , STUFF(  "
        //     . "    (  "
        //     . "      SELECT "
        //     . "        ', ' + employee_name  "
        //     . "      FROM "
        //     . "        uv_daily_journal v2  "
        //     . "      WHERE "
        //     . "        v2.detail_id = v1.detail_id  "
        //     . "      ORDER BY "
        //     . "        v2.detail_id FOR XML PATH ('') "
        //     . "    ) , 1, 1, ''  "
        //     . "  ) AS employee_name  "
        //     . " FROM "
        //     . "  uv_daily_journal v1  "
        //     . " WHERE "
        //     . " operation_date = '" .  $operation_date . "' "
        //     . " GROUP BY "
        //     . "  v1.detail_id "
        //     . " ORDER BY "
        //     . "  v1.detail_id ";

        // MySQL ---------------------------------------------
        $sql = "SELECT "
            . "  v1.process_id "
            . "  , v1.process_name "
            . "  , v1.operation_hours "
            . "  , v1.detail_id "
            . "  , GROUP_CONCAT(v1.employee_name) employee_name "
            . "FROM "
            . "  uv_daily_journal v1  "
            . "WHERE "
            . "  operation_date = '" .  $operation_date . "' "
            . "GROUP BY "
            . "  operation_date  "
            . "  , detail_id  "
            . "ORDER BY "
            . "  v1.detail_id ";
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
            . " DATE_FORMAT(operation_date, '%Y-%m') = '" . $operation_month . "'"
            . "GROUP BY "
            . " operation_date "
            . "ORDER BY "
            . " operation_date ";
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
        $journals = JournalHeader::all();
        return view('journal.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all()->where('state', '0');
        $processes = Process::all()->where('state', '0');
        $machines = Machines::all()->where('state', '0');
        return view('journal.create', compact('employees', 'processes', 'machines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = JournalHeader::create($request->only(['state', 'operation_date', 'author_id']));
        $request->merge(['journal_header_id' => $data->id]);

        $data = JournalDetail::create($request->only(['state', 'journal_header_id', 'process_id', 'operation_hours']));
        $request->merge(['journal_detail_id' => $data->id]);

        if (is_array($request->input('employee_id'))) {
            $operator = new Operator();
            foreach ($request->input('employee_id') as $e) {
                $operator->create([
                    'state' => $request->input(['state']),
                    'journal_detail_id' => $request->input(['journal_detail_id']),
                    'employee_id' => $e,
                ]);
            }
        }
        return redirect()->route('journal.monthly', date('Y-m'))->with('success', '新規登録完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = JournalHeader::find($id);
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
        $employees = Employee::all()->where('state', '0');
        $processes = Process::all()->where('state', '0');

        $sql = "SELECT  "
            . " * "
            . "FROM "
            . " uv_daily_journal v  "
            . "WHERE "
            . " detail_id = '" .  $id . "' ";
        $journals = DB::select($sql);
        // dd($journals);
        return view('journal.edit', compact('journals', 'employees', 'processes'));
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
// dd($request);
        $update = [
            'work_date' => $request->work_date,
            'author_id' => $request->author_id,
            'content' => $request->content
        ];
        JournalHeader::where('id', $id)->update($update);
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
        JournalHeader::where('id', $id)->delete();
        return redirect()->route('journal.index')->with('success', '削除完了しました');
    }
}
