<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
class CustomersExport implements FromCollection,WithHeadings,WithMapping,WithColumnWidths,WithStyles,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Number Of Order',
            'Amount Spend',
            "Last Order (Date)",
            "Last Order (Time)",
        ];
    }
    public function map($customer): array
    {
       $total_orders= NumberOfOrder($customer->id);
        $total_order=$total_orders["total_order"];
        $total_amount_expand=$total_orders["total_amount_expand"];
        if($total_amount_expand!="no_order"){
            $total_amount_expand=$total_amount_expand;
           }else{
            $total_amount_expand="No Order Placed";
           }
        return [
            $customer->customer_name,
            $customer->customer_email,
            $customer->customer_mobile,
            $total_order,
            $total_amount_expand,
          
        Last_order_date($customer->id),
        Last_order_time($customer->id),
        ];
    }
 public function columnWidths(): array
 {
  return [
'A'=>55,
"B"=>45,
"C"=>35,
"D"=>25,
"E"=>24,
"F"=>25,
"G"=>24,

  ];  

}
public function styles(Worksheet $sheet)
{
    return [
        // Style the first row as bold text.
        "A1"   => ['font' => ['bold' => true,'name'=>'Aharoni']],

        // Styling a specific cell by coordinate.
        'B1' => ['font' => ['name'=>"Algerian"]],

        // Styling an entire column.
        'C1'  => ['font' => ['size' =>16,"name"=>"Elephant"]],
        'D1'=>["font"=>["name"=>"Eras Bold ITC","color"=>array('rgb' =>"000")]],
        'E1'=>["font"=>["name"=>"Euphemia"]],
    ];
   
}
public function columnFormats(): array
{
    return [
        'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
    ];
}
}
