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

### Tinker

Tinker permite ejecutar arbitrariamente codigo PHP en una aplicacion de Laravel.

Retornar los datos almacenados en la tabla relacionada a un modelo especifico modelo.

```bash
php artisan tinker
App\Models\Chirp::all()
```

## Authorizacion

Por defecto el metodo `authorization` previene que cualquiera sea capaz de realizar actualizaciones a la base de datos.

Se puede especificar quien esta esta permitido para realizar actualizaciones creando un `Model Policy`.

```sh
php artisan make:policy ChirpPolicy --model=chirp
```

El comando anterior crear una clase en la ruta `app\policies\ChirpPolicy.php`. En el metodo `update` de la clase se puede especificar que usuario puede realizar actualizaciones.

    public function update(User $user, Chirp $chirp): bool {
        return $chirp->user()->is($user);
    }
