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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;
class OrderComplete implements FromCollection,WithMapping,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=DB::table('orders')->select('customer_name',"created_at","id","updated_at","orders_status","customer_name","customer_phone","coupon_value","final_price","customer_address")->where('orders_status','=',5)
        ->OrderBy("created_at")
        ->get();
       return collect($data);
    }
    public function map($data): array
    {

        if($data->orders_status==6){
            $order_cancel_by="Admin";
        }
        if($data->orders_status==7){
          $order_cancel_by="Customer";
        }
        if($data->coupon_value>0){
          $Discounted="Yes";
        }else{
            $Discounted="No";
        }
     $totalItem=TotalItemInOrder($data->id);
        return[
           $data->id,
           date("d-F-Y",strtotime($data->created_at)),
        
           $data->customer_name,
           $data->customer_phone,
           $data->final_price,
           date("h:i a",strtotime($data->created_at)),
           $totalItem,
           $data->customer_address
        ];

    }
    public function headings(): array
    {
        return [
            "Order Id",
            "Order Date",
          
            "Customer Name",
            "Customer Mobile #",
            "Amount",
            "Order Date",
            "Total Item",
            "Addrees"
        ];
    }
 #
   public function registerEvents(): array
   {
     
       return [
    
           AfterSheet::class    => function(AfterSheet $event) {
            $columns=["A","B","C","D","E","F","G","H","I"];
               foreach ($columns as $column) {
                 # code...
               
               $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize("true");
               }
           },
       ];
   }
}
