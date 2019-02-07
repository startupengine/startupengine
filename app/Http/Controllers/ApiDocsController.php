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
        if (is_dir(docsPath() . $file)) {
            $input = file_get_contents(
                docsPath() . '/' . $file . '/' . firstDoc($file)
            );
        } else {
            $input = file_get_contents(docsPath() . $file);
        }

        $output = Markdown::convertToHtml($input);

        $folder = $file;
        $file = config('docs.docs_index_file');
        return view('docs.index_md', compact('output', 'folder', 'file'));
    }

    /**
     * Show the requested nested documentation file.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewNested($folder, $file)
    {
        $path = docsPath() . $folder . '/' . $file;
        $isDir = is_dir($path);
        if ($isDir) {
            $index = firstDoc($folder);
            $path = $path . '/' . $index;
        }

        $exists = file_exists($path);

        $input = file_get_contents($path);

        $output = Markdown::convertToHtml($input);

        if ($isDir) {
            $subfolder = $file;
        } else {
            $subfolder = null;
        }

        return view(
            'docs.index_md',
            compact('output', 'folder', 'subfolder', 'file')
        );
    }

    /**
     * Show the requested nested documentation file.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSubNested($folder, $subfolder, $file)
    {
        $input = file_get_contents(
            docsPath() . $folder . '/' . $subfolder . '/' . $file
        );

        $output = Markdown::convertToHtml($input);

        return view(
            'docs.index_md',
            compact('output', 'folder', 'subfolder', 'file')
        );
    }
}
