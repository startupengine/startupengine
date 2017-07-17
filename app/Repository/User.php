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
        dd($profile);

        $user = \App\User::where("auth0id", $profile['user_id'])->first();

        $user = \App\User::updateOrCreate(
            ['auth0id' => $profile['user_id']],
            [
                'auth0id' => $profile['user_id'],
                'picture' => $profile['picture'],
                'name' => $profile['name'],
            ]
        );

        if(isset($profile['email'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'email' => $profile['email'],
                ]
            );
        }

        if(isset($profile['locale'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'locale' => $profile['locale'],
                ]
            );
        }

        if(isset($profile['birthday'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'birthday' => $profile['birthday'],
                ]
            );
        }

        if(isset($profile['given_name'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'given_name' => $profile['given_name'],
                ]
            );
        }

        if(isset($profile['family_name'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'family_name' => $profile['family_name'],
                ]
            );
        }

        if(isset($profile['picture_large'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'picture_large' => $profile['picture_large'],
                ]
            );
        }

        if(isset($profile['gender'])) {
            $user = \App\User::updateOrCreate(
                ['auth0id' => $profile['user_id']],
                [
                    'gender' => $profile['gender'],
                ]
            );
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