#### Readme будет дополняться по мере развития проекта

## Task Manager + Task Tracker (T2T)

----------------

### API ENDPOINTS

```
API GET
```
{host}/api/task/ - получить все задачи
{host}/api/task/{id} - получить задачу по id
```
API POST
```
{host}/api/task/create - создать задачу

----------------

### Стэк

- Laravel 10
- MySQL
- Vue 3
- TypeScript
- Vue-Router
- Vuex
- Laravel Sail

### Как запустить проект?

- git clone https://github.com/hirohitoqwe/task_manager2.git
- cp .env.example .env
- composer install
- php artisan key:generate
- ./vendor/bin/sail up -d

### Благодарности
