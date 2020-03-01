<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\User;

class UserEventsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithMapping
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return User::findOrFail($this->id)->events;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Event Type',
            'Details',
            'Start Date/Time',
            'Ending Date/Time',
            'Created at',
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
            isset($invoice->name) ? $invoice->name : 'N/A',
            isset($invoice->type->name) ? $invoice->type->name : 'N/A',
            isset($invoice->details) ? $invoice->details : 'N/A',
            isset($invoice->event_date) ? $invoice->event_date->isoFormat('D/M/Y | h:m') : 'N/A',
            isset($invoice->end_date) ? $invoice->end_date->isoFormat('D/M/Y | h:m') : 'N/A',
            isset($invoice->created_at) ? $invoice->created_at->isoFormat('D MMMM, Y') : 'N/A',
        ];
    }
}
