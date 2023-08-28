<?php

namespace App\Services;

use App\Enums\UserBalanceActionTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Зачисление баланса пользователю
     * @param User $user
     * @param $amount
     * @return void
     */
    public static function deposit(User $user, float $amount): void
    {
        // Добавить $amount к балансу пользователя с $user
        DB::transaction(function () use ($amount, $user) {
            $user->increment('balance', $amount);
            self::saveToUserTransactionsByActionType($user, $amount, UserBalanceActionTypeEnum::Deposit->name);
        });
    }

    /**
     * Списание баланса у пользователя
     * @param User $user
     * @param float $amount
     * @return void
     */
    public static function withdraw(User $user, float $amount): void
    {
        // Вычесть $amount из баланса пользователя с $user
        DB::transaction(function () use ($amount, $user) {
            $user->decrement('balance', $amount);
            self::saveToUserTransactionsByActionType($user, $amount, UserBalanceActionTypeEnum::Withdraw->name);
        });
    }

    /**
     * Записать транзакцию в таблицу transactions
     * @param User $user
     * @param $amount
     * @param $type
     * @return void
     */
    public static function saveToUserTransactionsByActionType(User $user, $amount, $type): void
    {
        $user->transactions()->create([
            'user_id' => $user,
            'amount' => $amount,
            'type' => $type,
        ]);
    }

}
