<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Appstract\Meta\Metable;

class Module extends Model
{
    use Metable;

    protected $metaTable = 'modules_meta';
}
