<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'category', 'description', 'proficiency_level', 'endorsements_count'])]
class Skill extends Model
{
    //
}
