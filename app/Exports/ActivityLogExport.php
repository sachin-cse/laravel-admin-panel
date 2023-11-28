<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityLogExport implements FromCollection,WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function collection()
    {
        return collect([$this->data]);
    }
    

    public function map($row): array
    {
        // Check if $row is an array
        if (!is_array($row)) {
            // Handle the case where $row is not an array (log an error, throw an exception, etc.)
            // For now, returning an empty array
            return [null, null, null, null, null, null];
        }
    
        return [
            'id' => $row['id'],
            'current_logged_id' => $row['current_logged_id'],
            'ip_address' => $row['ip_address'],
            'user_type' => $row['user_type'],
            'user_name' => $row['user_name'],
            'device_access' => $row['device_access'],
            // Add more columns as needed
        ];
    }

        /**
    * @return array
    */
    public function headings(): array
    {
        // Define the column headings for your Excel sheet
        return [
            'id',
            'current_logged_id',
            'ip_address',
            'user_type',
            'user_name',
            'device_access'
        ];
    }
}
