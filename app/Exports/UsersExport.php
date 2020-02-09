<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select(
            'name', 'email', 'email_verified_at', 'role_id', 'is_active', 'created_at', 'updated_at'
            )->get();
    }

    public function headings(): array
    {
        return [
            'UserName',
            'Email',
            'Email Verified On',
            'Role',
            'Account Status',
            'Created at',
            'Updated at',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    /**
    * @var Invoice $invoice
    */
    public function map($invoice): array
    {
        return [
            $invoice->name,
            $invoice->email,
            $invoice->email_verified_at->isoFormat('D MMMM, Y'),
            $invoice->role->name,
            $invoice->is_active ? 'active' : 'inactive',
            $invoice->created_at->isoFormat('D MMMM, Y'),
            $invoice->updated_at->isoFormat('D MMMM, Y'),
        ];
    }
}
