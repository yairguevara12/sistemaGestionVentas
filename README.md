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
fecha DATE,
planBase VARCHAR(50),
ciclo VARCHAR(50),
planAMigrar VARCHAR(50),
departamento VARCHAR(50),
tipoDeFc VARCHAR(50),
TipoDeVenta VARCHAR(50)
);

/_ Eliminar fila de venta_detalles _/
DELETE FROM venta_detalles WHERE venta_detalle_id = 4;
SET FOREIGN_KEY_CHECKS = 0;
SET FOREIGN_KEY_CHECKS = 1;

-- Insertar perfiles de usuarios
INSERT INTO usuarios (perfil_id, nombre, email, usuario, clave)
VALUES (1, 'carlitos', 'correo@example.com', 'carlitos', 'Rw154NY=');

INSERT INTO usuarios (perfil_id, nombre, email, usuario, clave)
VALUES (2, 'santitos', 'correo1@example.com', 'santitos', 'Rw154NY=');

INSERT INTO usuarios (perfil_id, nombre, email, usuario, clave)
VALUES (3, 'marquitos', 'correo2@example.com', 'marquitos', 'Rw154NY=');

-- Insertar estados para ventas
INSERT INTO estados_venta (nombre) VALUES ('pendiente');
INSERT INTO estados_venta (nombre) VALUES ('aprobada');
INSERT INTO estados_venta (nombre) VALUES ('rechazada');

-- Insertar estados para backoffice
INSERT INTO estados_backoffice (nombre) VALUES ('pendiente');
-- Agregar más estados para backoffice según sea necesario;

/_ Procedimiento para obtener detalles de ventas _/
DELIMITER //
CREATE PROCEDURE GetSalesDetails()
BEGIN
SELECT
ventas.id AS venta_id,
venta_detalles.fecha,
cliente.nombres,
cliente.nro_de_documento,
estados_venta.nombre AS estado_venta_nombre
FROM
ventas
JOIN venta_detalles ON ventas.venta_detalles_id = venta_detalles.venta_detalle_id
JOIN cliente ON ventas.cliente_id = cliente.cliente_id
JOIN estados_venta ON ventas.estado_venta_id = estados_venta.id;
END //
DELIMITER ;

CALL GetSalesDetails();

/_ Procedimiento para obtener detalles completos de ventas por venta_id _/
DELIMITER //
CREATE PROCEDURE GetFullSalesByVentaId(IN ventaId INT)
BEGIN
SELECT
c.telefono,
c.tipo_de_documento,
c.nro_de_documento,
c.nombres,
c.apellidos,
vd.tipo_de_plan,
vd.nivel_1,
vd.nivel_2,
vd.nivel_3,
vd.nsn,
vd.activacion_inmediata,
vd.observaciones
FROM
cliente c
JOIN ventas v ON c.cliente_id = v.cliente_id
JOIN venta_detalles vd ON v.venta_detalles_id = vd.venta_detalle_id
WHERE
v.id = ventaId;
END //
DELIMITER ;

/_ Insertar más datos _/
-- Agregar más datos a las tablas según sea necesario;

/_ Procedimiento para obtener registros de venta por rango de fechas _/
DELIMITER //
CREATE PROCEDURE ObtenerRegistroVentabyFecha(IN fecha_begin DATE, IN fecha_end DATE)
BEGIN
SELECT
ventas.id AS venta_id,
venta_detalles.fecha,
cliente.nombres,
cliente.nro_de_documento,
estados_venta.nombre AS estado_venta_nombre
FROM
ventas
JOIN venta_detalles ON ventas.venta_detalles_id = venta_detalles.venta_detalle_id
JOIN cliente ON ventas.cliente_id = cliente.cliente_id
JOIN estados_venta ON ventas.estado_venta_id = estados_venta.id
WHERE
venta_detalles.fecha BETWEEN fecha_begin AND fecha_end;
END //
DELIMITER ;

CALL ObtenerRegistroVentabyFecha('2023-04-10','2023-11-10');

/_Procedimiento para actualizar detalles de venta y venta basado en venta_id _/
DELIMITER //
CREATE PROCEDURE UpdateVentaDetalleSeguimientoVenta(
IN p_venta_id INT,
IN p_planBase VARCHAR(50),
IN p_ciclo VARCHAR(50),
IN p_planAMigrar VARCHAR(50),
IN p_departamento VARCHAR(50),
IN p_tipoDeFc VARCHAR(50),
IN p_TipoDeVenta VARCHAR(50),
IN p_EstadoDeVenta INT
)
BEGIN
DECLARE v_venta_detalle_id INT;

    SELECT venta_detalles_id INTO v_venta_detalle_id
    FROM ventas
    WHERE id = p_venta_id;

    IF v_venta_detalle_id IS NOT NULL THEN
        UPDATE venta_detalles
        SET planBase = p_planBase,
            ciclo = p_ciclo,
            planAMigrar = p_planAMigrar,
            departamento = p_departamento,
            tipoDeFc = p_tipoDeFc,
            TipoDeVenta = p_TipoDeVenta
        WHERE venta_detalle_id = v_venta_detalle_id;

        UPDATE ventas
        SET estado_venta_id = p_EstadoDeVenta
        WHERE id = p_venta_id;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'venta detalle no encontrado';
    END IF;

END //
DELIMITER ;
