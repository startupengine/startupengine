<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    /**
     * Show the API Blueprint documentation.
     *
     * @param BlueprintDocs $blueprintDocs
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\M165437\BlueprintDocs\BlueprintDocs $blueprintDocs)
    {
        $api = $blueprintDocs
            ->parse(config('blueprintdocs.blueprint_file'))
            ->getApi();
        return view('docs.index', compact('api'));
    }
}
