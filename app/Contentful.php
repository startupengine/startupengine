<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contentful extends Model
{
    public function import() {
        $path = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $path = $path.'contentful/default-space.json';
        $string = "contentful-import --management-token CFPAT-9059d541f561c9a95b7fd778350c1eb1986fb8933a70abae31025dd948108b25 --space-id x5o3atz1wqhm --content-file $path";
        exec($string, $output);
        return $output;
    }
}
