ExtJS+Yii (test)
==========

### Состав

*   sql - скрипты для создания БД
*   www - корневой каталог сайта:
    *   assets - вспомогательная папка Yii
    *   css - файлы css
    *   extjs - библиотека ExtJS
    *   images - изображения
    *   js - файлы Javascript (основные доработки по ExtJS)
      *   issue.js - стартовый файл для ExtJS
      *   issueForm.js - форма ввода темы
      *   issueGrid.js - грид тем
      *   messageForm.js - форма ввода сообщения
      *   messageGrid.js - грид сообщений
      *   utils.js - вспомогательный функции
      *   protected - основной функционал на PHP
        *   components - переопределенные классы Yii
        *   config - конфигурация приложения
        *   controllers - контроллеры (здесь основные изменения для задания)
        *   models - модели, практически без изменений после автогенерации
        *   runtime - вспомогательная папка Yii
        *   views - представления, за небольшим исключением (layouts и подпапки extjs) - автогенерация
      *   themes - темы для Yii (используются по умолчанию без модификации)
*   Yii - PHP-framework

### Требования

*   MySQL 5.5.27
*   Apache 2.2
*   PHP 5.4.7
*   Yii 1.1.12
*   ExtJS 3.4.0

### Установка

##### БД
В каталоге sql лежат скрипты для создания БД и исполняемый файл create.cmd. Скрипт создает нового пользователя, удаляет БД (если она существует) и создает БД заново.

*   create_user.sql - создание пользователя, отредактировать если необходимо сменить имя пароль и схему.                
*   drop.sql - удаление БД
*   eds_sav.sql - создание БД и объектов БД
*   create.cmd - пакетный файл для запуска с скриптов

Данные по умолчанию:
*   БД: **<u>eds_sav</u>**
*   Пользователь: **<u>eds_sav</u>**
*   password: **<u>1q2w3e4r</u>**
    
##### Веб-сервер
Указать каталог **<u>www</u>** в качестве корневого каталога сайта. Стартовый файл  - **<u>index.php</u>**. На веб-сервере должен быть настроен PHP.

##### Конфигурация
В файле **www/protected/config/const.php** указать параметры подключения к БД:
<pre>
const HOST = 'localhost';
const NAME = 'eds_sav';
const USER = 'eds_sav';
const PASSWORD = '1q2w3e4r';
</pre>

### Использование
В системе реализованы 3 основных роли и гостевой доступ (только стартовая страница):

*   User (alex/1q2w3e4r) - создает и закрывает темы в поддержке
*   Support (justas/1q2w3e4r) - отвечает в поддержке
*   Administrator (ship/1q2w3e4r) - техничеcкий пользователь для редактирования БД (в основном код созданный автогенерацией)

После авторизации User-у и Support-у доступна работа в поддержке. Администратору - работа с таблицами

Рабочий экран состоит из 2-х частей (master-detail): вверху список тем поддержки, внизу сообщения по выбранной теме и форма вода сообщения

Списки тем и сообщений автоматически обновляется (по умочанию с периодом в 5 сек.). Таким оразом участники могут видеть изменения (новые темы, новые сообщения и др.)

Пользователь может:

*   Создать новую тему. Тема будет создана в статусе "Не открыта"
*   Писать сообщения по выбранной теме (даже в неоткрытую)
*   Закрывать темы. Тема меняет статус на закрытую

issue может:

*   "Взять" тему пользователя. Тема сменит статус на "Открытая"
*   Писать сообщения по выбранной теме (только в  открытую)</div>

Администратор - попытка более плотно изучить реализацию фреймворка Yii
