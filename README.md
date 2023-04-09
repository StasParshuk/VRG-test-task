Необходимо создать справочник книг с возможностью CRUD.
Каждая книга должна содержать:
1.1 Название. (Обязательное поле)
1.2 Краткое описание. (Необязательное поле)
1.3 Изображение. (jpg или png, не более 2 Мб, должно сохраняться в отдельную папку и иметь уникальное имя файла)
1.4 Авторы (Обязательное поле, может быть несколько авторов в одной книге, должна быть возможность выбирать из списка авторов, который создается отдельно).
1.5 Дата публикации книги.
Список авторов создается отдельно. Также должна быть возможность добавления, удаления и редактирования. У каждого автора должны быть:
2.1 Фамилия (Обязательное поле, не менее 3 символов)
2.2 Имя (Обязательное, не пустое)
2.3 Отчество (Необязательное)
В результате получаем:
3.1 Просмотр отдельных страниц всех книг и авторов.
3.2 На странице авторов:
-Должна быть возможность увидеть всех авторов.
-Сортировка авторов по фамилии.
-Поиск (фильтр) по фамилии, имени.
-Добавление, редактирование реализовать в модальных окнах через ajax.
-Удаление.
3.3 На странице книг:
-Должна быть возможность увидеть все книги.
-Сортировка книг по названию.
-Поиск (фильтр) по названию, автору.
-Добавление, редактирование реализовать в модальных окнах через ajax.
-Удаление.
3.4 Сделать пагинацию по 15 страниц.
В проекте обязательно использовать:
-База данных (mysql).
-Создание таблиц реализовать через механизм миграций.
-Back-end использовать Yii2 или Laravel.
Визуальное оформление на усмотрение того, кто выполняет.
Предоставить ссылку на репозиторий с инструкцией для развертывания проекта.


# установка/
1. ./vendor/bin/sail up
2. /vendor/bin/sail composer install
3. /vendor/bin/sail artisan  migrate
3. http://localhost:771
