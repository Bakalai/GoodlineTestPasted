# GoodlineTestPasted
Тестовое задание на бэкэнд (базовое)

демонстрация работы: https://youtu.be/kdJ_X84vNlI

Для работы данного приложения неоьходимы: 
php версии 8.0.8 <br>
СУБД MySQL 5.7.25 <br>
установить php, запустить сервер mysql <br>
создать БД с определенным названием (laravel_testo пример.) кодировка utf8_general_ci <br>
в директории проекта открыть файл .env , в нём изменить соответствующие данные <br>
DB_CONNECTION=mysql <br>
DB_HOST=127.0.0.1 <br> 
DB_PORT=3306<br> 
DB_DATABASE=laravel_testo <br> 
DB_USERNAME=root<br> 
DB_PASSWORD= <br> 

открыть консоль, переместиться в директорию проекта <br> 
при ошибке <br> 
"could not find driver"<br> 
нужно найти файл php.ini, в нем найти строчку <br> 
extension = pdo_mysql<br>
и удалить в начале символ ; <br>
Перед миграцией, необходимо в файле web.php закомментировать строки, с 23 по 27 (в файле)<br>
$publicates = DB::select("select hash from pasteds");<br>
foreach ($publicates as $onepasta)<br>
{<br>
    Route::get($onepasta->hash, [MainController::class, 'onepasta'] );      // Заполнение routes значениями ссылок на "пасты" из базы<br>
}<br>
<br>
запуск миграции: <br>
php artisan migrate<br>
раскоментировать строки ^<br>
php artisan serve запуск сервера <br>
проект запущен<br>
