// server.js
require("dotenv").config();
const express = require("express");
const { createServer } = require("http");
const { Server } = require("socket.io");
const mysql = require("mysql2/promise");

const app = express();
const httpServer = createServer(app);
const io = new Server(httpServer, { cors: { origin: "*" } });

// Configuración DB desde .env
const dbConfig = {
    host: process.env.DB_HOST,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
    port: process.env.DB_PORT || 3306
};

// Último ID de notificación leído
let lastNotificationId = 0;

async function checkNotifications() {
    const connection = await mysql.createConnection(dbConfig);
    const [rows] = await connection.execute(
        "SELECT * FROM notifications WHERE id > ? ORDER BY id ASC",
        [lastNotificationId]
    );

    if (rows.length > 0) {
        rows.forEach((row) => {
            console.log("Nueva notificación:", row);

            // Emitir a todos los clientes conectados
            io.emit("reservation.updated", {
                id: row.id,
                event: row.event,
                data: JSON.parse(row.data),
                created_at: row.created_at
            });

            lastNotificationId = row.id;
        });
    }

    await connection.end();
}

// Polling cada X ms (configurable por .env)
setInterval(checkNotifications, process.env.POLL_INTERVAL || 2000);

io.on("connection", (socket) => {
    console.log("Cliente conectado ✅");

    socket.on("disconnect", () => {
        console.log("Cliente desconectado ❌");
    });
});

httpServer.listen(3001, () => {
    console.log("Servidor WS escuchando en http://localhost:3001");
});
