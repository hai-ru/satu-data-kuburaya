<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitable;
use Shetabit\Visitor\Traits\Visitor;

class Page extends Model
{
    use HasFactory;
    use Visitor;
    use Visitable;

    protected $fillable = [
        'name',
        'views'
    ];
}
