## Laravel Bootcamp

Crear un proyecto de laravel mediante composer.

```sh
composer create-project laravel/laravel project_name
```

### Breeze

Implementacion minimalista y simple de caracteristicas para la autenticacion.

```sh
composer require laravel/breeze --dev
php artisan breeze:install blade
```

## Modelos, migraciones y controladores

### Modelos

Provee una interfaz para interactuar con las tablas en la base de datos.

### Migraciones

Permite crear y modificar tablas en una base de datos.

### Controladores

Son responsables de procesar las peticiones realizadas a la aplicacion para posteriormente retornar una respuesta.

## artisan

Crear un modelo, migracion y controlador

```sh
php artisan make:model -mrc <ModelName>
```

El comando anterior crea:
- El modelo Eloquent
- La migracion que creara las tablas en la base de datos
- El controlador HTTP que procesara la peticiones entrantes y retornara una respuesta