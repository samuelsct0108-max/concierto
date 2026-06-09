# Sistema de Gestión de Conciertos

Plataforma web desarrollada en Laravel 8 para la administración de eventos, control de asistencia y gestión de boletería digital.

## Características principales

* **Gestión de Boletería:** Control de precios y conversión automática de divisas utilizando `cknow/laravel-money`.
* **Emisión de Entradas:** Generación automatizada de comprobantes de ingreso en formato PDF mediante `barryvdh/laravel-dompdf`.
* **Seguridad en Accesos:** Asignación de códigos de barras únicos por boleto utilizando la librería `milon/barcode`.
* **Seguridad y API:** Autenticación de usuarios y protección de rutas mediante Laravel Sanctum.
* **Perfiles de Usuario:** Generación dinámica de avatares con las iniciales del usuario a través de `laravolt/avatar`.

## Requisitos del sistema

* PHP >= 7.3 o PHP 8.0
* Composer
* Node.js & NPM
* Servidor de Base de Datos (MySQL / MariaDB)

## Instalación y configuración local

Sigue estos pasos para desplegar el proyecto en un entorno de desarrollo:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/samuelsct0108-max/concierto.git](https://github.com/samuelsct0108-max/concierto.git)
   cd concierto
