<?php

namespace App\Imports;

use App\Models\HuAlarm;
use App\Models\NeType;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class HuAlarmImport implements ToModel, WithValidation, SkipsOnFailure
{
    use Importable;

    public function model(array $row)
    {
        if (empty(array_filter($row))) {
            return null; // Skip the row if it's empty
        }
        return new HuAlarm([
            'username' => $row[0],
            'logSNumber' => $row[1],
            'oIName' => $row[2],
            'objIden' => $row[3],
            'nType' => $row[4],
            'identity' => $row[5],
            'aSource' => $row[6],
            'eAlrmSN' => $row[7],
            'aName' => $row[8],
            'type' => $row[9],
            'sev' => $row[10],
            'status' => $row[11],
            'oTime' => $row[12],
            'ackTime' => $row[13],
            'cTime' => $row[14],
            'unAckOper' => $row[15],
            'clrOper' => $row[16],
            'locInfor' => $row[17],
            'lnkFDN' => $row[18],
            'lnkName' => $row[19],
            'ltype' => $row[20],
            'alrmIdent' => $row[21],
            'alrmId' => $row[22],
            'oType' => $row[23],
            'autoClear' => $row[24],
            'aCType' => $row[25],
            'busaffected' => $row[26],
            'addText' => $row[27],
            'arriUtcTime' => $row[28],
            'lstid' => $row[29],
            'relLogId' => $row[20],
            'aid' => $row[31],
            'rid' => $row[32],
            
        ]);
    }
    
    public function rules(): array
    {
       
        return [
            '4' => [
                'required',
                Rule::exists('ne_types', 'ne_type')
            ],
         
        ];
    }
    public function onFailure(Failure ...$failures)
    {
        session()->flash('delete-success', 'can not import invalid or empty data for any rows!!');
        return redirect()->route('createHuAlarm');
    }
   
}
