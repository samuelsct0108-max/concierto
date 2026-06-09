# 🎸 Sistema de Gestión de Conciertos y Control de Asistencias

Plataforma empresarial web desarrollada con el framework **Laravel 8** y **PHP** orientada a la automatización global de eventos masivos. El sistema abarca desde la autenticación perimetral de usuarios y la gestión administrativa de eventos, hasta el procesamiento transaccional con manejo de divisas, generación automatizada de entradas digitales en formato PDF y la posterior validación física en los puntos de control mediante códigos de barras únicos.

---

## 🏗️ 1. Arquitectura del Sistema y Patrón de Diseño

El ecosistema de software opera estrictamente bajo el patrón arquitectónico **MVC (Modelo-Vista-Controlador)** provisto por Laravel, complementado con una capa de servicios para desacoplar las integraciones de terceros.

A continuación se detalla la distribución estructural del código fuente modificado para la lógica del negocio:

### 📁 Capa de Controladores (`app/Http/Controllers/`)
* **`AuthController.php`**: Administra los ciclos de vida de las sesiones de los usuarios, gestionando el registro, inicio de sesión y la revocación de tokens de acceso seguro.
* **`ConcertController.php`**: Gobierna el CRUD (Creación, Lectura, Actualización y Eliminado) de los eventos musicales, controlando las restricciones de aforo en tiempo real.
* **`TicketController.php`**: Orquesta el flujo de compra, la invocación de las pasarelas de pago virtuales y el despacho de las entradas al cliente.
* **`AttendanceController.php`**: Destinado al personal de logística para registrar los ingresos escaneados mediante la interfaz web.

### 📁 Capa de Modelos y Persistencia (`app/Models/`)
* **`User.php`**: Representa la entidad de los usuarios. Implementa los rasgos (`Traits`) de autenticación y maneja la relación de uno a muchos con los boletos adquiridos.
* **`Concert.php`**: Define los atributos de los eventos (fechas, locación, costos base). Controla los alcances de disponibilidad mediante ámbitos de consulta (*Query Scopes*).
* **`Ticket.php`**: Entidad crítica que enlaza al cliente con el concierto. Almacena metadatos del código de barras y códigos hash de verificación.
* **`Payment.php`**: Bitácora de auditoría financiera para almacenar el estado de las transacciones procesadas.

### 📁 Rutas del Sistema (`routes/`)
* **`web.php`**: Registra los puntos de acceso para las interfaces visuales, protegidos por los middleware de autenticación por sesión habituales.
* **`api.php`**: Expone los endpoints técnicos utilizados para las peticiones asíncronas y las integraciones con los dispositivos de escaneo de los operarios de control de acceso.

---

## 🛠️ 2. Stack Tecnológico y Especificación de Dependencias

Para asegurar un rendimiento óptimo bajo alta concurrencia en la compra de boletos, el archivo `composer.json` y el entorno de frontend integran herramientas de nivel industrial:

### Entorno Servidor (Backend)
* **PHP >= 7.3 / 8.0**: Lenguaje de tipado dinámico intermedio con soporte para tipado estricto en los servicios del sistema.
* **Laravel Framework 8.54**: Framework robusto enfocado en la mantenibilidad, inyección de dependencias y abstracción de bases de datos.

### Componentes Especializados e Integraciones
* **`barryvdh/laravel-dompdf`**: Envoltura sobre el motor de renderizado DOMPDF. Transforma estructuras HTML/CSS complejas del motor Blade en vectores planos en formato PDF de alta definición para su correcta impresión física.
* **`milon/barcode`**: Generador algorítmico lineal de simbologías de códigos de barras (como Code 128 o códigos QR). Provee las funciones necesarias para incrustar las barras directamente como cadenas Base64 dentro de los PDFs.
* **`cknow/laravel-money`**: Abstracción del patrón de diseño *Money* de Martin Fowler. Evita errores fatales de redondeo en operaciones matemáticas de punto flotante en las pasarelas de pago, aislando los valores en números enteros con la moneda ISO correspondiente.
* **`laravolt/avatar`**: Herramienta de experiencia de usuario que genera de forma matemática avatares vectoriales SVG basados en las iniciales de la cuenta, disminuyendo la carga de almacenamiento de archivos multimedia en servidores locales.
* **Laravel Sanctum**: Emite tokens de API basados en hashes criptográficos para sesiones SPA de forma segura y modular.

---

## 🗄️ 3. Modelo de Datos y Relaciones (Esquema Conceptual)

La persistencia del negocio está estructurada sobre un motor relacional MySQL a través de las migraciones de Laravel, garantizando integridad referencial y cascadas lógicas:

* **Relación Usuario - Boleto (`Users` ➡️ `Tickets`)**: Un usuario puede adquirir múltiples boletos a lo largo de las preventas, pero cada boleto pertenece exclusivamente a un usuario titular asignado (**1 a Muchos**).
* **Relación Concierto - Boleto (`Concerts` ➡️ `Tickets`)**: Un concierto posee un número finito de boletos limitados por el aforo del establecimiento. Cada boleto está impreso para un único concierto (**1 a Muchos**).
* **Relación Boleto - Transacción (`Tickets` ➡️ `Payments`)**: Cada boleto emitido con éxito se encuentra respaldado por una transacción financiera registrada con propósitos de contabilidad legal (**1 a 1**).

---

## 🔐 4. Capa de Seguridad e Integridad

El sistema implementa medidas perimetrales nativas para mitigar las vulnerabilidades críticas del estándar OWASP:
* **Protección contra CSRF (Cross-Site Request Forgery):** Bloqueo automático de inserción de peticiones maliciosas externas en formularios de pago mediante tokens aleatorios de sesión.
* **Prevención de Inyección SQL:** Todas las interacciones con la base de datos se ejecutan por medio del constructor de consultas de Eloquent, utilizando sentencias preparadas de manera nativa (PDO).
* **Cifrado de Contraseñas:** Encriptación irreversible de contraseñas de usuarios en la base de datos aplicando el algoritmo de hashing adaptativo **Bcrypt** con un factor de costo computacional seguro.

---

## 🚀 5. Despliegue, Instalación y Configuración del Entorno

Siga minuciosamente este protocolo para desplegar e iniciar el sistema en su entorno de desarrollo local:

### 1. Clonar y Acceder al Directorio
Descargue la estructura de archivos desde el servidor de control de versiones y navegue hacia el directorio raíz:
```bash
git clone [https://github.com/samuelsct0108-max/concierto.git](https://github.com/samuelsct0108-max/concierto.git)
cd concierto
