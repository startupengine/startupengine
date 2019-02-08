<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Blueprint Docs
    |--------------------------------------------------------------------------
    |
    | Find your rendered docs at the given route or set route to false if you
    | want to use your own route and controller. Provide a fully qualified
    | path to your API blueprint as well as to the required Drafter CLI.
    |
    */

    'route' => null, //'api-docs'

    'condense_navigation' => false,

    'docs_index' => base_path(
        'storage/docs/content/getting started/0-readme.md'
    ),

    'docs_index_file' => '0-readme.md',

    'docs_root_folder' => 'getting started',

    'drafter' => base_path('drafter')
];
