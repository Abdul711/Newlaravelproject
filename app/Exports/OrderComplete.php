<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
class OrderComplete implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=DB::table('orders')->select('customer_name',"created_at","id","updated_at","customer_name","customer_phone","coupon_value","final_price")->where('orders_status','=',5)->get();
       return collect($data);
    }
    public function map($data): array
    {
        return[
           $data->id,
           date("d-F-Y",strtotime($data->created_at)),
           $data->customer_name,
           $data->customer_phone,
           $data->final_price
        ];

    }
    public function headings(): array
    {
        return [
            "Order Id",
            "Order Date",
            "Customer Name",
            "Customer Mobile #",
            "Amount Earned"
        ];
    }
}
