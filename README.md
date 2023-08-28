Тестовое задание:

На filament 3 php >=8.1

Есть стандартные пользователи, у них есть баланс, нужна возможность зачислять, списывать баланс пользователю и записывать в транзакции, по каждому пользователю видеть транзакции.

### Installation steps

* `git clone https://github.com/Shaykhnazar/filament3-task`
* `composer install`
* `cp .env.example .env`
* `php artisan key:generate`
* Create database locally and set credentials to .env file
* `php artisan migrate --seed`

### Commands to manage balance of user
* `php artisan user:balance` - Команда для управления баланса пользователя
