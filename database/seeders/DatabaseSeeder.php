<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UserTypeSeeder::class);
       $this->call(SeveritySeeder::class);
       $this->call(DomainSeeder::class);
       $this->call(NeTypeSeeder::class);
       $this->call(TypesSeeder::class);
    }
}
