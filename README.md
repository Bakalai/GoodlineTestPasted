# GoodlineTestPasted
Тестовое задание на бэкэнд (базовое)

Для работы данного приложения неоьходимы: 
php версии 8.0.8
СУБД MySQL 5.7.25
установить php, запустить сервер mysql
создать БД с определенным названием (laravel_testo пример.) кодировка utf8_general_ci
в директории проекта открыть файл .env , в нём изменить соответствующие данные
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_testo
DB_USERNAME=root
DB_PASSWORD=

открыть консоль, переместиться в директорию проекта
при ошибке 
"could not find driver"
нужно найти файл php.ini, в нем найти строчку 
extension = pdo_mysql
и удалить в начале символ ;
Перед миграцией, необходимо в файле web.php закомментировать строки, с 23 по 27 (в файле)
$publicates = DB::select("select hash from pasteds");
foreach ($publicates as $onepasta)
{
    Route::get($onepasta->hash, [MainController::class, 'onepasta'] );      // Заполнение routes значениями ссылок на "пасты" из базы
}

запуск миграции: 
php artisan migrate
раскоментировать строки ^
php artisan serve запуск сервера 
проект запущен
