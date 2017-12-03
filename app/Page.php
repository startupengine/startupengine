<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;

class Page extends Model implements AuditableContract
{
    use Rememberable;
    use Auditable;

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'title',
        'meta_excerpt',
        'meta_description',
        'json',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Auditable events.
     *
     * @var array
     */
    protected $auditableEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];

    public function raw($path)
    {
        $url = "https://raw.githubusercontent.com/" . env('GITHUB_USERNAME') . "/" . env('GITHUB_REPOSITORY') . "/" . env("GITHUB_REPOSITORY_BRANCH") . "/pages/" . $path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode == 404) {
            return null;
            curl_close($curl);
        } else {
            curl_close($curl);
            return $output;
        }
    }

    public function json()
    {
        $json = json_decode($this->json);
        return $json;

    }

    public function schema()
    {
        if($this->schema !== null) {
            $schema = json_decode($this->schema);
            if(gettype($schema) == "string") {
                $schema = json_decode($schema);
            }
        }
        else {
            $schema = null;
        }
        return $schema;

    }

    public function versions() {
        $json = json_decode($this->json, TRUE);
        $versions = count($json['versions']);
        if($versions == null) { $versions = 0; }

        return $versions;
    }
}