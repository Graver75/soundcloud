# SoundCloud Parser

Приложение для сбора информации об  артистах  и треках

## Установка

Для запуска приложения понадобится:

1) `pdo_mysql` расширение: https://stackoverflow.com/questions/2852748/pdoexception-could-not-find-driver
2) `php_curl`  расширение: https://stackoverflow.com/questions/6382539/call-to-undefined-function-curl-init
3) сертификат для корректной работы `curl`: https://stackoverflow.com/questions/28858351/php-ssl-certificate-error-unable-to-get-local-issuer-certificate
4) запустить `DB.sql` файл для настройки таблиц
5) в файл `config.php `прописать настройки для подключения к базе данных (логин и т.д.)
6) в файл `config.php` прописать `client_id` от SoundCloud для подключения к API: https://stackoverflow.com/questions/40992480/getting-a-soundcloud-api-client-id
7) в файл `config.php` прописать названия исполнителей

## Использование

Запустить `Example.php`

## Разработка

Изначально по ТЗ необходимо было использовать только Curl (парсить вебсайт), а не API.

На стадии планирования было выяснено, что SoundCloud использует JS для рендера страницы, "сухой" парсинг не подойдёт

Обратился к заказчику (Unipage) и было разрешено использовать API или вебдрайвер для приложения

Для использования API необходимо получать `client_id` для приложения, но SoundCloud закрыли создание приложений, поэтому пришлось использовать
пользовательский `client_id`, получить его можно следующим образом:
https://stackoverflow.com/questions/40992480/getting-a-soundcloud-api-client-id

Не обращайте внимание на Git флоу, изначально (первая сделать ТЗ была в августе) не было требований для использования Git, поэтому накатывал коммиты на уже существующий проект 

