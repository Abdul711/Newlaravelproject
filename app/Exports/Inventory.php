<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class Inventory implements FromCollection,WithHeadings,WithMapping,WithColumnWidths,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $detail=order_detail_by_date();
        return collect($detail);
    }
    public function headings(): array
    {
        return [
            'Order Date',
            "No Of Order",
            'Amount Earned (Rs)',
        ];
    }
    public function columnWidths(): array
    {
     return [
   'A'=>35,
   "B"=>18,
   "C"=>20
   
     ];  
   
   }
    public function map($detail): array
    {
        $number_of=order_detail_by_date_no($detail->order_date);
        $amount_gain=amount_earned($detail->order_date);
 $dte=strtotime($detail->order_date);
 $datr=date("Y-M-D h:i:s",$dte);
 
        return [
        $detail->order_date,
 $number_of,
 $amount_gain
           
        ];
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
           
        ];
    }
}
