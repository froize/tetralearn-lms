<p style="text-align: center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img alt="logo" src="http://tetralearn-lms.smrtp.ru/img/logo-sm.svg" height="100px">
    </a>
    <h1 style="text-align: center">TetraLearn - на пары можно не ходить!</h1>
    <br>
</p>

TetraLearn - это свободно распространяемое программное обеспечение с открытым исходным кодом,
 выполняющее роль посредника между преподавателями и студентами.
  Написано на фреймворке [Yii 2](http://www.yiiframework.com/).

Пример работы на удаленном сервере можно посмотреть [здесь](http://tetralearn-lms.smrtp.ru/).


Функционал приложения
-------------------

      Курсы               создание, изменение курсов
      Заявки на курс      создание заявки на добавление на курс
      Задания             получение заданий в различном формате, загрузка и оценивание выполненных заданий
      Доклады             созданиие, изменение, получение докладов по курсу
      Оценки              просмотр оценок
      Группы              создание, изменение групп

Установка
------------

### Установка через Composer


Вы можете установить приложение через Composer, выполнив следующую команду:
~~~
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

После этого вам нужно будет настроить доступ к базе данных в файле `config/db.php`,
 указав нужный хост, название и пароль от базы данных (если есть).
 
 Например вот так:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=grades',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
После этого нужно импортировать базу данных из файла `data.sql` в вашем менеджере баз данных. 

Далее можно перейти по адресу:
~~~
http://localhost/
~~~

И ввести любой логин (по умолчанию - почта) и пароль - `123`.

### Установка через файл архива

Скачайте [последнюю версию](https://github.com/froize/tetralearn-lms/archive/master.zip) приложения с GitHub.

После этого вам нужно будет настроить доступ к базе данных в файле `config/db.php`,
 указав нужный хост, название и пароль от базы данных (если есть).
 
 Например вот так:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=grades',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
После этого нужно импортировать базу данных из файла `data.sql` в вашем менеджере баз данных. 

Далее можно перейти по адресу:
~~~
http://localhost/
~~~
И ввести любой логин (по умолчанию - почта) и пароль - `123`.