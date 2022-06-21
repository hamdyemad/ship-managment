<?php

namespace App\Exports;

use App\Models\Shippment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShippmentsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Shippment::all();
    // }
    public $from;
    public $to;

    function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {


        $startDate = $this->from;
        $endDate = $this->to;
        $data = Shippment::with('city', 'area')->where('id', auth()->user()->id)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)->get();
        // dd($data);
        return $data;
    }
}
