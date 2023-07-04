<?php

namespace App\Http\Controllers\Manajemen;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function tagsSearch($search)
    {
        $body = [
            'query' => $search,
        ];
        $resTags = RestApiFormatter::get('tag_search', $body);

        $data = [];
        if ($resTags->success && $resTags->result->count > 0) {
            foreach ($resTags->result->results as $item) {
                $data[] = $item->name;
            }
        }
        
        return response()->json([
            'status' => $resTags->success,
            'message' => 'Memuat daftar tags',
            'total' => $resTags->result->count, 
            'data' => $data,
        ]);
    }
}
