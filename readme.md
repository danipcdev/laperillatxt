# Instrucciones para probar la aplicación en local

Para poder probar la aplicación en una máquina local, sigue los siguientes pasos:

## Preparación

- Descargar el código del repositorio de backend.
- Dentro de la raíz del repositorio backend, crea el directorio `front-end`.
- Dentro del directorio `front-end`, descarga el código del repositorio frontend.

## Configuración y ejecución del Backend

Ejecuta los siguientes comandos:

1. `make build`
    - Construye los contenedores de la aplicación.

2. `make prepare`
    - Lanza el `composer install` y las migraciones de base de datos.

3. `make start`
    - Ejecuta los contenedores.

Con estos pasos, el backend estará en funcionamiento.

## Configuración y ejecución del Frontend

Para configurar el frontend, sigue estos comandos:

1. `yarn install`
    - Instala las dependencias necesarias para construir la app.

2. `yarn dev`
    - Lanza el servidor de desarrollo en localhost para probar el frontend.