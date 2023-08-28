<?php

namespace App\Console\Commands\User\Balance;

use App\Console\Commands\User\Balance\Traits\HasUserAttribute;
use App\Services\UserService;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class UserBalanceDepositCommand extends Command
{
    use HasUserAttribute;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance:deposit
                                {userId? : ID пользователя}
                                {amount? : Сумма для "Снятие" от баланса пользователя}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для "Зачисление" сумму на баланс пользователя';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = $this->getUserAttribute();
        $amount = text(
            label: 'Сумма для "Зачисление" на баланс пользователя?',
            validate: fn (string $value) => match (true) {
                !is_numeric($value) => 'Сумма должно быть числом.',
                default => null
            }
        );
        UserService::deposit($user, $amount);

    }
}
