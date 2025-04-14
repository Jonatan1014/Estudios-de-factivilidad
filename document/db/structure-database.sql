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

-- Tabla principal: estudios_factibilidad
CREATE TABLE estudios_factibilidad (
    id_estudio INT AUTO_INCREMENT PRIMARY KEY,
    codigo_estudio VARCHAR(50) NOT NULL,
    cliente VARCHAR(255) NOT NULL,
    fecha_estudio DATE NOT NULL,
    alcance VARCHAR(255),
    cotizacion VARCHAR(50),
    dimensiones VARCHAR(100),
    tipo VARCHAR(50),
    cod_fabricacion VARCHAR(50),
    cantidad INT,
    doc_referencia VARCHAR(100)
);

-- Tabla de secciones
CREATE TABLE secciones (
    id_seccion INT AUTO_INCREMENT PRIMARY KEY,
    id_estudio INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    subtotal DECIMAL(15,2),
    porcentaje DECIMAL(5,2),
    FOREIGN KEY (id_estudio) REFERENCES estudios_factibilidad(id_estudio)
);

-- Tabla de items
CREATE TABLE items (
    id_item INT AUTO_INCREMENT PRIMARY KEY,
    id_seccion INT NOT NULL,
    codigo_item VARCHAR(20),
    descripcion TEXT NOT NULL,
    unidad VARCHAR(20),
    cantidad DECIMAL(10,2),
    no_piezas DECIMAL(10,2),
    tarifa DECIMAL(15,2),
    subtotal DECIMAL(15,2),
    FOREIGN KEY (id_seccion) REFERENCES secciones(id_seccion)
);
