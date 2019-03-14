<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Deployment Type
    |--------------------------------------------------------------------------
    |
    | This value is used to determine whether this deployment can be controlled remotely (slave deployment)
    | or can control other deployed instances (master deployment)
    |
    */

    'deployment_type' => env('APP_DEPLOYMENT_TYPE', 'master')
];
