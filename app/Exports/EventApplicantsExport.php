<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EventApplicantsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithMapping
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Event::findOrFail($this->id)->users;
    }

    public function headings(): array
    {
        return [
            'Registration Type',
            'CMS ID (only for nustians)',
            'UserName',
            'Full Name',
            'Email',
            'Email Verified On',
            'Package Name',
            'Mobile no.',
            'Emergecy Contact no.',
            'Gender',
            'CNIC',
            'Registered at',
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
            isset($invoice->data['registration_type']) ? $invoice->data['registration_type'] : 'N/A',
            isset($invoice->data['cms_id']) ? $invoice->data['cms_id'] : 'N/A',
            isset($invoice->name) ? $invoice->name : 'N/A',
            isset($invoice->data['full_name']) ? $invoice->data['full_name'] : 'N/A',
            isset($invoice->email) ? $invoice->email : 'N/A',
            isset($invoice->email_verified_at) ? $invoice->email_verified_at->isoFormat('D MMMM, Y') : 'N/A',
            $invoice->package()->exists() ? ucwords($invoice->package->name) : 'N/A',
            isset($invoice->data['mobile_no']) ? $invoice->data['mobile_no'] : 'N/A',
            isset($invoice->data['emergency_contact']) ? $invoice->data['emergency_contact'] : 'N/A',
            isset($invoice->data['gender']) ? $invoice->data['gender'] : 'N/A',
            isset($invoice->data['cnic']) ? $invoice->data['cnic'] : 'N/A',
            isset($invoice->created_at) ? $invoice->created_at->isoFormat('D MMMM, Y') : 'N/A',
        ];
    }
}
