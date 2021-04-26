<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class CustomersExport implements FromCollection,WithHeadings,WithMapping
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
            'Amount Spend'
        ];
    }
    public function map($customer): array
    {
       $total_orders= NumberOfOrder($customer->id);
        $total_order=$total_orders["total_order"];
        $total_amount_expand=$total_orders["total_amount_expand"];

        return [
            $customer->customer_name,
            $customer->customer_email,
            $customer->customer_mobile,
            $total_order,
            $total_amount_expand,
           
        ];
    }

}
