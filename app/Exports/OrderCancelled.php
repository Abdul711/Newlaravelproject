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
class OrderCancelled implements FromCollection,WithHeadings,WithMapping,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    $data=DB::table('orders')->select('customer_name',"created_at","id","orders_status","updated_at","customer_name","customer_phone","coupon_value","final_price")->where('orders_status','=',6)->
    orwhere('orders_status','=',7)->get();
   return collect($data);
}
    public function headings(): array
    {
        return [
            "Order Id",
            
            "Order Date",
            "Order Time",
            "Order Cancelled By",
            "Total Item",
            "Cancelled Date ",
            "Cancelled Time ",
            "Final Price",
            "Discounted",
            "Active Duration",
"Customer Name",
"Customer Mobile",
         
         
       
        ];
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
    $dated=strtotime($data->created_at);
    $dated=date("d-F-Y",$dated);
    $dated_order=strtotime($data->created_at);
    $time_dated=date("h:i a",$dated_order);
    $cancel_dated_order=strtotime($data->updated_at);
    $cancel_time_dated=date("h:i a",$cancel_dated_order);

    $cancel_dated=date("d-F-Y",$cancel_dated_order);
        return [
            $data->id,
            $dated,
$time_dated,  
$order_cancel_by ,
$totalItem,
$cancel_dated,
$cancel_time_dated,
$data->final_price,
$Discounted,
TimeDifference($data->created_at,$data->updated_at),
$data->customer_name,
$data->customer_phone
        ];
    }
    public function columnWidths(): array
    {
     return [
   'A'=>10,
   "B"=>17,
   "C"=>17,
   "D"=>20,
   "E"=>14,
   "F"=>17,
   "G"=>17,
    "H"=>17,
    "I"=>17,
    "J"=>17,
    "K"=>35,
    "L"=>17   
     ];  
   
   }
}
