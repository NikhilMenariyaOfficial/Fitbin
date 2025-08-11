<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * Retrieve all members for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return Member::all();
    }

    /**
     * Define the headings for the exported Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Sr.no',
            'Name',
            'Member id',
            'Joining date',
            'Membership',
            'Expire date'
        ];
    }

    /**
     * Map the member data for export.
     *
     * @param  mixed  $member
     * @return array
     */
    public function map($member): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            $member->name,
            $member->member_id,
            date('d F Y', strtotime($member->membership_start_date)),
            optional($member->membershipPlan)->name ?? '',
            $member->membership_end_date ? date('d F Y', strtotime($member->membership_end_date)) : ''
        ];
    }

    /**
     * Apply styles to the heading row.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet  $sheet
     * @return array
     */
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]], // Bold style for the first row (headings)
        ];
    }
}
