<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografik extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'infografik';

    public function gambarInfografik()
    {
        return $this->hasOne(InfografikGambar::class, 'infografik_id', 'id');
    }

    public static function getTipeAvailable(){
        $tipe = ["image","embed"];
        return $tipe;
    }
}
