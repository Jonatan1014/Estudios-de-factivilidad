CREATE DATABASE t4ll3r3s

USE t4ll3r3s

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('root', 'admin', 'user') NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proveedor VARCHAR(255),
    contacto VARCHAR(255),
    telefono VARCHAR(20),
    ciudad VARCHAR(255),
    tema_asociado TEXT
);
