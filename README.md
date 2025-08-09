# Laravel Docker Project

Цей проєкт — базове оточення Laravel 9
(Laravel 10+ не підтримує PHP 8.0.
Ми використовуємо Laravel 9.x, сумісний із PHP 8.0,
так як у завданні було обмеження версією PHP 8.0)
на Docker із розділенням сервісів `laravel_blog`, `composer` та `nginx`.

---

## Системні вимоги

- Docker
- Docker Compose
- Git

---

## Швидкий старт

### Щоб розгорнути проєкт локально треба виконати наступні дії

### 1. Клонувати репозиторій
    git clone https://github.com/homeleonn/OA-blog-management-system.git
    cd OA-blog-management-system

### 2. Встановити залежності
    docker compose run composer install

### 3. Налаштувати оточення

Скопіювати файл `.env` із шаблону, створити порожню SQLite базу та сгенерувати APP_KEY:

``` bash
cp src/.env.example src/.env && touch src/database/database.sqlite && docker compose run laravel_blog php artisan key:generate

``` 

### 4. Виконати міграції разом з посівом даних
    docker compose run laravel_blog php artisan migrate --seed

### 5. Побудувати контейнери
    docker-compose up -d --build


## Доступ до сайту

http://localhost:8080 - Список статей\
http://localhost:8080/admin/posts - Список статей у адмінській частині\
http://localhost:8080/admin/posts/create - Створити статтю\
...

### Команди
Artisan

    docker compose run laravel_blog php artisan

Composer

    docker compose run composer

### Примітки

    Laravel 10+ не підтримує PHP 8.0. Ми використовуємо Laravel 9.x, сумісний із PHP 8.0.