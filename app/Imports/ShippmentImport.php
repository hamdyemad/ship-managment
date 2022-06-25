<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\City;
use App\Models\Shippment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Validation\Rule;
use Throwable;


class ShippmentImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation

{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param array$row
     * @return\Illuminate\Database\Eloquent\Model null
     */

    public function model(array $row)
    {

        $city = City::where('city', $row['city'])->first();
        $area = Area::where('area', $row['area'])->first();

        if ($city == null) {
            $cityId = 1;
        } else {
            $cityId = $city->id;
        }

        if ($area == null) {
            $areaId = 1;
        } else {
            $areaId = $area->id;
        }

        // $areaId = $area->id;

        $area = Area::where('id', 2)->get();
        $shippment = new Shippment();
        $shippment->shippment_type = $row['shippment_type'];
        $shippment->shipper = $row['shipper_name'];
        $shippment->city_id =  $cityId;
        $shippment->area_id = $areaId;
        $shippment->business_referance = $row['business_referance'];
        $shippment->receiver_name = $row['receiver_name'];
        $shippment->receiver_phone = $row['phone_number'];
        $shippment->user_id = auth()->user()->id;
        $shippment->allow_open = $row['allow_open'];
        $shippment->price = $row['price'];
        $shippment->package_details = $row['package_details'];
        $shippment->address = $row['address'];
        $shippment->note = $row['note'];
        $shippment->status = $row['status'];
        $shippment->barcode = random_int(100000, 999999);
        $isSaved = $shippment->save();
        return  $shippment;
    }
    public function rules(): array
    {
        return [
            '*.shippment_type' => 'required',
            '*.shipper_name' => 'required',
            '*.area' => 'required',
            '*.area' => 'required',
            '*.business_referance' => 'required',
            '*.receiver_name' => 'required',
            '*.shippment_type' => 'required',
            '*.phone_number' => 'required',
            '*.allow_open' => 'required',
            '*.price' => 'required',
            '*.package_details' => 'required',
            '*.address' => 'required',
            '*.note' => 'required',
            '*.status' => 'required',

        ];
    }
    public function chunkSize(): int
    {
        return 1000;
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
