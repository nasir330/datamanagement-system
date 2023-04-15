<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NeType;

class NeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //create variable and assign data
       $neTypes = [
            [
                'ne_type' => 'Default NeType',
                'domainId' => '1',
            ],
            [
                'ne_type' => 'SuperAdmin NeType',
                'domainId' => '2',
            ]                    
        ];

        //create a loop to run multiple
        foreach($neTypes as $key=> $neType){
            NeType::create($neType);     
        }
    }
}
