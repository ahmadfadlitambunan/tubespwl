<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Grade;
use App\Models\Method;
use App\Models\Saving;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Category;
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
        User::factory(6)->create();

        
        
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
        
        Category::create([
            'name' => 'Kursus',
        ]);
        
        Category::create([
            'name' => 'Workshop',
        ]);
        
        Category::create([
            'name' => 'Sosial',
        ]);
        
        Category::create([
            'name' => 'Lomba'
        ]);
        
        Category::create([
            'name' => 'Beasiswa'
        ]);
        
        Grade::create([
            'name' => 'Kelas 1',
            'user_id'=> 1
        ]);
        
        Grade::create([
            'name' => 'Kelas 2',
            'user_id'=> 2
        ]);
        
        Grade::create([
            'name' => 'Kelas 3',
            'user_id'=> 3
        ]);
        
        Grade::create([
            'name' => 'Kelas 4',
            'user_id'=> 4
        ]);
        Grade::create([
            'name' => 'Kelas 5',
            'user_id'=> 5
        ]);
        Grade::create([
            'name' => 'Kelas 6',
            'user_id'=> 6
        ]);
        
        Student::factory(30)->create();
        Saving::factory(60)->create();
    }
}
