<?php

namespace App\Console\Commands\User\Balance;

use Illuminate\Console\Command;


class UserBalanceCommand extends Command
{
    protected const DEPOSIT = 'deposit';

    protected const WITHDRAW = 'withdraw';

    protected const TRANSACTIONS = 'transactions';


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance {action? : Выберите команду для дальнейшего действие}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для управления баланса пользователя';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $action = $this->argument('action') ?? $this->choice( 'Что делаем?', [
                self::DEPOSIT,
                self::WITHDRAW,
                self::TRANSACTIONS
            ],
        );

        $this->call(match ($action) {
            self::DEPOSIT => UserBalanceDepositCommand::class,
            self::WITHDRAW => UserBalanceWithdrawCommand::class,
            self::TRANSACTIONS => UserBalanceTransactionsCommand::class,
        });

        return 0;
    }
}
