<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class CustomersExport implements FromCollection
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
        ];
    }
    public function map($customer): array
    {
        return [
            $customer->customer_name,
            $customer->customer_email,
            $customer->customer_mobile,
           
        ];
    }

}
