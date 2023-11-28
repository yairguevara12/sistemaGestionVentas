Este es el script mysql : 
CREATE DATABASE SistemaGestionDeVentas;
USE SistemaGestionDeVentas;

-- Crear la tabla de perfiles
CREATE TABLE perfiles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50)
);

-- Insertar perfiles
INSERT INTO perfiles (nombre) VALUES
  ('asesor'),
  ('supervisor'),
  ('backoffice');

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  perfil_id INT,
  nombre VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  usuario VARCHAR(20) NOT NULL,
  clave VARCHAR(20) NOT NULL,
  FOREIGN KEY (perfil_id) REFERENCES perfiles(id)
);

-- Crear la tabla de estados de venta
CREATE TABLE estados_venta (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50)
);

-- Crear la tabla de estados de backoffice
CREATE TABLE estados_backoffice (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50)
);

-- Crear la tabla de ventas
CREATE TABLE ventas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  asesor_id INT,
  estado_venta_id INT,
  estado_backoffice_id INT,
  cliente_id INT NOT NULL,
  venta_detalles_id INT NOT NULL,
  FOREIGN KEY (asesor_id) REFERENCES usuarios(id),
  FOREIGN KEY (estado_venta_id) REFERENCES estados_venta(id),
  FOREIGN KEY (estado_backoffice_id) REFERENCES estados_backoffice(id),
  FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id),
  FOREIGN KEY (venta_detalles_id) REFERENCES venta_detalles(venta_detalle_id)
);

-- Crear la tabla de clientes
CREATE TABLE cliente (
  cliente_id INT PRIMARY KEY AUTO_INCREMENT,
  telefono VARCHAR(20),
  tipo_de_documento VARCHAR(20),
  nro_de_documento VARCHAR(20),
  nombres VARCHAR(50),
  apellidos VARCHAR(50)
);

-- Crear la tabla de detalles de venta
CREATE TABLE venta_detalles (
  venta_detalle_id INT PRIMARY KEY AUTO_INCREMENT,
  tipo_de_plan VARCHAR(50),
  nivel_1 VARCHAR(50),
  nivel_2 VARCHAR(50),
  nivel_3 VARCHAR(50),
  nsn VARCHAR(50),
  activacion_inmediata BOOLEAN,
  observaciones VARCHAR(255),
  fecha DATE
);

-- Ejecutar consultas adicionales si es necesario, por ejemplo, declaraciones SELECT
SELECT * FROM perfiles;
SELECT * FROM cliente;
SELECT * FROM ventas;
SELECT * FROM venta_detalles;
SELECT * FROM usuarios;
select * from estados_venta;
select * from estados_backoffice;

/*-------adding----*/
DELETE FROM venta_detalles where venta_detalle_id=4;

/*

*/

--  perfil_id  'asesor' is 1
INSERT INTO usuarios (perfil_id, nombre, email, usuario, clave)
VALUES (1, 'carlitos', 'correo@example.com', 'carlitos', 'Rw154NY=');
/*it means clave */

INSERT INTO estados_venta (nombre) VALUES ('pendiente');

-- Insert 'aprobada'
INSERT INTO estados_venta (nombre) VALUES ('aprobada');

-- Insert 'rechazada'
INSERT INTO estados_venta (nombre) VALUES ('rechazada');


/*-----------------*/
-- Insert 'pendiente'
INSERT INTO estados_backoffice (nombre) VALUES ('pendiente');

-- Insert 'programado'
INSERT INTO estados_backoffice (nombre) VALUES ('programado');

-- Insert 'pre activo'
INSERT INTO estados_backoffice (nombre) VALUES ('pre activo');

-- Insert 'deuda'
INSERT INTO estados_backoffice (nombre) VALUES ('deuda');

-- Insert 'existe programacion pendiente'
INSERT INTO estados_backoffice (nombre) VALUES ('existe programacion pendiente');

-- Insert 'L. Bloqueada'
INSERT INTO estados_backoffice (nombre) VALUES ('L. Bloqueada');

-- Insert 'No existe interaccion'
INSERT INTO estados_backoffice (nombre) VALUES ('No existe interaccion');

-- Insert 'no venta'
INSERT INTO estados_backoffice (nombre) VALUES ('no venta');

-- Insert 'error de tipificacion'
INSERT INTO estados_backoffice (nombre) VALUES ('error de tipificacion');

-- Insert 'plan ya migrado'
INSERT INTO estados_backoffice (nombre) VALUES ('plan ya migrado');

-- Insert 'desiste'
INSERT INTO estados_backoffice (nombre) VALUES ('desiste');

-- Insert 'error de numero'
INSERT INTO estados_backoffice (nombre) VALUES ('error de numero');

-- Insert 'error de sistema'
INSERT INTO estados_backoffice (nombre) VALUES ('error de sistema');

-- Insert 'tipificacion incompleta'
INSERT INTO estados_backoffice (nombre) VALUES ('tipificacion incompleta');

-- Insert 'L. No es linea postpago'
INSERT INTO estados_backoffice (nombre) VALUES ('L. No es linea postpago');

-- Insert 'Contrato Suspendido'
INSERT INTO estados_backoffice (nombre) VALUES ('Contrato Suspendido');

-- Insert 'Incidencia Claro'
INSERT INTO estados_backoffice (nombre) VALUES ('Incidencia Claro');
