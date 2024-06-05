CREATE DATABASE IF NOT EXISTS ReservacionLaboratorios;
USE ReservacionLaboratorios;

-- Tabla para los Campus
CREATE TABLE Campus (
    CampusID INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(255) NOT NULL,
    Estado ENUM('Activo', 'Inactivo') NOT NULL
);

-- Tabla para los Edificios
CREATE TABLE Edificios (
    EdificioID INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(255) NOT NULL,
    CampusID INT,
    Estado ENUM('Activo', 'Inactivo') NOT NULL,
    FOREIGN KEY (CampusID) REFERENCES Campus(CampusID)
);

-- Tabla para los Tipos de Aulas
CREATE TABLE TiposDeAulas (
    TipoAulaID INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(255) NOT NULL,
    Estado ENUM('Activo', 'Inactivo') NOT NULL
);

-- Tabla para las Aulas / Laboratorios
CREATE TABLE Aulas (
    AulaID INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(255) NOT NULL,
    TipoAulaID INT,
    EdificioID INT,
    Capacidad INT NOT NULL,
    CuposReservados INT DEFAULT 0,
    Estado ENUM('Activo', 'Inactivo') NOT NULL,
    FOREIGN KEY (TipoAulaID) REFERENCES TiposDeAulas(TipoAulaID),
    FOREIGN KEY (EdificioID) REFERENCES Edificios(EdificioID)
);

-- Tabla para los Usuarios
CREATE TABLE Usuarios (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario VARCHAR(100) NOT NULL,
    TipoUsuario ENUM('Profesor', 'Estudiante', 'Empleado', 'Otro', 'Administrador') NOT NULL,
    Clave varchar(500) NOT NULL,
    Estado ENUM('Activo', 'Inactivo') NOT NULL,
    EmpleadoID INT NOT NULL,
    FOREIGN KEY (EmpleadoID) REFERENCES Empleados(EmpleadoID)
);

-- Tabla para los Empleados
CREATE TABLE Empleados (
    EmpleadoID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Cedula VARCHAR(11) UNIQUE NOT NULL,
    TandaLabor ENUM('Mañana', 'Tarde', 'Noche') NOT NULL,
    FechaIngreso DATE NOT NULL,
    CorreoElectronico VARCHAR(11) UNIQUE NOT NULL,
    NoCarnet VARCHAR(20) UNIQUE NOT NULL,
    Estado ENUM('Activo', 'Inactivo') NOT NULL
);

-- Tabla para la Reservación de Horas
CREATE TABLE Reservaciones (
    ReservacionID INT AUTO_INCREMENT PRIMARY KEY,
    EmpleadoID INT,
    AulaID INT,
    UsuarioID INT,
    FechaReservacion DATETIME NOT NULL,
    CantidadHoras INT NOT NULL,
    Comentario TEXT,
    Estado ENUM('Pendiente', 'Confirmada', 'Cancelada') NOT NULL,
    FOREIGN KEY (EmpleadoID) REFERENCES Empleados(EmpleadoID),
    FOREIGN KEY (AulaID) REFERENCES Aulas(AulaID),
    FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID)
);
