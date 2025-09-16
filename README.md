# Proyecto Assist 365

Este proyecto consiste en un sistema de gestión de reservas y pasajeros, con un dashboard en tiempo real que se comunica con un servicio Node.js vía sockets. Está desarrollado utilizando **PHP con Laravel** para el backend principal, **Node.js** para el servicio de notificaciones en tiempo real y **Vue.js/Frontend** para el dashboard.

---

## Cómo correr el proyecto

### Backend - PHP / Laravel

1. **Configurar variables de entorno**

Crea un archivo `.env` en la raíz del proyecto y define las variables de conexión a la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assist_365
DB_USERNAME=root
DB_PASSWORD=
```

2. **Instalar dependencias de PHP**

```bash
composer install
```

3. **Migrar la base de datos**

```bash
php artisan migrate
```

4. **Cargar datos de prueba**

```bash
php artisan db:seed  # Esto crea pasajeros de prueba
```

5. **Levantar el servidor de desarrollo**

```bash
php artisan serve
```

El backend estará disponible en `http://127.0.0.1:8000` por defecto.

---

### Servicio Node.js - Socket

El servicio Node se encarga de monitorear cambios en la base de datos y notificar a los clientes conectados en tiempo real.

1. **Ingresar a la carpeta del servicio**

```bash
cd node-service
```

2. **Configurar variables de entorno**

Crea un archivo `.env` en la carpeta `node-service` con la siguiente configuración:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assist_365
DB_USERNAME=root
DB_PASSWORD=
POLL_INTERVAL=2000  # Intervalo de chequeo de cambios en milisegundos
```

3. **Instalar dependencias de Node.js**

```bash
npm install
```

4. **Iniciar el servicio**

```bash
node main.js
```

---

### Frontend - Dashboard

1. **Instalar dependencias**

```bash
npm install
```

2. **Levantar servidor de desarrollo**

```bash
npm run dev  # modo desarrollo
```

El dashboard estará disponible en el puerto configurado en `vite.config.js` (por defecto `http://localhost:3000`).

---

## Justificación técnica de la arquitectura

El proyecto está estructurado siguiendo principios de **arquitectura limpia**, priorizando:

- **Composición sobre herencia:** Evita jerarquías rígidas y permite mayor flexibilidad.
- **Inyección de dependencias:** Desacopla los componentes, facilita testing y mantenimiento.
- **Patrones de diseño:**  
  - **Factory:** Para la creación de objetos complejos y desacoplar la lógica de instanciación.  
  - **Inyeccion de dependecia:** desacopla los componentes de una aplicación, promoviendo la modularidad, flexibilidad.  
- **Principios SOLID:** Para asegurar código más mantenible, escalable y entendible.

Estas decisiones permiten escalar el proyecto de manera ordenada, agregar nuevas funcionalidades sin impactar la arquitectura existente y mantener un código limpio y testeable.

---

## Estructura del proyecto (resumida)

```
├── app/       # Código PHP Laravel
├── node-service/          # Servicio de notificaciones en tiempo real
├── front/    # Dashboard en Vue.js / Vite
└── README.md
```

---

## Notas adicionales

- Asegúrate de tener MySQL corriendo y la base de datos creada antes de ejecutar migraciones.
- El `POLL_INTERVAL` en Node.js puede ajustarse según la frecuencia deseada de actualización en tiempo real.
- Para producción, se recomienda configurar servidores web y proxies (Nginx, PM2, etc.) y habilitar HTTPS.

