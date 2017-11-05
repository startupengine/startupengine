<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ModuleController extends Controller
{
    public function index() {
        $path = \Config::get('view.paths')[0].'/theme/theme.json';
        $theme = json_decode(File::get($path));
        $modules = [];
        foreach($theme->modules as $module) {
            $modulepath = app_path()."/Modules/".$module."/module.json";
            $modules[] = json_decode(File::get($modulepath));
        }
        return view('app.module.index')->with('modules', $modules);
    }
}
