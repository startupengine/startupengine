<?php

function syncPages($defaults = false)
{
    $pages = \App\Page::withTrashed()->get();
    foreach ($pages as $page) {
        $page->delete();
    }

    //Inject Pages if they don't yet exist
    $pages = [];
    $themepath = \Config::get('view.paths')[0] . '/theme';

    if ($defaults == true) {
        $pagepath = \Config::get('view.paths')[0] . '/pages/defaults';
    } else {
        $pagepath = \Config::get('view.paths')[0] . '/theme/pages';
    }

    $pageList = glob($pagepath . "/*");

    foreach ($pageList as $filename) {
        $filename = substr($filename, strrpos($filename, '/') + 1);

        if (file_exists($pagepath . '/' . $filename . '/page.json')) {
            $json = file_get_contents(
                $pagepath . '/' . $filename . '/page.json'
            );
            $json = json_encode(json_decode($json));

            $page = \App\Page::where('slug', '=', $filename)
                ->withTrashed()
                ->first();
            if ($page == null) {
                $page = new \App\Page();
            }
            $page->slug = $filename;
            $page->schema = $json;
            $page->title = ucfirst($filename);
            $page->body = null;
            $page->excerpt = null;
            if ($page->status == null) {
                $page->status = 'INACTIVE';
            }
            $page->save();
            if ($page->deleted_at != null) {
                $page->deleted_at = null;
                $page->save();
            }
            echo "DELETED " .
                $page->title .
                " page at " .
                $page->deleted_at .
                "... ";
            echo "\nSYNCED  $page->title page at $page->deleted_at \n";

            $pages[] = $page;
        }
    }

    foreach ($pages as $page) {
        $page->undelete();
    }
}
