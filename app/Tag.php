<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Overtrue\LaravelFollow\Traits\CanBeBookmarked;

class Tag extends Model
{
    use CanBeLiked, CanBeFavorited, CanBeBookmarked;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tagging_tags';

    public function content()
    {
        $post = \App\Post::where('slug', '=', $this->slug)
            ->where('status', '=', 'PUBLISHED')
            ->first();
        if ($post !== null) {
            return $post->content();
        } else {
            return null;
        }
    }

    public function post()
    {
        $post = \App\Post::where('slug', '=', $this->slug)->first();
        if ($post !== null) {
            return $post;
        } else {
            return null;
        }
    }

    public function transformations()
    {
        $allowed = [];

        $allowed[] = 'follow';

        $results = [];
        foreach ($allowed as $function) {
            $results[$function] = $this->$function('schema');
        }
        return $results;
    }

    public function follow($input = null)
    {
        if ($input == 'schema') {
            $plans = $this->stripePlans()->data;
            $options = [];
            if ($plans != null) {
                foreach ($plans as $plan) {
                    $item = [];
                    $item['value'] = $plan->id;
                    $item['label'] = $plan->nickname;
                    $amount =
                        "$" .
                        $plan->amount / 100 .
                        " " .
                        strtoupper($plan->currency);
                    $item['description'] =
                        $amount . " / " . ucwords($plan->interval);
                    $options[$plan->id] = $item;
                }
            }
            $schema = [
                'label' => 'Follow',
                'slug' => 'follow',
                'description' => 'You may follow this topic.',
                'instruction' => 'Select an action.',
                'confirmation_message' => null,
                'options' => $options,
                'success_message' => "Success.",
                'requirements' => []
            ];
            return $schema;
        } else {
            //Do Something
            $userEmail = app('request')->input('email');
            $user = \App\User::where('email', '=', $userEmail)->first();
            if ($user == null && \Auth::user() != null) {
                $user = \Auth::user();
            }

            if ($user != null) {
                $user = \App\User::create([
                    "email" => $userEmail
                ]);
            }
            $user->follow($this);
            return $this;
        }
    }
}
