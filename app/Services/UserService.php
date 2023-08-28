<?php

namespace App\Services;

use App\Enums\UserBalanceActionTypeEnum;
use App\Models\User;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Зачисление баланса пользователю
     * @param $user
     * @param $amount
     * @return void
     */
    public static function deposit($user, $amount): void
    {
        // Добавить $amount к балансу пользователя с $user
        DB::transaction(function () use ($amount, $user) {
            $user->increment($amount);
            $this->saveToUserTransactionsByActionType($user, $amount, UserBalanceActionTypeEnum::Deposit);
        });
    }

    /**
     * Списание баланса у пользователя
     * @param $user
     * @param $amount
     * @return void
     */
    public static function withdraw($user, $amount): void
    {
        // Вычесть $amount из баланса пользователя с $user
        DB::transaction(function () use ($amount, $user) {
            $user->decrement($amount);
            $this->saveToUserTransactionsByActionType($user, $amount, UserBalanceActionTypeEnum::Withdraw);
        });
    }

    /**
     * Получение транзакций пользователя
     * @param User $user
     * @return UserTransaction
     */
    public static function getTransactions(User $user): UserTransaction
    {
        return $user->transactions;
    }

    /**
     * Записать транзакцию в таблицу transactions
     * @param $user
     * @param $type
     * @param $amount
     * @return void
     */
    function saveToUserTransactionsByActionType($user, $amount, $type): void
    {
        $user->transactions()->create([
            'user_id' => $user,
            'amount' => $amount,
            'type' => $type,
        ]);
    }

}
