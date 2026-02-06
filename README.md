## Запуск проекта

Клонируем репозиторий. Должен быть открыть Docker. После этого команды по порядку.

```bash
composer install
```

```bash
cp .env.example .env
```

В .env заполняем DB_USERNAME DB_PASSWORD

```bash
php artisan key:generate
```

```bash
sail up -d
```

В сидере будет юзер admin/admin
```bash
sail artisan migrate:fresh --seed
```

```bash
sail npm install
```

```bash
sail npm run dev
```
Проект открывается по адресу http://localhost/
