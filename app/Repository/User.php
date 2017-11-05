<?php

namespace App\Repository;

use Auth0\Login\Contract\Auth0UserRepository;

class User implements Auth0UserRepository {

    /* This class is used on api authN to fetch the user based on the jwt.*/
    public function getUserByDecodedJWT($jwt) {
        /*
         * The `sub` claim in the token represents the subject of the token
         * and it is always the `user_id`
         */
        $jwt->user_id = $jwt->sub;

        return $this->upsertUser($jwt);
    }

    public function getUserByUserInfo($userInfo) {
        return $this->upsertUser($userInfo['profile']);
    }

    protected function upsertUser($profile) {
        $user = \App\User::where("auth0id", $profile['user_id'])->first();

        if ($user === null) {
            // If not, create one
            $user = new \App\User();
            $user->email = $profile['email']; // you should ask for the email scope
            $user->auth0id = $profile['user_id'];
            $user->name = $profile['name']; // you should ask for the name scope
            $user->save();
        }

        if(($user->photo_url == null or $user->photo_url == '') && $profile['picture']) {
            $user->photo_url = $profile['picture']; // you should ask for the name scope
            $user->save();
        }

        return $user;
    }

    public function getUserByIdentifier($identifier) {
        //Get the user info of the user logged in (probably in session)
        $user = \App::make('auth0')->getUser();

        if ($user===null) return null;

        // build the user
        $user = $this->getUserByUserInfo($user);

        //If it is not the same user as logged in, it is not valid. If it is the same, return the user object.
        if ($user && $user->auth0id != $identifier) {
            return $user;
        }
    }

}