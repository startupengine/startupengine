<?php

namespace App;

use App\Scopes\SettingsGroupScope;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IsApiResource;

class SettingsGroup extends Model
{
    use IsApiResource;

    protected $table = 'settings';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SettingsGroupScope());
    }

    public function items()
    {
        $items = count(\App\Setting::where('group', '=', $this->group)->get());
        return $items;
    }

    public function schema()
    {
        return 123;
    }
}
