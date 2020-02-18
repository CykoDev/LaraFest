<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Event;

class EventsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Event::select(
            'name',
            'event_type_id',
            'details',
            'event_date',
            'created_at',
            'updated_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Event Type',
            'Details',
            'Event Date',
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
            $invoice->type->name,
            $invoice->details,
            $invoice->event_date->isoFormat('D MMMM, Y'),
            $invoice->created_at->isoFormat('D MMMM, Y'),
            $invoice->updated_at->isoFormat('D MMMM, Y'),
        ];
    }
}
