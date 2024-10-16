<img src="https://img.shields.io/badge/GIT-black?style=for-the-badge&logo=GIT&logoColor=F05032"/>
<img src="https://img.shields.io/badge/PHP-black?style=for-the-badge&logo=PHP&logoColor=777BB4"/>
<img src="https://img.shields.io/badge/CSS3-black?style=for-the-badge&logo=CSS3&logoColor=1572B6"/>
<img src="https://img.shields.io/badge/JAVASCRIPT-black?style=for-the-badge&logo=JavaScript&logoColor=F7DF1E"/>
<img src="https://img.shields.io/badge/HTML-black?style=for-the-badge&logo=HTML5&logoColor=E34F26"/>

# Notificaciones Rápidas

Notificaciones Rápidas es una aplicación desarrollada en Laravel 11 que permite enviar notificaciones y archivos a múltiples destinatarios a través de WhatsApp. La aplicación es capaz de enviar archivos PDF e imágenes en formato base64, sin un límite de destinatarios, y ofrece la funcionalidad de programar alertas para su envío futuro. Esta aplicación utiliza la API proporcionada por Buho, facilitando la realización de pruebas.

## Tabla de Contenidos
- [Requisitos Previos](#requisitos-previos)
- [Instalación](#instalación)
- [Características Principales](#características-principales)
- [Contribuciones](#contribuciones)
- [Licencia](#licencia)

## Requisitos Previos

Antes de ejecutar el proyecto, asegúrate de tener instalados los siguientes componentes:

- **PHP**: 8.2.12 o superior
- **Extensiones PHP**: 
  - OpenSSL 
  - PDO 
  - xml 
  - json 
  - bcmath
- **Composer**: Para gestionar las dependencias de PHP.
- **Node.js**: v20.16.0 o superior (opcional, para el frontend, si aplica).
- **MySQL**: Para gestionar la base de datos.
- **Clave de API de Buho**: Para el envío de mensajes por WhatsApp.

## Instalación

Sigue estos pasos para instalar y configurar la aplicación en tu entorno local:

1. **Clonar el repositorio**:

    ```bash
    git clone https://github.com/AndyTR03/Prueba
    cd Prueba
    ```

2. **Instalar Laravel**:

    Si aún no tienes Laravel instalado, sigue estos pasos para instalarlo:

    - **Instalar Composer**: Asegúrate de tener [Composer](https://getcomposer.org/) instalado en tu máquina. Puedes verificar su instalación ejecutando:

      ```bash
      composer --version
      ```

    - **Instalar Laravel**: Una vez que Composer esté instalado, puedes instalar Laravel globalmente ejecutando:

      ```bash
      composer global require laravel/installer
      ```

      Asegúrate de que el directorio de Composer `vendor/bin` esté en tu `PATH`. Esto te permitirá ejecutar el comando `laravel` desde cualquier lugar.

3. **Instalar las dependencias de PHP**:

    Asegúrate de estar en la carpeta del proyecto y ejecuta:

    ```bash
    composer install
    ```

4. **Configurar el archivo `.env`**:

    - Copia el archivo de ejemplo `.env.example` y renómbralo a `.env`.
    - Abre el archivo `.env` y configura los detalles de conexión a la base de datos y la clave de API de Buho.

5. **Migrar la base de datos**:

    Asegúrate de tener configurada tu base de datos en el archivo `.env`, luego ejecuta:

    ```bash
    php artisan migrate
    ```

6. **Iniciar el servidor de desarrollo**:

    Por último, inicia el servidor de desarrollo de Laravel:

    ```bash
    php artisan serve
    ```

   La aplicación estará disponible en `http://localhost:8000`.

## Características Principales

- **Envío de notificaciones a múltiples destinatarios sin límite.**
- **Envío de archivos PDF e imágenes en formato base64.**
- **Programación de alertas para el envío en fechas futuras.**
- **Integración con la API de Buho para el envío de mensajes por WhatsApp.**
- **Interfaz intuitiva y fácil de usar para la gestión de notificaciones.**

## Contribuciones

Si deseas contribuir a este proyecto, por favor sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3. Haz commit de tus cambios (`git commit -m 'Agregar nueva característica'`).
4. Haz push a la rama (`git push origin feature/nueva-caracteristica`).
5. Abre un Pull Request.