# Proyecto de Autenticación con JWT en Laravel

Este proyecto es una API construida con Laravel que utiliza JWT (JSON Web Tokens) para la autenticación de usuarios. Incluye funcionalidades para registro, inicio de sesión, actualización de token y cierre de sesión. Además, proporciona un controlador para la gestión de usuarios.

## Requisitos

- [PHP](https://www.php.net/manual/es/intro-whatis.php) >= 8.0
- [Composer](https://getcomposer.org/) 
- [Laravel](https://laravel.com/docs) >= 8.x
- [MySQL](https://www.mysql.com/)
- [JWT-Auth](https://jwt-auth.readthedocs.io/en/docs/) para la autenticación
- [Docker](https://www.docker.com/) para la creación de la base de datos

## Instalación

1. **Clona el repositorio:**

    ```bash
    git clone https://github.com/test-api/test-api.git
    ```

2. **Navega al directorio del proyecto:**

    ```bash
    cd test-api
    ```

3. **Instala las dependencias del proyecto:**

    ```bash
    composer install
    ```

4. **Configura el archivo `.env`:**

    Copia el archivo `.env.example` a `.env` y configura las variables de entorno:

    ```bash
    cp .env.example .env
    ```

5. **Configura la base de datos:**

    Asegúrate de configurar los detalles de la base de datos en el archivo `.env` de acuerdo al contenedor docker preconfigurado:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=million_solutions
    DB_USERNAME=usuario
    DB_PASSWORD=admin123
    ```

6. **Contenedor de base de datos:**

    Ejecuta el contenedor docker con la Base de datos creada para el proyecto:

    ```bash
    sudo docker compose up mysql
    ```

7. **Ejecuta las migraciones:**

    ```bash
    php artisan migrate
    ```

8. **Inicia el servidor de desarrollo:**

    ```bash
    php artisan serve
    ```

## Endpoints de la API

### Registro de Usuario

- **Método:** `POST`
- **URL:** `/api/v1/register`
- **Campos requeridos:**
  - `first_name`: Nombre
  - `last_name`: Apellido
  - `date_birth`: Fecha de nacimiento
  - `mobile_phone`: Teléfono móvil
  - `email`: Correo electrónico
  - `password`: Contraseña

### Inicio de Sesión

- **Método:** `POST`
- **URL:** `/api/v1/login`
- **Campos requeridos:**
  - `mobile_phone`: Teléfono móvil
  - `password`: Contraseña

### Cierre de Sesión

- **Método:** `POST`
- **URL:** `/api/v1/logout`

### Gestión de Usuarios

- **Obtener todos los usuarios:**
  - **Método:** `GET`
  - **URL:** `/api/v1/users`
  
- **Obtener un usuario por ID:**
  - **Método:** `GET`
  - **URL:** `/api/v1/users/{id}`

- **Actualizar un usuario por ID:**
  - **Método:** `PUT`
  - **URL:** `/api/v1/users/{id}`
  - **Campos actualizables:** Los mismos que en el registro.

- **Eliminar un usuario por ID:**
  - **Método:** `DELETE`
  - **URL:** `/api/v1/users/{id}`


## Contacto

- **Autor:** [Johan Lozano](https://github.com/johancalr)
- **Email:** johancalr11@gmail.com
