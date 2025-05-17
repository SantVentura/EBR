/* con este comando creamos la base de datos*/
CREATE DATABASE IF NOT EXISTS blog_recetas;
/* aca usamos la base recien creada*/
USE blog_recetas;
/* Creamos la tabla usuarios y ojo porque definimos la PK si se dan cuenta */
/* Creamos la tabla Usuarios */
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL
);

/*Creamos la tabla roles */
CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);
/*Creamos la tabla Asignacion Roles */
/*OJO aca ya estamos definiendo las llaves foraneas */
CREATE TABLE AsignacionRoles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    rol_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (rol_id) REFERENCES Roles(id)
);
/*Creamos la tabla categorias de recetas */
CREATE TABLE CategoriasRecetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) NOT NULL
);
/*Creamos la tabla de recetas*/
/*CREATE TABLE Recetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES CategoriasRecetas(id)
);*/
CREATE TABLE Recetas ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(255), -- Para guardar la ruta de la imagen (ej: /assets/img/pollo.jpg)
    vista_previa TEXT,    -- Un resumen corto para mostrar en hover
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES CategoriasRecetas(id)
);

/*Creamos la tabla de valoraciones */
CREATE TABLE IF NOT EXISTS Valoraciones (
    id_valoracion INT PRIMARY KEY AUTO_INCREMENT,
    estrellas INT NOT NULL CHECK (estrellas BETWEEN 1 AND 5),
    id_usuario INT,
    id_receta INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id),
    FOREIGN KEY (id_receta) REFERENCES Recetas(id)
);
/*Crear tabla de donaciones */
CREATE TABLE Donaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    fecha_donacion DATE NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
);
ALTER TABLE Recetas ADD COLUMN aprobada BOOLEAN DEFAULT FALSE;

