-- Tabla de usuarios
CREATE TABLE usuarios (
    idUser INT AUTO_INCREMENT PRIMARY KEY,        -- Identificador único para cada usuario
    code_cc VARCHAR(50) NOT NULL UNIQUE,           -- Correo electrónico único
    name VARCHAR(50) NOT NULL,                    -- Nombre de usuario
    email VARCHAR(100) NOT NULL UNIQUE,           -- Correo electrónico único
    password VARCHAR(255) NOT NULL,               -- Contraseña (encriptada)
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de registro automática
    ultimo_acceso TIMESTAMP NULL,                 -- Fecha y hora del último acceso
    rol ENUM('Root', 'Admin', 'Estudiante') DEFAULT 'Estudiante',  -- Rol del usuario
    carrera ENUM('Admi. Empresas', 'Ing. Sistemas', 'Diseño grafico','Ing. Industrial','Psicologia','Admin') DEFAULT 'Admin',  -- Rol del usuario
    estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo'  -- Estado de la cuenta (activo/inactivo)
);
INSERT INTO usuarios (code_cc, name, email, password, rol, carrera, estado) 
VALUES ("101010", "Jonatan Cantillo", "jonatan@gmail.com", "$2y$10$4ch8QBRsDGBW119RzOTpM.t2.tjaTYJVYc7hOcWKWzn17SUUlRMJi", "Root", "Admin", "Activo");
INSERT INTO usuarios (code_cc, name, email, password, rol, carrera, estado) 
VALUES ("202020", "Laura Perez", "laura@gmail.com", "$2y$10$4ch8QBRsDGBW119RzOTpM.t2.tjaTYJVYc7hOcWKWzn17SUUlRMJi", "Admin", "Admin", "Activo");

-- Tabla de libros
CREATE TABLE libros (
    idLibro INT AUTO_INCREMENT PRIMARY KEY,       -- Identificador único para cada libro
    titulo VARCHAR(255) NOT NULL,                 -- Título del libro
    autor VARCHAR(255) NOT NULL,                  -- Autor del libro
    editorial VARCHAR(255) NOT NULL,              -- Editorial del libro
    año_publicacion YEAR NOT NULL,                -- Año de publicación del libro
    isbn VARCHAR(13) UNIQUE NOT NULL,             -- ISBN único del libro
    edicion INT NOT NULL,             -- ISBN único del libro
    idioma ENUM('Español', 'Ingles') DEFAULT 'Español',  -- Estado del libro
    portada LONGBLOB,                             -- Imagen de la portada del libro
    qr_code LONGBLOB,                             -- Código QR en formato imagen
    estado ENUM('Disponible', 'Prestado', 'Inactivo') DEFAULT 'Disponible',  -- Estado del libro
    categoria ENUM('Programacion', 'Matematicas', 'Lectura Critica', "Psicologia", "Diseño Grafico", "Finanzas","Otro") DEFAULT 'Otro',  -- Estado del libro
    resena LONGTEXT,
    ubicacion VARCHAR(50)
);

-- Tabla de préstamos
CREATE TABLE prestamos (
    idPrestamo INT AUTO_INCREMENT PRIMARY KEY,    -- Identificador único para cada préstamo
    idUser INT NOT NULL,                          -- ID del usuario que realizó el préstamo (llave foránea)
    idLibro INT NOT NULL,                         -- ID del libro prestado (llave foránea)
    fecha_prestamo DATE NOT NULL,                 -- Fecha en que se realizó el préstamo
    fecha_vencimiento DATE NOT NULL,              -- Fecha en que vence el préstamo
    fecha_devolucion DATE NULL,                   -- Fecha en que se devuelve el libro (si aplica)
    estado ENUM('Activo', 'Devuelto', 'Vencido') DEFAULT 'Activo',  -- Estado del préstamo
    FOREIGN KEY (idUser) REFERENCES usuarios(idUser) ON DELETE CASCADE,  -- Relación con usuarios
    FOREIGN KEY (idLibro) REFERENCES libros(idLibro) ON DELETE CASCADE   -- Relación con libros
);

