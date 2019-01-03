<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

class OAuthToken extends Model
{
    use AccessTokenTrait, EntityTrait, TokenEntityTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_access_tokens';

    protected $casts = ['id' => 'string'];
}
