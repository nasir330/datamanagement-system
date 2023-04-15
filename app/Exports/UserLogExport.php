<?php

namespace App\Exports;

use App\Models\UserLog;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;

class UserLogExport implements FromQuery, WithMapping, WithHeadings, WithEvents, ShouldAutoSize, WithTitle
{
    use Exportable;
    
    
    //query data
    public function query()
    {
        return UserLog::query();
    }
    //set sheet title
    public function title(): string
    {
        $currentDateTime = Carbon::now();
        return 'Reporting Date : ' . $currentDateTime;
    }    

    //mapping data
    public function map($userLog): array
    {
        if(!empty($userLog->activitylog)){
            return [
                $userLog->id,
                $userLog->user->username,
                $userLog->type,
                $userLog->activitylog->activity,
                $userLog->created_at,           
               
            ];
        }else{
            return [
                $userLog->id,
                $userLog->user->username,
                $userLog->type,
                'No Activity',
                $userLog->created_at,           
               
            ];
        }
        
    }
   //table heading
   public function headings(): array
   {
       return [
           '#',
           'Username',
           'Type',
           'Activitty',
           'Log time',
       ];
   }

   //formationg header row
   public function registerEvents(): array
   {
       return [
           AfterSheet::class    => function(AfterSheet $event)
            {
               $event->sheet->getStyle('A1:E1')->applyFromArray([
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
