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

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
class Inventory implements FromCollection,WithHeadings,WithMapping,WithColumnWidths,WithColumnFormatting,WithEvents
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
        
            'Total Product (Sold)',
            "Completion Ratio (%)",
        
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
   "F"=>23,
   "G"=>22,
   "H"=>23,
     ];  
   
   }
    public function map($detail): array
    {
        $number_of=order_detail_by_date_no($detail->order_date);
        $amount_gain=amount_earned($detail->order_date);
 $dte=strtotime($detail->order_date);
 $dte=date("d-F-Y",$dte);
 $total_item=total_item($detail->order_date);
 $total_qty=total_qty($detail->order_date);
 $order_complete=order_complete($detail->order_date);
 $order_cancel=order_cancel($detail->order_date);
        return [
        $dte,
 $number_of,
 $amount_gain,
$total_qty,
number_format(($order_complete/$number_of)*100,2),
        
        ];
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
           
        ];
    }

    public function registerEvents(): array
    {
        $total_earning=TotalAdminEarning();
        $earnings=$total_earning;
       $gst=floor(20/100*TotalAdminEarning());
        return [
     
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setCellValue("C".TotalAdminEarningRecords(2),TotalAdminEarning()." Rs ");
                $event->sheet->setCellValue("B".TotalAdminEarningRecords(2),"Total Earning");
                $event->sheet->setCellValue("C".TotalAdminEarningRecords(3),gst(TotalAdminEarning())." Rs ");
                $event->sheet->setCellValue("B".TotalAdminEarningRecords(3),"Gst");
                $event->sheet->setCellValue("C".TotalAdminEarningRecords(4),final_earning(TotalAdminEarning())." Rs ");
                $event->sheet->setCellValue("B".TotalAdminEarningRecords(4),"Final Earning");
            },
        ];
    }
}
