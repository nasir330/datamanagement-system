<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //create variable and assign data
       $domains = [
            ['domain' => 'Default Domain'],
            ['domain' => 'SuperAdmin Domain']           
        ];

        //create a loop to run multiple
        foreach($domains as $key=> $domain){
            Domain::create($domain);     
        }
    }
}
