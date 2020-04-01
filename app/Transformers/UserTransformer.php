<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'name' => $user->name,
            'email' => $user->email
        ];
    }
}
