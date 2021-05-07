# Установка
1. Скопировать файлы приложения на рабочий сервер посредством FTP или другим способом.
2. Создать базу данных, с которой будет работать приложение
3. В файле common\config\main-local.php прописываем параметры подключения к базе данных:
```php
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbname',
            'username' => 'username',
            'password' => 'password',
            'charset' => 'utf8mb4',
        ],
        //...
    ],
```
4. Запускаем миграции
```
yii migrate
```

# Применение

При миграции создается администратор:
````
Логин: admin
Пароль: adminadmin
````