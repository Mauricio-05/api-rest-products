# API Rest products 🥢

Esta es una API RESTful construida con Laravel

## Requisitos ✏️

-   Tener instalado php.
-   Tener instalado composer.
-   Tener instalado docker.

## Tecnologías utilizadas 💻

-   Php
-   Laravel
-   Eloquent
-   Postgres
-   Docker

## Clonar repositorio ⬇️

```bash
git clone https://github.com/Mauricio-05/api-rest-products.git
```

## Configuración del proyecto 🔩

1. Navegar al directorio del proyecto
    ```bash
    cd your_path/api-rest-product
    ```
2. Instalar las dependencias de composer
    ```bash
    composer install
    ```
3. Instalar las dependencias de composer

    - Crear el archivo `.env` que contiene las variables de entorno duplicando los valores del `.env.example` y modificar los valores de la conexion a la base de datos que quieras conectarte.

4. Generar key de la aplicacion
    ```bash
    php artisan key:generate
    ```
5. Crear la base de datos con docker-compose
    ```bash
    docker compose up
    ```
6. Ejecutar migraciones
    ```bash
    php artisan migrate
    ```
7. Ejecutar la aplicación
    ```bash
    php artisan serve
    ```
8. Si tienes postman instalado puedes importar la coleccion llamada `Products collection.postmant_collection` **(Opcional)**

## Endpoints 🌐

-   `http://localhost:8000` - URL base luego de la API
    -   `/api/products` - CRUD para productos

> [!NOTE]
> Cada ruta admite los siguientes métodos HTTP

-   **POST**: Crea un nuevo recurso.

-   **GET**: Obtiene uno o más recursos.

-   **PUT**: Reemplaza completamente un recurso existente.

-   **PATCH**: Actualiza parcialmente un recurso existente.

-   **DELETE**: Elimina un recurso existente.

Cada método HTTP cumple una función específica en la manipulación de los datos. Asegúrate de utilizar el método
adecuado según la acción que desees realizar en la API.
