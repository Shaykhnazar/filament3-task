<?php

namespace App\Console\Commands\User\Balance;

use App\Console\Commands\User\Balance\Traits\HasUserAttribute;
use App\Services\UserService;
use Illuminate\Console\Command;

class UserBalanceTransactionsCommand extends Command
{
    use HasUserAttribute;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:balance:transactions {userId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для просмотра транзакции пользователя по балансу';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = $this->getUserAttribute();
        $this->table(
            ['Id', 'User ID', 'Amount', 'Type', 'Created At', 'Updated At'],
            $user->transactions->toArray()
        );
    }
}
