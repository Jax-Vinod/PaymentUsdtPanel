<?php

namespace App\Http\Controllers;

use App\DataTables\NoticeDataTable;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param NoticeDataTable $datatable
     *
     * @return Yajra\DataTables\DataTables
     */
    public function index(Request $request, NoticeDataTable $datatable)
    {
        return $datatable->render($request);
    }

    /**
     * Return Notice detail by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Notice::find($id));
    }

    /**
     * Store a newly created Notice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'trader_id' => ['required'],
            'documents' => ['required'],
        ]);

        $data = $request->all();
        $data['document'] = implode(',', $request->documents);
        $data['agent_id'] = auth()->id();

        Notice::create($data);
        return response()->json(['message' => 'Created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $Notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $Notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notice::find($id)->delete();
        return redirect('/#/notices');
    }
}
