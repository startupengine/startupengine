<?php

namespace App\Http\Controllers;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    /**
     * Show the default documentation file.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = file_get_contents(config('docs.docs_index'));

        $file = config('docs.docs_index_file');

        $folder = config('docs.docs_root_folder');

        $output = Markdown::convertToHtml($input);

        return view('docs.index_md', compact('output', 'folder', 'file'));
    }

    /**
     * Show the requested documentation file.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($file)
    {
        $input = file_get_contents(docsPath() . $file);

        $output = Markdown::convertToHtml($input);

        return view('docs.index_md', compact('output'));
    }

    /**
     * Show the requested nested documentation file.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewNested($folder, $file)
    {
        $input = file_get_contents(docsPath() . $folder . '/' . $file);

        $output = Markdown::convertToHtml($input);

        return view('docs.index_md', compact('output', 'folder', 'file'));
    }
}
