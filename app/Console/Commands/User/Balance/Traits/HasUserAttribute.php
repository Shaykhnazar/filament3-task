<?php

namespace App\Console\Commands\User\Balance\Traits;

use App\Models\User;
use function Laravel\Prompts\select;

trait HasUserAttribute
{
    public function getUserAttribute(): User
    {
        $userEmail = select(
            label: 'У какого пользователя вы хотели бы изменить баланс или просмотреть транзакции? Введите ID!',
            options: User::pluck('email', 'id'),
            scroll: 10,
            hint: 'test@example.com',
        );

        return User::where('email', $userEmail)->first();
    }
}
