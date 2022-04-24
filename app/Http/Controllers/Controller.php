<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Shippment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\PDF417;
use PDF;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index()
    {

        $city = City::all();
        return view('Dashboard.user.settings', ['city' => $city]);
    }

    function fetch(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = Area::where('city_id', $value)->get();

        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->area . '</option>';
        }
        echo $output;
    }

    //download special shipment
    function download($id)
    {
        $show = Shippment::findOrFail($id);
        $pdf = PDF::loadView('dashboard.user.shipment.pdf', compact('show'));

        return $pdf->download('disney.pdf');
    }

    // function select()
    // {
    //     return view('dashboard.user.shipment.select');
    // }

    // print table contain selected shipment
    function index1(Request $req)
    {
        $method = $req->method();

        if ($req->isMethod('post')) {
            $from = $req->input('from');
            $to   = $req->input('to');
            if ($req->has('search')) {
                // select search
                $search = DB::select("SELECT * FROM shippments WHERE created_at BETWEEN '$from' AND '$to'");
                return view('import', ['ViewsPage' => $search]);
            } elseif ($req->has('exportPDF')) {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM shippments WHERE created_at BETWEEN '$from' AND '$to'");
                $pdf = PDF::loadView('dashboard.user.shipment.printtable', ['PDFReport' => $PDFReport])->setPaper('a4', 'landscape');
                return $pdf->download('PDF-report.pdf');
            }
        } else {
            //select all
            $ViewsPage = DB::select('SELECT * FROM users');
            return view('import', ['ViewsPage' => $ViewsPage]);
        }
    }
}
