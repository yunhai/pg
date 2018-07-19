<?php

namespace App\Models\Affiliator;

use App\Models\Base;

class Affiliator extends Base
{
    public $visible = [
        'id',
        'fullname',
        'email',
        'token',
        'username',
        'password',
        'balance',
        'mode',
        'commission_rate',
        'user_id',
    ];

    public function getByToken(string $token)
    {
        $target = $this->select('id', 'commission_rate')
                    ->where('token', $token)
                    ->first();

        if ($target) {
            return $target->toArray();
        }
        return [];
    }

    public function updateCommissionBalance(int $affiliator_id, int $commission)
    {
        // return;
        $column = 'balance';
        // dd($affiliator_id);
        $this->where('id', $affiliator_id)
            ->increment($column, $commission);
    }
}
