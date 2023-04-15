<?php

namespace App\Exports;

use App\Models\HuAlarm;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class HuAlarmExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, WithEvents, ShouldAutoSize, WithTitle
{
    use Exportable;

    //query data
    public function query()
    {
          return HuAlarm::query();
    }
    //set sheet title
    public function title(): string
    {
        $currentDateTime = Carbon::now();
        return 'Reporting Date : ' . $currentDateTime;
    }
    //mapping data
    public function map($huAlarm): array
    {
        return [
            $huAlarm->username,
            $huAlarm->logSNumber,
            $huAlarm->oIName,
            $huAlarm->objIden,
            $huAlarm->nType,
            $huAlarm->identity,
            $huAlarm->aSource,
            $huAlarm->eAlrmSN,
            $huAlarm->aName,
            $huAlarm->type,
            $huAlarm->sev,
            $huAlarm->status,
            $huAlarm->oTime,
            $huAlarm->ackTime,
            $huAlarm->cTime,
            $huAlarm->unAckOper,
            $huAlarm->clrOper,
            $huAlarm->locInfor,
            $huAlarm->lnkFDN,
            $huAlarm->lnkName,
            $huAlarm->ltype,
            $huAlarm->alrmIdent,
            $huAlarm->alrmId,
            $huAlarm->oType,
            $huAlarm->autoClear,
            $huAlarm->aCType,
            $huAlarm->busaffected,
            $huAlarm->addText,
            $huAlarm->arriUtcTime,
            $huAlarm->lstid,
            $huAlarm->relLogId,
            $huAlarm->aid,
            $huAlarm->rid,
        ];            
    }

    //table heading
   public function headings(): array
   {
       return [
           'username',
           'logSNumber',
           'oIName',
           'objIden',
           'nType',
           'identity',
           'aSource',
           'eAlrmSN',
           'aName',
           'type   ',
           'sev',
           'status',
           'oTime',
           'ackTime',
           'cTime',
           'unAckOper',
           'clrOper',
           'locInfor',
           'lnkFDN',
           'lnkName',
           'ltype',
           'alrmIdent',
           'alrmId',
           'oType',
           'autoClear',
           'aCType',
           'busaffected',
           'addText',
           'arriUtcTime',
           'lstid',
           'relLogId',
           'aid',
           'rid',           
       ];
   }
   //formating coloumn
   public function columnFormats(): array
   {
       return [
           'B' => NumberFormat::FORMAT_NUMBER,
           // 'B' is the second column (Column 2), change it to match your needs
       ];
   }

   //formating header row
   public function registerEvents(): array
   {
       return [
           AfterSheet::class    => function(AfterSheet $event)
            {
               $event->sheet->getStyle('A1:AI1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => '3399CC',
                        ],
                    ],
                ]); 
           },
       ];
   }
}
