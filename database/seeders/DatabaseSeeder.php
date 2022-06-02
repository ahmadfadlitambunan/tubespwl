<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Method;
use App\Models\Saving;
use App\Models\Student;
use App\Models\Payment;
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
        User::factory(10)->create();
        Student::factory(60)->create();
        Saving::factory(30)->create();

        // Seeder Method Nabung
        Method::create([
            'name' => 'Manual',
        ]);

        Method::create([
            'name' => 'Transfer',
        ]);

        Payment::create([
            'name' => 'Gopay',
            'a_n' => 'Ahmad Fadli Tambunan',
            'account_no' => '081316616546',
        ]);

        Payment::create([
            'name' => 'BNI',
            'a_n' => 'Bang Tito',
            'account_no' => '1713561564',
        ]);

        Payment::create([
            'name' => 'BRI',
            'a_n' => 'Bang Gihon',
            'account_no' => '844648464',
        ]);
    }
}
