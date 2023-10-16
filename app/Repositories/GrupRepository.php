<?php

namespace App\Repositories;

use App\Helpers\RestApiFormatter;

class GrupRepository
{
    public function get()
    {
        $body = ['all_fields' => true];
        $resGrup = RestApiFormatter::get('group_list', $body);
        return $resGrup->result;
    }
}
