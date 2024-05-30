<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        company::create([
            'name'      => 'PT. ABSENSI BAROS',
            'email'     => 'islahatunnufusi07@gmail.com',
            'address'    => 'Gedung Krakatau IT, Jl. Raya Anyer Km. 3, Ciwandan, Citangkil, Cilegon, Warnasari, Kec. Citangkil, Kota Cilegon, Banten 42446',
            'latitude'  => '-6.009475135269353',
            'longitude' => '106.0160705146323',
            'radius_km' => '0.5',
            'time_in'   => '08:00',
            'time_out'  => '17.00'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
