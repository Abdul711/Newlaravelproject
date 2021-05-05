<?php

namespace App\Exports;

use App\MonthlyInventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use DB;
class Monthly implements FromCollection,WithMapping,WithHeadings,WithColumnWidths,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $dta=DB::table("monthly_inventories")->distinct()->select("month_name","number_of_days","gst","amount_earned","total_order")->get();
      return collect($dta);
    }
    public function headings(): array
    {
        return [
            'Order Month',
           
        
         "Number Of Days",
        "Gst",
        "Total Order",
        "Amount Earned",
     "Total Earning"
        ];
    }
    public function columnWidths(): array
    {
     return [
   'A'=>35,
   "B"=>18,
   "C"=>20,
   "D"=>21,
   "E"=>22,
   "F"=>21
  
     ];  
   
   }
    public function map($dta): array
    {
        $po=monthly_inve($dta->month_name);

$number_of_day=$po["number_of_day"];
$gst=$po["gst_income"];
$total_order=$po["total_order"];
$final_earning=$po["final_earning"];
        return [
         $dta->month_name,
         $number_of_day,
         $gst,
         $total_order,
         $final_earning,
         $final_earning+$gst
      
        ];
    }
    public function title(): string
    {
    	return 'Some Text';
    }
}
