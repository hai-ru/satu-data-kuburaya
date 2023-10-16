<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $data = [
            // Manajemen User
            ['name' => 'permissions-browse', 'group' => 'permissions'],
            ['name' => 'permissions-read', 'group' => 'permissions'],
            ['name' => 'permissions-edit', 'group' => 'permissions'],
            ['name' => 'permissions-add', 'group' => 'permissions'],
            ['name' => 'permissions-delete', 'group' => 'permissions'],

            ['name' => 'roles-browse', 'group' => 'roles'],
            ['name' => 'roles-read', 'group' => 'roles'],
            ['name' => 'roles-edit', 'group' => 'roles'],
            ['name' => 'roles-add', 'group' => 'roles'],
            ['name' => 'roles-delete', 'group' => 'roles'],

            ['name' => 'users-browse', 'group' => 'users'],
            ['name' => 'users-read', 'group' => 'users'],
            ['name' => 'users-edit', 'group' => 'users'],
            ['name' => 'users-add', 'group' => 'users'],
            ['name' => 'users-delete', 'group' => 'users'],

            // slider
            ['name' => 'slider-browse', 'group' => 'slider'],
            ['name' => 'slider-read', 'group' => 'slider'],
            ['name' => 'slider-edit', 'group' => 'slider'],
            ['name' => 'slider-add', 'group' => 'slider'],
            ['name' => 'slider-delete', 'group' => 'slider'],

            // Testimoni
            ['name' => 'testimoni-browse', 'group' => 'testimoni'],
            ['name' => 'testimoni-edit', 'group' => 'testimoni'],
            ['name' => 'testimoni-add', 'group' => 'testimoni'],
            ['name' => 'testimoni-delete', 'group' => 'testimoni'],
            ['name' => 'testimoni-update-status', 'group' => 'testimoni'],

            // Unduhan
            ['name' => 'unduhan-browse', 'group' => 'unduhan'],
            ['name' => 'unduhan-edit', 'group' => 'unduhan'],
            ['name' => 'unduhan-add', 'group' => 'unduhan'],
            ['name' => 'unduhan-delete', 'group' => 'unduhan'],

            // Infografik
            ['name' => 'infografik-browse', 'group' => 'infografik'],
            ['name' => 'infografik-read', 'group' => 'infografik'],
            ['name' => 'infografik-edit', 'group' => 'infografik'],
            ['name' => 'infografik-add', 'group' => 'infografik'],
            ['name' => 'infografik-delete', 'group' => 'infografik'],

            // Dataset
            ['name' => 'dataset-browse', 'group' => 'dataset'],
            ['name' => 'dataset-read', 'group' => 'dataset'],
            ['name' => 'dataset-edit', 'group' => 'dataset'],
            ['name' => 'dataset-add', 'group' => 'dataset'],
            ['name' => 'dataset-delete', 'group' => 'dataset'],

            // File Dataset
            ['name' => 'file-dataset-browse', 'group' => 'file dataset'],
            ['name' => 'file-dataset-read', 'group' => 'file dataset'],
            ['name' => 'file-dataset-edit', 'group' => 'file dataset'],
            ['name' => 'file-dataset-add', 'group' => 'file dataset'],
            ['name' => 'file-dataset-delete', 'group' => 'file dataset'],

            // Target Capaian
            ['name' => 'target-capaian-browse', 'group' => 'target capaian'],
            ['name' => 'target-capaian-read', 'group' => 'target capaian'],
            ['name' => 'target-capaian-edit', 'group' => 'target capaian'],
            ['name' => 'target-capaian-add', 'group' => 'target capaian'],
            ['name' => 'target-capaian-delete', 'group' => 'target capaian'],

            // Group
            ['name' => 'group-browse', 'group' => 'group'],
            ['name' => 'group-read', 'group' => 'group'],
            ['name' => 'group-edit', 'group' => 'group'],
            ['name' => 'group-add', 'group' => 'group'],
            ['name' => 'group-delete', 'group' => 'group'],

            // Perangkat Daerah
            ['name' => 'perangakat-daerah-browse', 'group' => 'perangkat daerah'],
            ['name' => 'perangakat-daerah-read', 'group' => 'perangkat daerah'],
            ['name' => 'perangakat-daerah-edit', 'group' => 'perangkat daerah'],
            ['name' => 'perangakat-daerah-add', 'group' => 'perangkat daerah'],
            ['name' => 'perangakat-daerah-delete', 'group' => 'perangkat daerah'],
        ];

        foreach ($data as $item) {
            Permission::create([
                'name' => $item['name'],
                'group' => $item['group'],
            ]);
        }
    }
}
