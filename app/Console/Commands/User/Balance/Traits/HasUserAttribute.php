<?php

namespace App\Console\Commands\User\Balance\Traits;

use App\Models\User;
use function Laravel\Prompts\select;

trait HasUserAttribute
{
    public function getUserAttribute(): User
    {
        $userId = select(
            label: 'У какого пользователя вы хотели бы изменить баланс или просмотреть транзакции?',
            options: User::pluck('name', 'id'),
            scroll: 10
        );

        return User::find($userId);
    }
}
