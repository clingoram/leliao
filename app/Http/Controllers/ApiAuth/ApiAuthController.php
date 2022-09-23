<?php

namespace App\Http\Controllers\ApiAuth;

/**
 * 產生token
 * 
 */
class ApiAuthController
{
    public function createToken(object $user, int $statusCode)
    {
        if (isset($user) and !empty($user)) {
            $token = $user->createToken($user->name, ['*'], 2);
            return response()->json(
                [
                    'status' => true,
                    'user' => [
                        'id' => $user->id,
                        'account' => $user->name
                    ],
                    'identity' => $token->plainTextToken,
                    'expires_at' => $token->accessToken->expires_at,
                ],
                $statusCode
            );
        } else {
            return response()->json(
                [
                    'error' => 'token_error'
                ],
                401
            );
        }
    }

    // public function refreshToken()
    // {
    // }
}
