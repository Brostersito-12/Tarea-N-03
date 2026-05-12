-- Base de Datos - Sistema de Heladería 
CREATE DATABASE IF NOT EXISTS heladeria; 
USE heladeria; 

CREATE TABLE IF NOT EXISTS usuarios ( 
    id_usuario INT AUTO_INCREMENT PRIMARY KEY, 
    nombre_usuario VARCHAR(100) UNIQUE NOT NULL, 
    contrasena VARCHAR(255) NOT NULL, 
    rol VARCHAR(50) DEFAULT 'empleado', 
    estado VARCHAR(50) DEFAULT 'activo' 
); 

CREATE TABLE IF NOT EXISTS clientes ( 
    id_cliente INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(100) NOT NULL, 
    apellido VARCHAR(100) NOT NULL, 
    dni VARCHAR(20) UNIQUE, 
    telefono VARCHAR(20), 
    direccion VARCHAR(150), 
    correo VARCHAR(100) 
); 

CREATE TABLE IF NOT EXISTS helados ( 
    id_helado INT AUTO_INCREMENT PRIMARY KEY, 
    nombre_helado VARCHAR(100) NOT NULL, 
    sabor VARCHAR(100), 
    categoria VARCHAR(100), 
    precio DECIMAL(10,2) NOT NULL, 
    stock INT DEFAULT 0, 
    descripcion TEXT 
); 

CREATE TABLE IF NOT EXISTS pedidos ( 
    id_pedido INT AUTO_INCREMENT PRIMARY KEY, 
    id_cliente INT, 
    id_helado INT, 
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP, 
    cantidad INT NOT NULL, 
    total DECIMAL(10,2) NOT NULL, 
    estado_pedido VARCHAR(50) DEFAULT 'pendiente', 

    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente), 
    FOREIGN KEY (id_helado) REFERENCES helados(id_helado) 
); 

INSERT INTO usuarios (nombre_usuario, contrasena, rol, estado) 
VALUES 
('admin', 'admin123', 'admin', 'activo')
ON DUPLICATE KEY UPDATE nombre_usuario=nombre_usuario; 

INSERT INTO helados (nombre_helado, sabor, categoria, precio, stock, descripcion) 
VALUES 
('Helado de Fresa', 'Fresa', 'Crema', 5.50, 100, 'Delicioso helado de fresa natural'), 
('Helado de Chocolate', 'Chocolate', 'Crema', 6.00, 80, 'Chocolate suizo premium'), 
('Helado de Vainilla', 'Vainilla', 'Crema', 5.00, 120, 'Vainilla clásica de Madagascar'), 
('Sorbete de Limón', 'Limón', 'Agua', 4.50, 150, 'Refrescante sorbete de limón');
