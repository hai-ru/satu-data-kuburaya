<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleMasterAdmin = Role::create([
            'name'  => 'masteradmin'
        ]);

        $roleMasterAdmin->givePermissionTo([
            // Manajemen User   
            'permissions-browse',
            'permissions-read',
            'permissions-edit',
            'permissions-add',
            'permissions-delete',

            'roles-browse',
            'roles-read',
            'roles-edit',
            'roles-add',
            'roles-delete',

            'users-browse',
            'users-read',
            'users-edit',
            'users-add',
            'users-delete',

            // slider
            'slider-browse',
            'slider-read',
            'slider-edit',
            'slider-add',
            'slider-delete',

            // Testimoni
            'testimoni-browse',
            'testimoni-edit',
            'testimoni-add',
            'testimoni-delete',
            'testimoni-update-status',

            // Unduhan
            'unduhan-browse',
            'unduhan-edit',
            'unduhan-add',
            'unduhan-delete',

            // Infografik
            'infografik-browse',
            'infografik-read',
            'infografik-edit',
            'infografik-add',
            'infografik-delete',

            // Dataset
            'dataset-browse',
            'dataset-read',
            'dataset-edit',
            'dataset-add',
            'dataset-delete',

            // File Dataset
            'file-dataset-browse',
            'file-dataset-read',
            'file-dataset-edit',
            'file-dataset-add',
            'file-dataset-delete',

            // Target Capaian
            'target-capaian-browse',
            'target-capaian-read',
            'target-capaian-edit',
            'target-capaian-add',
            'target-capaian-delete',

            // Group
            'group-browse',
            'group-read',
            'group-edit',
            'group-add',
            'group-delete',

            // Perangkat Daerah
            'perangakat-daerah-browse',
            'perangakat-daerah-read',
            'perangakat-daerah-edit',
            'perangakat-daerah-add',
            'perangakat-daerah-delete',
        ]);

        $roleSuperadmin = Role::create([
            'name'  => 'superadmin'
        ]);

        $roleSuperadmin->givePermissionTo([
            // Manajemen User
            'roles-browse',
            'roles-read',
            'roles-edit',
            'roles-add',
            'roles-delete',

            'users-browse',
            'users-read',
            'users-edit',
            'users-add',
            'users-delete',

            // slider
            'slider-browse',
            'slider-read',
            'slider-edit',
            'slider-add',
            'slider-delete',

            // Testimoni
            'testimoni-browse',
            'testimoni-update-status',

            // Unduhan
            'unduhan-browse',

            // Infografik
            'infografik-browse',
            'infografik-read',
            'infografik-edit',
            'infografik-add',
            'infografik-delete',

            // Dataset
            'dataset-browse',
            'dataset-read',
            'dataset-edit',
            'dataset-add',
            'dataset-delete',

            // File Dataset
            'file-dataset-browse',
            'file-dataset-read',
            'file-dataset-edit',
            'file-dataset-add',
            'file-dataset-delete',

            // Target Capaian
            'target-capaian-browse',
            'target-capaian-read',
            'target-capaian-edit',
            'target-capaian-add',
            'target-capaian-delete',

            // Group
            'group-browse',
            'group-read',
            'group-edit',
            'group-add',
            'group-delete',

            // Perangkat Daerah
            'perangakat-daerah-browse',
            'perangakat-daerah-read',
            'perangakat-daerah-edit',
            'perangakat-daerah-add',
            'perangakat-daerah-delete',
        ]);

        $roleWalidata = Role::create([
            'name'  => 'walidata'
        ]);
        $roleWalidata->givePermissionTo([
            // slider
            'slider-browse',
            'slider-read',
            'slider-edit',
            'slider-add',
            'slider-delete',

            // Testimoni
            'testimoni-browse',
            'testimoni-update-status',

            // Unduhan
            'unduhan-browse',

            // Infografik
            'infografik-browse',
            'infografik-read',
            'infografik-edit',
            'infografik-add',
            'infografik-delete',

            // Dataset
            'dataset-browse',
            'dataset-read',
            'dataset-edit',

            // File Dataset
            'file-dataset-browse',
            'file-dataset-read',
            'file-dataset-edit',

            // Target Capaian
            'target-capaian-browse',
            'target-capaian-read',
            'target-capaian-edit',
            'target-capaian-add',
            'target-capaian-delete',
        ]);

        $roleOPD = Role::create([
            'name'  => 'perangkat-daerah'
        ]);
        $roleOPD->givePermissionTo([
            // Unduhan
            'unduhan-browse',
            
            // Dataset
            'dataset-browse',
            'dataset-read',
            'dataset-edit',
            'dataset-add',
            'dataset-delete',

            // File Dataset
            'file-dataset-browse',
            'file-dataset-read',
            'file-dataset-edit',
            'file-dataset-add',
            'file-dataset-delete',

            // Target Capaian
            'target-capaian-browse',
            'target-capaian-read',
            'target-capaian-edit',
            'target-capaian-add',
            'target-capaian-delete',
        ]);
    }
}
