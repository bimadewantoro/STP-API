<?php

use App\Models\User;
use League\Fractal\TransformerAbstract;

class profilesTenant extends TransformerAbstract {

    public function tenant(User $user)
    {
        [
            'id' => $user->id,
        ];
    }
}