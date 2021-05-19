<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class AllOrder implements FromCollection,WithHeadings,WithMapping,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=DB::table("orders")->leftJoin("orders_status","orders_status.id","=","orders.orders_status")
        ->select("orders.id as order_id","orders.customer_name","orders.created_at","orders.customer_email","orders_status.status_name"
        ,"orders.customer_phone","orders.final_price","orders.coupon_value","orders.customer_address")
       
       ->orderBy("created_at","asc") ->get();
    return collect($data);
    }   
     public function map($data): array
    {
        return[
         $data->order_id,
             date("d-F-Y",strtotime($data->created_at)),
             date("h:i a",strtotime($data->created_at)),
             $data->customer_name,
             $data->customer_phone,
             $data->customer_address,
             $data->status_name,
             $data->final_price." Rs "
        ];
    }
    public function headings(): array
    {
        return[
"Order Id",
"Order Date",
"Order Time",
"Customer Name",
"Customer Mobile Number",
"Delivery Address",
"Order Status",
"Amount"
        ];
    }

    public function registerEvents(): array
    {
      
        return [
     
            AfterSheet::class    => function(AfterSheet $event) {
              
             $columns=["A","B","C","D","E","F","G"];
                foreach ($columns as $column) {
                  # code...
                
                $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize("true");
                }
            },
        ];
    }

}
