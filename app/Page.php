<?php

namespace App;

use App\Traits\IsApiResource;
use App\Traits\RelationshipsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use GrahamCampbell\Markdown\Facades\Markdown;
use Appstract\Meta\Metable;
use Conner\Tagging\Taggable;
use NexusPoint\Versioned\Versioned;
use App\Traits\hasJsonSchema;
use App\Traits\validateInputAgainstJsonSchema;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Page extends Model implements \Altek\Accountant\Contracts\Recordable
{
    use \Altek\Accountant\Recordable;

    use EloquentJoin;

    use IsApiResource;

    use Metable;

    use Taggable;

    use Versioned;

    use IsApiResource;

    use hasJsonSchema;

    use RelationshipsTrait;

    use validateInputAgainstJsonSchema;

    protected $fillable = ['title'];

    /**
     * Field from the model to use as the versions name
     * @var string
     */
    protected $versionNameColumn = 'title';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'published_at'];

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
        'deleted_at'
    ];

    /**
     * Auditable events.
     *
     * @var array
     */
    protected $auditableEvents = ['created', 'updated', 'deleted', 'restored'];

    public function searchFields()
    {
        return ['title', 'slug', 'json'];
    }

    public function raw($path)
    {
        $url =
            "https://raw.githubusercontent.com/" .
            env('GITHUB_USERNAME') .
            "/" .
            env('GITHUB_REPOSITORY') .
            "/" .
            env("GITHUB_REPOSITORY_BRANCH") .
            "/pages/" .
            $path;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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
        if ($this->json != null) {
            $json = json_decode($this->json);
        } else {
            $json = null;
        }
        return $json;
    }

    public function thumbnail()
    {
        //$json = $this->content();
        if ($this->content() != null && isset($this->content()->sections)) {
            foreach ($this->schema()->sections as $section) {
                if ($section->fields != null) {
                    foreach ($section->fields as $field => $value) {
                        if (
                            isset($value->isThumbnail) &&
                            $value->isThumbnail == true
                        ) {
                            $slug = $section->slug;
                            $string =
                                "sections->" . $slug . "->fields->" . $field;
                            if (
                                isset(
                                    $this->content()->sections->$slug->fields
                                        ->$field
                                )
                            ) {
                                return $this->content()->sections->$slug->fields
                                    ->$field;
                            } else {
                                return null;
                            }
                        }
                    }
                }
            }
        }
    }

    public function content()
    {
        $json = $this->json;
        if ($json != null && gettype($json) != 'object') {
            $array = json_decode($json, true);
        } else {
            $array = [];
        }

        return $json;
    }

    public function markdown($content)
    {
        return Markdown::convertToHtml($content);
    }

    public function schemaToString()
    {
        if ($this->schema() !== null) {
            return json_encode($this->schema());
        } else {
            return null;
        }
    }

    public function versions()
    {
        $json = json_decode($this->json, true);
        $versions = count($json['versions']);
        if ($versions == null) {
            $versions = 0;
        }

        return $versions;
    }

    public function views()
    {
        $request = request();
        if ($request->input('startDate') != null) {
            $startDate = \Carbon\Carbon::parse($request->input('startDate'));
        } else {
            $startDate = new Carbon();
            $startDate = $startDate->subDays(30);
        }
        if ($request->input('endDate') != null) {
            $endDate = \Carbon\Carbon::parse($request->input('endDate'));
        } else {
            $endDate = new Carbon();
        }
        /*
      $startDate = \Carbon\Carbon::now()->subDays(30)->toDateTimeString();
      $endDate = \Carbon\Carbon::now()->subDays(0)->toDateTimeString();
      $views = $item->views()->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->get();
      dd($views);
      */
        //dd($endDate);
        $views = $this->hasMany('App\AnalyticEvent', 'model_id')
            ->where('event_type', '=', 'page viewed')
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate);
        return $views;
    }

    public function schema()
    {
        $path = file_get_contents(storage_path() . '/schemas/page.json');
        $baseSchema = json_decode($path, true);

        if ($this->id != null && $this->schema != null) {
            $pageSchema = json_decode($this->schema, true);
            if ($pageSchema == null) {
                $pageSchema = [];
            }

            $merged = array_merge($pageSchema, $baseSchema);

            //$merged = json_decode(json_encode($merged));
        } else {
            $merged = $baseSchema;
        }

        $schema = $merged;
        $schema = json_decode(json_encode($schema));

        return $schema;
    }
}
