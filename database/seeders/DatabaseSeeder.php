<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


/*class Patient extends Model {
    use HasFactory;
}*/

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
<<<<<<< HEAD
    public function run()
    {
       // $this->call(AdminsTablesSeeder::class);
       $this->call(PatientSeeder::class);
        
    }
=======

>>>>>>> a0e2e1658a727c4fa1af3716dd56077fd9602bb1
}

