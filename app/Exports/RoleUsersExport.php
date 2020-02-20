<?php

namespace App\Exports;

use App\Role;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RoleUsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithMapping
{
    protected $id;

    function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        return Role::whereName($this->role)->firstOrFail()->users;
    }

    public function headings(): array
    {
        if ($this->role == 'applicant') {
            return [
                'Registration Type',
                'CMS ID (only for nustians)',
                'UserName',
                'Full Name',
                'Email',
                'Email Verified On',
                'Mobile no.',
                'Emergecy Contact no.',
                'Gender',
                'CNIC',
                'Registered at',
            ];
        } else {
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
        if ($this->role == 'applicant') {
            return [
                isset($invoice->data['registration_type']) ? $invoice->data['registration_type'] : 'N/A',
                isset($invoice->data['cms_id']) ? $invoice->data['cms_id'] : 'N/A',
                $invoice->name,
                isset($invoice->data['full_name']) ? $invoice->data['full_name'] : 'N/A',
                $invoice->email,
                $invoice->email_verified_at->isoFormat('D MMMM, Y'),
                isset($invoice->data['mobile_no']) ? $invoice->data['mobile_no'] : 'N/A',
                isset($invoice->data['emergency_contact']) ? $invoice->data['emergency_contact'] : 'N/A',
                isset($invoice->data['gender']) ? $invoice->data['gender'] : 'N/A',
                isset($invoice->data['cnic']) ? $invoice->data['cnic'] : 'N/A',
                $invoice->created_at->isoFormat('D MMMM, Y'),
            ];
        } else {
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
}
