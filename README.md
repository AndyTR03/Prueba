<img src="https://img.shields.io/badge/GIT-black?style=for-the-badge&logo=GIT&logoColor=F05032"/>
<img src="https://img.shields.io/badge/PHP-black?style=for-the-badge&logo=PHP&logoColor=777BB4"/>
<img src="https://img.shields.io/badge/CSS3-black?style=for-the-badge&logo=CSS3&logoColor=1572B6"/>
<img src="https://img.shields.io/badge/JAVASCRIPT-black?style=for-the-badge&logo=JavaScript&logoColor=F7DF1E"/>
<img src="https://img.shields.io/badge/HTML-black?style=for-the-badge&logo=HTML5&logoColor=E34F26"/>
<img src="https://img.shields.io/badge/DOCKER-black?style=for-the-badge&logo=Docker&logoColor=2496ED"/>
<img src="https://img.shields.io/badge/PYTHON-black?style=for-the-badge&logo=python&logoColor=gold"/>
<img src="https://img.shields.io/badge/SH SCRIPTS-black?style=for-the-badge&logo=GNU Bash&logoColor=white"/>
<img src="https://img.shields.io/badge/TYPESCRIPT-black?style=for-the-badge&logo=TypeScript&logoColor=3178C6"/>

# Notificaciones Rápidas

Notificaciones Rápidas es una aplicación desarrollada en Laravel que permite enviar notificaciones y archivos a múltiples destinatarios a través de WhatsApp. La aplicación es capaz de enviar archivos PDF e imágenes en formato base64, sin un límite de destinatarios, y ofrece la funcionalidad de programar alertas para su envío futuro. Esta aplicación utiliza la API proporcionada por Buho, facilitando la realización de pruebas.

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

1. **Clonar el repositorio**:

    ```bash
    git clone https://github.com/AndyTR03/Prueba
    cd notificaciones-rapidas
    ```

2. **Instalar las dependencias de PHP**:

    ```bash
    composer install
    ```

3. **Configurar el archivo .env**:

    Copia el archivo `.env.example` y renómbralo a `.env`.
    Configura los detalles de conexión a la base de datos y la clave de API de Buho.

4. **Generar la clave de aplicación**:

    ```bash
    php artisan key:generate
    ```

5. **Migrar la base de datos**:

    ```bash
    php artisan migrate
    ```

6. **Iniciar el servidor de desarrollo**:

    ```bash
    php artisan serve
    ```

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

## Licencia

Este proyecto está licenciado bajo la Licencia MIT - mira el archivo `LICENSE` para más detalles.
