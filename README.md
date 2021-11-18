# Тестовое задание

Веб-сервер обеспечивает API для других приложений. Бизнес владеет WiFi точками, через которые клиент авторизуется для доступа в интернет.

Требуется реализовать веб-интерфейс администратора + API для программистов приложений, которое показывает по идентификатору точки, какой язык на ней установлен по умолчанию.

Согласно бизнес-требованиям администратор приложения должен иметь возможность изменять настройки языка приложения (en, ru) по умолчанию (на конкретной точке в городе, по всем точкам города, по всем точкам).

На основе фокуса на производительность и скорость ответов предложить и обосновать схему хранения (структура таблиц + индексы) и архитектуру приложения.

* приложение на Yii2;
* использовать REST API;
* использовать миграции Yii2;
* положить код всего проекта в git (например, Bitbucket или github);
* репозиторий должен содержать README.md файл, в котором описаны требования к окружению и как запустить приложение;
* приложение не должно потреблять больше 128MB памяти в пике.

## Решение

### Рабочее окружение

* Nginx 1.19 
* PHP 7.4 (FPM)
* MySQL 5.7 или MariaDB
* Composer

### Установка приложения с помощью docker compose:

1. Клонируем репозиторий

```bash
git clone https://github.com/aik27/ertelecom-api
cd ertelecom-api
```

2. Устанавливаем зависимости

```bash
composer update
```

3. Билдим контейнеры

```bash
docker-compose build
```

4. Запускаем контейнеры

```bash
docker-compose up -d
```

5. Меняем рабочее окружение на production

```bash
docker-compose exec admin php init --env=Production --overwrite=All
```

6. Применяем миграции

```bash
docker-compose exec admin php yii migrate --interactive=0
```

7. Доступ к приложению:

```bash
API: http://127.0.0.1:3132
Административная панель: http://127.0.0.1:3133

Тестовый доступ в панель:
Логин: root
Пароль: SWlfwj4e78Fsk
```

### Установка приложения вручную:

1. Клонируем репозиторий

```bash
git clone https://github.com/aik27/ertelecom-api
cd ertelecom-api
```

2. Устанавливаем зависимости

```bash
composer update
```

3. Меняем рабочее окружение на production

```bash
php init --env=Production --overwrite=All
```

4. Правим настройки соединения с БД

```bash
vi common/config/main-local.php
```

5. Применяем миграции

```bash
php yii migrate --interactive=0
```

6. Настраиваем имена серверов, корневые директории и роутинг в Nginx:

```text
    # Для API

    server_name ertelecom.api;
    root        [path to app]/api/web/;
    index       index.php;

    location / {
       try_files $uri $uri/ /index.php$is_args$args;
    }
```
```text
    # Для административной панели

    server_name panel.ertelecom.api;
    root        [path to app]/admin/web/;
    index       index.php;

    location / {
       try_files $uri $uri/ /index.php$is_args$args;
   }
```

7. Доступ к приложению:

```bash
API: http://ertelecom.api
Административная панель: http://panel.ertelecom.api

Тестовый доступ в панель:
Логин: root
Пароль: SWlfwj4e78Fsk
```


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
