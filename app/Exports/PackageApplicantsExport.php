<?php

namespace App\Exports;

use App\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PackageApplicantsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithMapping
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Package::findOrFail($this->id)->users;
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
            AfterSheet::class => function (AfterSheet $event) {
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
