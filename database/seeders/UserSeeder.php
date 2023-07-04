<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masteradmin = User::create([
            'id' => 1,
            'name' => 'masteradmin',
            'email' => 'masteradmin@data.pontianakkota.go.id',
            'username' => 'masteradmin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin135246'),
            'apikey' => 'b98a01cb-1682-47eb-8e46-9adb9faa825b',
            'organization_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $masteradmin->assignRole('masteradmin');

        $superadmin = User::create([
            'id' => 2,
            'name' => 'Superadmin',
            'email' => 'sysadminckan@data.pontianakkota.go.id',
            'username' => 'sysadminckan_satudataptk',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin135246'),
            'apikey' => 'b98a01cb-1682-47eb-8e46-9adb9faa825b',
            'organization_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $superadmin->assignRole('superadmin');

        $walidata = User::create([
            'id' => 3,
            'name' => 'Bidang Statistik',
            'email' => 'fahmijak@yahoo.com',
            'username' => 'statistik',
            'organization_id' => '',
            'email_verified_at' => now(),
            'password' => Hash::make('statistikdata'),
            'apikey' => '776f1544-ea50-497d-8b22-b642f54f6888',
            'organization_id' => 'd46272f4-47c8-42ff-80b0-74efb51aa53a',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $walidata->assignRole('walidata');

        $bappeda = User::create([
            'id' => 4,
            'name' => 'BAPPEDA',
            'email' => 'bappeda@data.pontianak.go.id',
            'username' => 'bappeda',
            'email_verified_at' => now(),
            'password' => Hash::make('bappeda12345'),
            'apikey' => '776f1544-ea50-497d-8b22-b642f54f6888',
            'organization_id' => 'bf0ca897-9806-473c-9e56-bf49510c3dab',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $bappeda->assignRole('perangkat-daerah');
    }
}