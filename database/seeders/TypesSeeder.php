<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //create variable and assign data
         $types = [
            ['type' => 'Default Type'],
            ['type' => 'SuperAdmin Type']           
        ];

        //create a loop to run multiple
        foreach($types as $key=> $type){
            Type::create($type);     
        }
    }
}
