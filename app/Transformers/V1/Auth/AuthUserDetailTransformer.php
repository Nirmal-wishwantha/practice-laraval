<?php

namespace App\Transformers\V1\Auth;

use League\Fractal\TransformerAbstract;

class AuthUserDetailTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($result)
    {
        return [
            'id' => $result->id,
            'email' => $result->email,
            'role_id' => $result->role_id,
            
        ];
    }
}
