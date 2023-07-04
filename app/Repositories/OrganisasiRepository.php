<?php

namespace App\Repositories;

use App\Helpers\RestApiFormatter;

class OrganisasiRepository
{
    public function get()
    {
        $body = ['all_fields' => true];
        $resOrg = RestApiFormatter::get('organization_list', $body);
        return $resOrg->result;
    }
}
