# Prueba técnica 
Sigue estos pasos para que funcione en tu entorno de desarrollo:

### 1. Clonar y configurar el entorno
Primero, clona el repositorio y crea el archivo de variables de entorno:
```bash
cp .env.example .env
```
Este es el ejemplo dev que use
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=rapid_auto
DB_USERNAME=rapid_auto
DB_PASSWORD=secret

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

### 2. Levanta el Docker

```bash
docker-compose up -d
```

### 3. Modifica los permisos de la carpeta bootsrap/cache
```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
```
```bash
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### 3. Instala las dependencias composer
```bash
docker-compose exec app composer install
```

### 4. Genera la key de la aplicación y ejecuta las migraciones
```bash
docker-compose exec app php artisan key:generate
```

```bash
docker-compose exec app php artisan migrate
```

### 5. Instala las dependencias frontend de Nodejs
```bash
docker-compose exec app npm install
```

### 6. Compilar los assets para producción
```bash
docker-compose exec app npm run build
```

### Estructura
El sistema es un monolito que usa las librerias de Inertia y Vue para las funcionalidades de frontend. 
Esto por el poco tiempo de familiarizarme con los estados, props y los emits
Estan organizados en la siguientes carpetas
* `resources/js/app.js`: El contenedor principal donde se crea la aplicación
* `resources/js/Pages/*`: Componentes de paginas. Ahi almaceno las paginas de Auth, Lote y Seller. Se invocan desde los controladores.
* `resources/js/Layouts/*`: Se crea un Layout principal con el header y footer de la aplicación.
* `resources/js/Componentes/*`: Componentes que vi que se reutilizaban(Modal y paginación).

La Authenticación utilize la libreria de Fortify de laravel.

* `app/Http/Controllers/`: Lógica de backend. Se crearon dos controladores (lotes y sellers)

* `app/Models/`: Se uso el model user para la autenticación y se crearon los modelos Lote y Seller

## Lote
Se hizo con los datos mas sencillos para su llenado rapido;
* Name
* Address
Se relaciona con seller a traves de la llave foranea lote_id de la tabla sellers

## Seller
Se hizo con la información que crei relevante del recurso enviado
* Name
* Username
* Email
* Phone
* LoteId
Se asigna la llave foranea lote_id para cumplir con la relación de que un seller corresponde a un lote

# Acerca de la Justificación del criterio de la asignación de vendedores
Se realizo manualmente en el formulario de asignación. Ya que si se creaba los lotes con el parametro company.name, se iba a realizar consultas adicionales a la bd y podría forzar los recursos de esta.
Podria ser mas factible si existiera un parametro company.id y asi la inserción seria directa (teniendo una validación en el request).