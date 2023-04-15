<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Severity;

class SeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create variable and assign data
       $severityTypes = [
            ['severity' => 'Major'],
            ['severity' => 'Urgent']           
        ];

        //create a loop to run multiple
        foreach($severityTypes as $key=> $severity){
            Severity::create($severity);     
        }



    }
}
