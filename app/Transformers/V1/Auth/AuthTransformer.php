<?php

namespace App\Transformers\V1\Auth;

use League\Fractal\TransformerAbstract;

class AuthTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($result)
    {
        return [
            'message' => $result->message,
            'token' => $result->token,
            'expires_at' => $result->expires_at,
            'token_type' => $result->token_type,
        ];
    }
}
