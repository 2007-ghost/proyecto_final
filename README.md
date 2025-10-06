# 🚛 Transporte API

## 🧾 Descripción del Proyecto

**Transporte API** es una aplicación backend desarrollada en **Laravel** que permite gestionar información relacionada con el sistema de transporte.  
Incluye autenticación de usuarios usando **Laravel Sanctum**, lo que permite proteger las rutas y gestionar tokens de sesión de forma segura.

---

## 🧰 Requisitos Previos

Antes de empezar, asegúrate de tener instalados los siguientes programas:

| Herramienta | Versión recomendada | Descripción |
|--------------|--------------------|--------------|
| [PHP](https://www.php.net/downloads.php) | 8.2 o superior | Lenguaje base de Laravel |
| [Composer](https://getcomposer.org/download/) | Última versión | Manejador de dependencias PHP |
| [Node.js](https://nodejs.org/) | 18 o superior | Para compilar assets del frontend |
| [NPM](https://www.npmjs.com/get-npm) | Incluido con Node.js | Manejador de paquetes JS |
| [MySQL](https://dev.mysql.com/downloads/mysql/) | 8 o superior | Base de datos |
| [Laragon](https://laragon.org/) o [XAMPP](https://www.apachefriends.org/es/index.html) | Opcional | Entorno de desarrollo local |

---

## ⚙️ Instalación del Proyecto

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/usuario/transporte-api.git
cd transporte-api
```

### 2️⃣ Instalar dependencias de Laravel

```bash
composer install
```

### 3️⃣ Configurar el archivo `.env`

```bash
cp .env.example .env
```

Configura tus credenciales de base de datos:

```env
APP_NAME=TransporteAPI
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transporte
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000
SESSION_DOMAIN=127.0.0.1
```

### 4️⃣ Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5️⃣ Crear la base de datos

Crea una base llamada `transporte` y ejecuta:

```bash
php artisan migrate
```

### 6️⃣ Crear usuario de prueba

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@admin.com',
    'password' => bcrypt('123456')
]);
```

### 7️⃣ Ejecutar el servidor

```bash
php artisan serve
```

Accede a: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔐 Autenticación con Sanctum

### Login

**POST** `/api/login`

```json
{
  "email": "admin@admin.com",
  "password": "123456"
}
```

**Respuesta:**

```json
{
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@admin.com"
  }
}
```

### Logout

**POST** `/api/logout`  
Header:
```
Authorization: Bearer TU_TOKEN
```

---

## 📡 Ejemplo con JavaScript

```js
axios.post('http://127.0.0.1:8000/api/login', {
  email: 'admin@admin.com',
  password: '123456'
})
.then(response => console.log('Token:', response.data.token))
.catch(error => console.error(error.response.data));
```

---

## 🧩 Estructura del Proyecto

```
transporte-api/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   ├── js/
│   ├── views/
├── routes/
├── .env
└── composer.json
```

---

## 🧪 Probar con Postman

Base URL:
```
http://127.0.0.1:8000/api/
```

Ejemplo de Header:
```
Authorization: Bearer TU_TOKEN
```

---

## 🧯 Solución de Problemas

| Error | Causa | Solución |
|--------|--------|-----------|
| `Unknown database` | Base no creada | Crea la base `transporte` |
| `Class not found` | Falta autoload | Ejecuta `composer dump-autoload` |
| `Token mismatch` | CSRF inválido | Ejecuta `php artisan cache:clear` |
| `404` | Ruta incorrecta | Verifica `/api/login` |

---

## 🏁 Listo 🎉

Tu API está configurada y lista para usarse.
