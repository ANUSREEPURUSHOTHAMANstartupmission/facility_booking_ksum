<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    public function index(Request $request)
    {
        $start = Carbon::now()->subMonth()->toDateString();
        $end = Carbon::now()->toDateString(); 

        return view('admin.export', compact('start', 'end'));
    }

    public function store(Request $request)
    {
        $start = $request->input('start') ?? Carbon::now()->subMonth()->toDateString();
        $end = $request->input('end') ?? Carbon::now()->toDateString();

        return Excel::download(new BookingExport($start, $end), 'booking.xlsx');
    }
}
