-- Script para importar datos del archivo AEREOENFRIADOR ORITO 2A-B.xlsx
-- Base de datos: estudios_factibilidad

-- =============================================
-- Hoja: E-4105 HAZ TCF BACKING (Sheet 1)
-- =============================================

-- Insertar cabecera del estudio
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    'E-4105', 
    'ECOPETROL', 
    '2024-04-09', 
    'FABRICACION HAZ DE TUBOS , TCF Y BACKING RING E-4105A', 
    NULL, 
    '29 X 288"', 
    'AJS', 
    NULL, 
    2, 
    NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio_1 = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '1.1', 'CABEZAL FIJO  775 X 40 SA 266 GR 70', 'EA', 1, 1, 3450000, 3450000),
(@id_seccion, '1.2', 'CABEZAL FLOTANTE 736 X 40 SA 266 GR 2', 'EA', 1, 1, 3250000, 3250000),
(@id_seccion, '1.3', 'TUBERIA 3/4" BWG 16 X 24 FT SA 179', 'EA', 505, 1, 63000, 31815000),
(@id_seccion, '1.4', 'TUBERIA 3/4" BWG 16 X 24 FT SA 179 SEPARADORTES', 'EA', 6, 1, 63000, 378000),
(@id_seccion, '1.5', 'BAFLES 748 X 16 A 36', 'KG', 58, 1, 7500, 435000),
(@id_seccion, '1.6', 'BAFLES 748 X 8 mm  A 36', 'KG', 32, 16, 7500, 3840000),
(@id_seccion, '1.7', 'VARILLAS TENSORAS AC', 'UND.', 6, 1, 150000, 900000),
(@id_seccion, '1.8', 'PALTINAS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.9', 'TCF ID 29" SA  516 GR 70', 'EA', 1, 1, 2000000, 2000000),
(@id_seccion, '1.10', 'LAMINA CAP', 'KG', 130, 1, 8500, 1105000),
(@id_seccion, '1.11', 'FORJA  TCF  815 X 684 X 84 SA 266 GR 2', 'EA', 1, 1, 2300000, 2300000),
(@id_seccion, '1.12', 'FORJA  BACKING  815 X 684 X 102 SA 266 GR 2', 'EA', 1, 1, 2750000, 2750000),
(@id_seccion, '1.13', 'EMPAQUES ACERO AL CARBON', 'EA', 5, 2, 1250000, 12500000),
(@id_seccion, '1.14', 'ESPARRAGOS TUERCAS', 'KIT', 1, 1, 3500000, 3500000),
(@id_seccion, '1.15', 'ANODOS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.16', 'PINTURA TCF', 'EA', 1, 1, 1000000, 1000000),
(@id_seccion, '1.17', 'DISCOS PRUEBA HIDROSTATICA', 'KG', 260, 4, 7500, 7800000),
(@id_seccion, '1.18', 'ANILLOS PRUEBA', 'KG', 80, NULL, 7500, 600000);

-- Actualizar subtotal de MATERIALES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 3, 1, 9500000, 28500000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 3, 1, 8500000, 25500000);

-- Actualizar subtotal de INGENIERIA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'EA', 2, 1, 50000, 100000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 1, 1, 200000, 200000),
(@id_seccion, '3.3', 'ALIVIO TERMICO TCF', 'EA', 1, 1, 2500000, 2500000);

-- Actualizar subtotal de PRUEBAS NO DESTRUCTIVAS
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '4.1', 'EXPANDER', 'EA', 1, 1, 1800000, 1800000),
(@id_seccion, '4.2', 'BROCA', 'EA', 1, 1, 250000, 250000),
(@id_seccion, '4.3', 'RIMA', 'EA', 1, 1, 500000, 500000),
(@id_seccion, '4.4', 'SOLDADURA', 'KG', 5, 1, 18000, 90000),
(@id_seccion, '4.5', 'DISCOS PULIDORAS', 'EA', 10, 1, 18000, 180000),
(@id_seccion, '4.6', 'LIQUIDOS PENETRANTES', 'KIT', 1, 1, 500000, 500000);

-- Actualizar subtotal de CONSUMIBLES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '5.1', 'TRASNPORTE ALIVIO', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '5.2', 'TRANASPORTE REFINERIA ECP BCA', 'EA', 1, 1, 1000000, 1000000);

-- Actualizar subtotal de TRANSPORTE
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '6.1', 'MECANIZAR TORNO CABEZALES,FORJAS', 'HR', 24, 4, 70000, 6720000),
(@id_seccion, '6.2', 'PERFORA BRIDAS TCF BACKING', 'HR', 12, 2, 80000, 1920000),
(@id_seccion, '6.3', 'PROGRAMA Y MONTAJE CNC CABEZALES', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.4', 'CENTRO PUNTEAR  CABEZALES 505', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.5', 'PERFORAR CABEZALES', 'HR', 42, 2, 80000, 6720000),
(@id_seccion, '6.6', 'RIMAR CABEZALES', 'HR', 50, 2, 80000, 8000000),
(@id_seccion, '6.7', 'ACAMPANAR CABEZALES', 'HR', 3, 2, 70000, 420000),
(@id_seccion, '6.8', 'RANURAS DE SELLO CABEZALES', 'HR', 6, 2, 80000, 960000),
(@id_seccion, '6.9', 'RANURAS EXPANSION', 'HR', 9, 2, 70000, 1260000),
(@id_seccion, '6.10', 'ROSCAS TENSORAS', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.11', 'CORTE DE BAFLES Y SOLDAR PAQUETE', 'HR', 8, 2, 70000, 1120000),
(@id_seccion, '6.13', 'MONTAJE  CENTRO PUNTEAR BAFLES', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.14', 'PERFORAR  PAQUETE BAFLES', 'HR', 25, 2, 80000, 4000000),
(@id_seccion, '6.15', 'MECANIZAR PAQUETE BAFLES', 'HR', 24, 2, 70000, 3360000),
(@id_seccion, '6.16', 'ACAMPANAR BAFLES', 'HR', 2, 17, 70000, 2380000),
(@id_seccion, '6.17', 'SEGMENTAR BAFLES', 'HR', 1, 17, 70000, 1190000),
(@id_seccion, '6.18', 'CORTE SEPARADORES', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.19', 'ARMAR ESQUELETO', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.2', 'MONTAJE CABEZAL FIJO', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.21', 'ENTUBAR 550 TUBOS', 'HR', 16, 1, 70000, 1120000),
(@id_seccion, '6.22', 'MONTAJE CABEZAL FLOTANTE', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.23', 'REGRESAR TUBERIA', 'HR', 10, 1, 70000, 700000),
(@id_seccion, '6.24', 'EXPANDIR', 'EA', 550, 1, 15000, 8250000),
(@id_seccion, '6.25', 'MECANIZAR Y PERFORAR  ANILLOS DE PRUEBA HIDROSTATICA', 'HR', 12, 4, 70000, 3360000),
(@id_seccion, '6.26', 'INSTALAR PLATINAS DE SELLO E IMPACTO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.27', 'SOLDAR CAP', 'PUL', 29, 1, 70000, 2030000);

-- Actualizar subtotal de MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 2, 70000, 700000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, 2, 70000, 2240000);

-- Actualizar subtotal de PRUEBA HIDROSTATICA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_1, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '8.1', 'SANDBLASTING TCF', 'M2', 5, 1, 60000, 300000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 5, 3, 60000, 900000);

-- Actualizar subtotal de PINTURA MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- =============================================
-- Hoja: ORITO2AB (Sheet 2)
-- =============================================

-- Insertar cabecera del estudio
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    'ORITO2AB', 
    'ECP APIAY', 
    '2025-02-22', 
    'FABICACION DE DOS AERO ENFRIADORES  2A/B', 
    NULL, 
    '1350 X  4570  9O TUBOS ALETEADOS', 
    'AJS', 
    NULL, 
    2, 
    NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio_2 = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '1.1', 'TUBERIA 1" BWG 14  X 15 FT ALETAS ALUMINIO  FOB 50 DIAS', 'FT', 15, 90, 16000, 21600000),
(@id_seccion, '1.2', 'LAMINA FRONTAR TAPONES Y TUBERIA 1350 X 250 X 25,4', 'KG', 100, 4, 9000, 3600000),
(@id_seccion, '1.3', 'LAMINA SUPERIOR E INFERIOS 1350 150 X 25,4', 'KG', 60, 4, 9000, 2160000),
(@id_seccion, '1.4', 'LAMINAS LATERALES 250 X 170 X 25,4', 'KG', 15, 4, 9000, 540000),
(@id_seccion, '1.5', 'LAMINA INOX', 'kg', 20, 5, 18000, 1800000),
(@id_seccion, '1.6', 'TAPONES 180 UNIDADES + 60 SUMINISTRO', 'KG', 240, 1, 35000, 8400000),
(@id_seccion, '1.7', 'BRIDA DE 4 X 150 SCH 160', 'EA', 1, 1, 1500000, 1500000),
(@id_seccion, '1.8', 'BRIDA DE 2" X 150 SCH 160', 'EA', 1, 1, 1200000, 1200000),
(@id_seccion, '1.9', 'TBO DE 4" SCH 160', 'MT', 2, 1, 1650000, 3300000),
(@id_seccion, '1.10', 'TUBO DE 2" SCH 160', 'MT', 2, 1, 1850000, 3700000),
(@id_seccion, '1.11', 'MATERIAL ARADELA', 'EA', 240, 1, 5000, 1200000),
(@id_seccion, '1.12', 'COUPLING DE 1"', 'EA', 2, 1, 80000, 160000),
(@id_seccion, '1.13', 'EMPAQUES ACERO AL CARBON', 'EA', 2, 1, 70000, 140000),
(@id_seccion, '1.14', 'ANGULOS DE 3" X 1/4', 'EA', 4, 1, 350000, 1400000),
(@id_seccion, '1.15', 'MALLA PROTECCION', 'M2', 8, 2, 80000, 1280000),
(@id_seccion, '1.16', 'PINTURA', 'EA', 1, 1, 2500000, 2500000),
(@id_seccion, '1.17', 'LAMINA 4500 X 500 X 7 ESTRUCTURA', 'KG', 160, 2, 8000, 2560000);

-- Actualizar subtotal de MATERIALES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 1, 1, 7500000, 7500000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 2.5, 1, 9000000, 22500000),
(@id_seccion, '2.3', 'PLANOS HAZ', 'EA', 3, 1, 150000, 450000);

-- Actualizar subtotal de INGENIERIA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'MT', 20, 1, 50000, 1000000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 3, 1, 200000, 600000),
(@id_seccion, '3.3', 'ALIVIO TERMICO', 'EA', 2, 1, 1500000, 3000000),
(@id_seccion, '3.4', 'RADIOGRAFIA 100%', 'EA', 12, 1, 500000, 6000000),
(@id_seccion, '3.5', 'DISPONIBILIDAD RX', 'EA', 2, 1, 500000, 1000000);

-- Actualizar subtotal de PRUEBAS NO DESTRUCTIVAS
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '4.1', 'SOLDADURA', 'KG', 70, 1, 20000, 1400000),
(@id_seccion, '4.2', 'DISCOS PULIÑIDORA', 'EA', 50, 1, 18000, 900000),
(@id_seccion, '4.3', 'LIQUIDOS PENETRANTES', 'EA', 2, 1, 500000, 1000000),
(@id_seccion, '4.4', 'PLANTA ELECTRICA', 'EA', 2, 1, 1200000, 2400000),
(@id_seccion, '4.5', 'EXPANDER', 'EA', 1, 1, 800000, 800000);

-- Actualizar subtotal de CONSUMIBLES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '5.1', 'MOVIMIENTO PUENTE GRUA', 'HR', 2, NULL, 50000, 100000),
(@id_seccion, '5.2', 'TRANASPORTE REFINERIA ORITO', 'EA', 1, 1, 4000000, 4000000);

-- Actualizar subtotal de TRANSPORTE
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '6.1', 'CORTE DE MATERIALES', 'HR', 8, 3, 70000, 1680000),
(@id_seccion, '6.2', 'BISELAS CABEZALES  DE 1500  LONGITUD CON BISELES', 'HR', 6, 16, 70000, 6720000),
(@id_seccion, '6.3', 'BISELAR CABEZALES  DE 300  LONGITUD CON BISELES', 'HR', 4, 16, 70000, 4480000),
(@id_seccion, '6.4', 'SOLDADURA LONGITUDINAL 59" X 1,5"', 'PUL2', 88, 8, 20000, 14080000),
(@id_seccion, '6.26', 'SOLDADURA LONGITUDINAL 10" X115', 'PUL', 15, 8, 20000, 2400000),
(@id_seccion, '6.27', 'SOLDADURA LONGITUDINAL 6" X 1,5', 'PUL', 9, 8, 20000, 1440000),
(@id_seccion, '6.5', 'FABRICACION E INSTALACION  PASOS INTERNOR', 'HR', 8, 6, 70000, 3360000),
(@id_seccion, '6.6', 'FABRICACION TAPONES', 'EA', 240, 1, 40000, 9600000),
(@id_seccion, '6.7', 'FABRICACION ARANDELAS', 'EA', 240, 1, 5000, 1200000),
(@id_seccion, '6.8', 'REALIZAR PERFORACIONES 360', 'HR', 36, 1, 70000, 2520000),
(@id_seccion, '6.28', 'REALIZAR 180 ROSCAS  EN CABEZALES', 'HR', 36, 1, 70000, 2520000),
(@id_seccion, '6.29', 'RECTIFICAR CABEZALES', 'HR', 12, 2, 70000, 1680000),
(@id_seccion, '6.9', 'FABRICAR ESTRUCTURA', 'HR', 20, 2, 70000, 2800000),
(@id_seccion, '6.3', 'ARMADO GENERAL', 'HR', 24, 1, 70000, 1680000),
(@id_seccion, '6.31', 'ENTUBAR 90 TUBOS Y EXPANDIR', 'HR', 12, 2, 70000, 1680000);

-- Actualizar subtotal de MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, 2, 70000, 2240000);

-- Actualizar subtotal de PRUEBA HIDROSTATICA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_2, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '8.1', 'SANDBLASTING', 'M2', 10, 2, 60000, 1200000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 10, 2, 60000, 1200000);

-- Actualizar subtotal de PINTURA MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- =============================================
-- Hoja: Hoja1 (Sheet 3)
-- =============================================

-- Insertar cabecera del estudio
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    '110372', 
    'HOCOL', 
    '2024-12-03', 
    'FABRICAR AERO ENFRIADOR 110372   5', 
    '11', 
    'DIAMETRO 31" X 8,5  CON 70 TUBOS ALETEADOS', 
    'SCRUBER', 
    NULL, 
    1, 
    NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio_3 = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '1.1', 'CABEZALES 770 X 254 X 25,4 SA 516 GR 70', 'KG', 40, 8, 10000, 3200000),
(@id_seccion, '1.2', 'PLATINA LATERAL 225 X 102 X 25,4 E INTERNO', 'KG', 6, 8, 10000, 480000),
(@id_seccion, '1.3', 'TUBERIA OD 5/8" X 218 1/2" SA 214 CON ALETAS EN ALUMINIO', 'FT', 20, 70, 15000, 21000000),
(@id_seccion, '1.4', 'CHANEL ESTRUCTUTA', 'EA', 2, 1, 1350000, 2700000),
(@id_seccion, '1.5', 'MATERIAL EXTRUCTURA', 'KG', 120, 1, 7500, 900000),
(@id_seccion, '1.6', 'MATERIAL TAPONES', 'EA', 72, 2, 22000, 3168000),
(@id_seccion, '1.7', 'MATERIAL ARANDELAS', 'EA', 140, 1, 1500, 210000),
(@id_seccion, '1.8', 'BRIDA DE 2" SCH 160', 'EA', 2, 1, 425000, 850000),
(@id_seccion, '1.9', 'TUBO DE 2"', 'MT', 1, 1, 450000, 450000),
(@id_seccion, '2', 'TORNILLERIA', 'KIT', 1, 1, 750000, 750000),
(@id_seccion, '1.10', 'PINTURA', 'EA', 1, 1, 1500000, 1500000);

-- Actualizar subtotal de MATERIALES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '2.1', 'INGENIERIA', 'EA', 1, 1, 8500000, 8500000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 2.5, 1, 8500000, 21250000),
(@id_seccion, '2.3', 'PLANOS HAZ', 'EA', 4, 1, 200000, 800000);

-- Actualizar subtotal de INGENIERIA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '3.1', 'TINTAS', 'MT', 20, 1, 35000, 700000),
(@id_seccion, '3.2', 'DISPONIBILIDAD TINTAS', 'EA', 4, 1, 150000, 600000),
(@id_seccion, '3.3', 'RX', 'EA', 15, 1, 50000, 750000),
(@id_seccion, '3.4', 'DISPONIBILIDAD LIQUIDOS NIVEL 2', 'EA', 3, 1, 500000, 1500000),
(@id_seccion, '3.5', 'ALIVIO TERMICO', 'EA', 2, 1, 3500000, 7000000),
(@id_seccion, '3.6', 'ALQUILER PLANTA ELECTRICA', 'DIA', 2, 1, 600000, 1200000),
(@id_seccion, '3.7', 'ACPM PLANTA ELECTRICA', 'GALON', 30, 2, 20000, 1200000);

-- Actualizar subtotal de PRUEBAS NO DESTRUCTIVAS
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '4.1', 'SOLDDAURA', 'KG', 20, 1, 20000, 400000),
(@id_seccion, '4.2', 'DISCOS', 'EA', 15, 1, 20000, 300000),
(@id_seccion, '4.3', 'KIT LIQUIDOS', 'EA', 2, 1, 500000, 1000000),
(@id_seccion, '4.4', 'CO2 ,ARTGON', 'EA', 4, 1, 250000, 1000000),
(@id_seccion, '4.5', 'EXPANDER Y REPUESTOS', 'EA', 1, 1, 1500000, 1500000);

-- Actualizar subtotal de CONSUMIBLES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '5.1', 'TRAQSNPORTE MELGAR', 'EA', 1, 1, 3000000, 3000000),
(@id_seccion, '5.2', 'TRANSPRTE PLANTAELCTRICA', 'EA', 2, 1, 250000, 500000);

-- Actualizar subtotal de TRANSPORTE
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '6.1', 'CORTE DE CABEZALES', 'HR', 8, 4, 60000, 1920000),
(@id_seccion, '6.2', 'BISELAR CABEZALES CNC', 'HR', 16, 8, 60000, 7680000),
(@id_seccion, '6.3', 'SOLDAURA CABEZALES', 'PUL', 158, 2, 25000, 7900000),
(@id_seccion, '6.4', 'SOLDAR DIVISIONES  PASOS', 'PUL', 8.5, 8, 60000, 4080000),
(@id_seccion, '6.23', 'FABRICACION E INSTALACION DE BOQUILLAS 2" SCH 160', 'HR', 12, 4, 60000, 2880000),
(@id_seccion, '6.24', 'FABRICACION DE TAPONES', 'EA', 142, 1, 50000, 7100000),
(@id_seccion, '6.25', 'MONTAJE  Y PERFORAR CABEZALES', 'EA', 292, 1, 12000, 3504000),
(@id_seccion, '6.26', 'REALIZAR  ROSCAS 146', 'EA', 140, 1, 20000, 2800000),
(@id_seccion, '6.27', 'FABRICACION E INSTALACION COUPLING', 'HR', 4, 1, 60000, 240000),
(@id_seccion, '6.28', 'FABRICACION ARANDELAS', 'EA', 140, 1, 5000, 700000),
(@id_seccion, '6.29', 'FABRICACION ESTRUCTURA', 'HR', 8, 5, 60000, 2400000),
(@id_seccion, '6.3', 'ARMADO GENERAL', 'HR', 8, 2, 60000, 960000),
(@id_seccion, '6.31', 'INSTLACION TUBERIA Y EXPANDIR', 'EA', 73, 1, 20000, 1460000),
(@id_seccion, '6.32', 'MARCACION DE TAPONES', 'EA', 142, 1, 6000, 852000);

-- Actualizar subtotal de MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 6000, 48000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 1, 6000, 30000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 8, 2, 6000, 96000);

-- Actualizar subtotal de PRUEBA HIDROSTATICA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje) 
VALUES (@id_estudio_3, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal) VALUES
(@id_seccion, '8.1', 'SANDBLASTING TCF', 'M2', 15, 1, 60000, 900000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 15, 1, 60000, 900000);

-- Actualizar subtotal de PINTURA MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Actualizar porcentajes en todas las secciones para todos los estudios
UPDATE secciones s
JOIN estudios_factibilidad e ON s.id_estudio = e.id_estudio
SET s.porcentaje = (s.subtotal / (
    SELECT SUM(subtotal) 
    FROM secciones 
    WHERE id_estudio = e.id_estudio 
    AND nombre NOT IN ('TOTAL COSTOS DIRECTOS', 'AIU', 'COSTO + AIU')
)) * 100;


-- Script para importar datos de estudios de factibilidad desde Excel
-- Cada bloque corresponde a una hoja diferente del archivo Excel

-- --------------------------------------------------------
-- Hoja: E-4105 HAZ TCF BACKING
-- --------------------------------------------------------

-- Insertar estudio principal
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    'E-4105', 'ECOPETROL', '2024-04-09', 
    'FABRICACION HAZ DE TUBOS , TCF Y BACKING RING E-4105A', 
    NULL, '29 X 288"', 'AJS', NULL, 2, NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '1.1', 'CABEZAL FIJO  775 X 40 SA 266 GR 70', 'EA', 1, 1, 3450000, 3450000),
(@id_seccion, '1.2', 'CABEZAL FLOTANTE 736 X 40 SA 266 GR 2', 'EA', 1, 1, 3250000, 3250000),
(@id_seccion, '1.3', 'TUBERIA 3/4" BWG 16 X 24 FT SA 179', 'EA', 505, 1, 63000, 31815000),
(@id_seccion, '1.4', 'TUBERIA 3/4" BWG 16 X 24 FT SA 179 SEPARADORTES', 'EA', 6, 1, 63000, 378000),
(@id_seccion, '1.5', 'BAFLES 748 X 16 A 36', 'KG', 58, 1, 7500, 435000),
(@id_seccion, '1.6', 'BAFLES 748 X 8 mm  A 36', 'KG', 32, 16, 7500, 240000),
(@id_seccion, '1.7', 'VARILLAS TENSORAS AC', 'UND.', 6, 1, 150000, 900000),
(@id_seccion, '1.8', 'PALTINAS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.9', 'TCF ID 29" SA  516 GR 70', 'EA', 1, 1, 2000000, 2000000),
(@id_seccion, '1.10', 'LAMINA CAP', 'KG', 130, 1, 8500, 1105000),
(@id_seccion, '1.11', 'FORJA  TCF  815 X 684 X 84 SA 266 GR 2', 'EA', 1, 1, 2300000, 2300000),
(@id_seccion, '1.12', 'FORJA  BACKING  815 X 684 X 102 SA 266 GR 2', 'EA', 1, 1, 2750000, 2750000),
(@id_seccion, '1.13', 'EMPAQUES ACERO AL CARBON', 'EA', 5, 2, 1250000, 6250000),
(@id_seccion, '1.14', 'ESPARRAGOS TUERCAS', 'KIT', 1, 1, 3500000, 3500000),
(@id_seccion, '1.15', 'ANODOS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.16', 'PINTURA TCF', 'EA', 1, 1, 1000000, 1000000),
(@id_seccion, '1.17', 'DISCOS PRUEBA HIDROSTATICA', 'KG', 260, 4, 7500, 1950000),
(@id_seccion, '1.18', 'ANILLOS PRUEBA', 'KG', 80, NULL, 7500, 600000);

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 3, 1, 9500000, 28500000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 3, 1, 8500000, 25500000);

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'EA', 2, 1, 50000, 100000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 1, 1, 200000, 200000),
(@id_seccion, '3.3', 'ALIVIO TERMICO TCF', 'EA', 1, 1, 2500000, 2500000);

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '4.1', 'EXPANDER', 'EA', 1, 1, 1800000, 1800000),
(@id_seccion, '4.2', 'BROCA', 'EA', 1, 1, 250000, 250000),
(@id_seccion, '4.3', 'RIMA', 'EA', 1, 1, 500000, 500000),
(@id_seccion, '4.4', 'SOLDADURA', 'KG', 5, 1, 18000, 90000),
(@id_seccion, '4.5', 'DISCOS PULIDORAS', 'EA', 10, 1, 18000, 180000),
(@id_seccion, '4.6', 'LIQUIDOS PENETRANTES', 'KIT', 1, 1, 500000, 500000);

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '5.1', 'TRASNPORTE ALIVIO', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '5.2', 'TRANASPORTE REFINERIA ECP BCA', 'EA', 1, NULL, 1000000, 1000000);

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '6.1', 'MECANIZAR TORNO CABEZALES,FORJAS', 'HR', 24, 4, 70000, 6720000),
(@id_seccion, '6.2', 'PERFORA BRIDAS TCF BACKING', 'HR', 12, 2, 80000, 1920000),
(@id_seccion, '6.3', 'PROGRAMA Y MONTAJE CNC CABEZALES', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.4', 'CENTRO PUNTEAR  CABEZALES 505', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.5', 'PERFORAR CABEZALES', 'HR', 42, 2, 80000, 6720000),
(@id_seccion, '6.6', 'RIMAR CABEZALES', 'HR', 50, 2, 80000, 8000000),
(@id_seccion, '6.7', 'ACAMPANAR CABEZALES', 'HR', 3, 2, 70000, 420000),
(@id_seccion, '6.8', 'RANURAS DE SELLO CABEZALES', 'HR', 6, 2, 80000, 960000),
(@id_seccion, '6.9', 'RANURAS EXPANSION', 'HR', 9, 2, 70000, 1260000),
(@id_seccion, '6.10', 'ROSCAS TENSORAS', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.11', 'CORTE DE BAFLES Y SOLDAR PAQUETE', 'HR', 8, 2, 70000, 1120000),
(@id_seccion, '6.13', 'MONTAJE  CENTRO PUNTEAR BAFLES', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.14', 'PERFORAR  PAQUETE BAFLES', 'HR', 25, 2, 80000, 4000000),
(@id_seccion, '6.15', 'MECANIZAR PAQUETE BAFLES', 'HR', 24, 2, 70000, 3360000),
(@id_seccion, '6.16', 'ACAMPANAR BAFLES', 'HR', 2, 17, 70000, 2380000),
(@id_seccion, '6.17', 'SEGMENTAR BAFLES', 'HR', 1, 17, 70000, 1190000),
(@id_seccion, '6.18', 'CORTE SEPARADORES', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.19', 'ARMAR ESQUELETO', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.2', 'MONTAJE CABEZAL FIJO', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.21', 'ENTUBAR 550 TUBOS', 'HR', 16, 1, 70000, 1120000),
(@id_seccion, '6.22', 'MONTAJE CABEZAL FLOTANTE', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.23', 'REGRESAR TUBERIA', 'HR', 10, 1, 70000, 700000),
(@id_seccion, '6.24', 'EXPANDIR', 'EA', 550, 1, 15000, 8250000),
(@id_seccion, '6.25', 'MECANIZAR Y PERFORAR  ANILLOS DE PRUEBA HIDROSTATICA', 'HR', 12, 4, 70000, 3360000),
(@id_seccion, '6.26', 'INSTALAR PLATINAS DE SELLO E IMPACTO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.27', 'SOLDAR CAP', 'PUL', 29, 1, 70000, 2030000);

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 2, 70000, 700000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, 2, 70000, 2240000);

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '8.1', 'SANDBLASTING TCF', 'M2', 5, 1, 60000, 300000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 5, 3, 60000, 900000);

-- --------------------------------------------------------
-- Hoja: CAP D-18
-- --------------------------------------------------------

-- Insertar estudio principal
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    'CAP D-18', 'ECOPETROLL CARTAGENA', '2024-04-09', 
    'FABRICACION HAZ DE TUBOS E-3203', 
    NULL, 'OD 645" X 16 FT', 'AJS', NULL, 2, NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '1.1', 'LAMINA 1"', 'KG', 1800, 1, 9000, 16200000),
(@id_seccion, '1.2', 'FABRICAR CAP', 'EA', 1, 1, 8500000, 8500000),
(@id_seccion, '1.3', 'TUBERIA 3/4" BWG 14 X 16 FT SA LOW FINE  SA 334-6N', 'EA', 3132, NULL, 69000, 216108000),
(@id_seccion, '1.4', 'TUBERIA 3/4" BWG 14X 24 FT SA 179 SEPARADORTES', 'EA', 16, NULL, 69000, 1104000),
(@id_seccion, '1.5', 'BAFLES 1550X 13 A sa 2836', 'kg', 245, NULL, 6000, 1470000),
(@id_seccion, '1.6', 'BAFLES 1550 X 20 mm  sa 283', 'KG', 400, NULL, 6000, 2400000),
(@id_seccion, '1.7', 'VARILLAS TENSORAS AC', 'UND.', 12, NULL, 195000, 2340000),
(@id_seccion, '1.8', 'PALTINAS', 'EA', 6, NULL, 350000, 2100000),
(@id_seccion, '1.9', 'TCF ID 26,5" SA  516 GR 70', 'EA', 1, NULL, 2500000, 2500000),
(@id_seccion, '1.10', 'LAMINA CAP', 'KG', 100, NULL, 8500, 850000),
(@id_seccion, '1.11', 'FORJA  TCF  780 X 658 X 82 SA 266 GR 2', 'EA', 1, NULL, 2400000, 2400000),
(@id_seccion, '1.12', 'FORJA  BACKING  780 X 658 X 102 SA 266 GR 2', 'EA', 1, NULL, 2750000, 2750000),
(@id_seccion, '1.13', 'EMPAQUES ACERO AL CARBON', 'EA', 5, NULL, 1350000, 6750000),
(@id_seccion, '1.14', 'ESPARRAGOS TUERCAS', 'KIT', 1, NULL, 3500000, 3500000),
(@id_seccion, '1.15', 'ANODOS', 'EA', 2, NULL, 250000, 500000),
(@id_seccion, '1.16', 'PINTURA TCF', 'EA', 1, NULL, 1000000, 1000000),
(@id_seccion, '1.17', 'DISCOS PRUEBA HIDROSTATICA', 'KG', 2100, NULL, 7500, 15750000),
(@id_seccion, '1.18', 'ANILLOS PRUEBA', 'KG', 95, NULL, 7500, 712500);

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 1, 1, 8500000, 8500000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 2, 1, 9000000, 18000000),
(@id_seccion, '2.3', 'PLANOS HAZ', 'EA', 1, 1, 250000, 250000);

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'EA', 2, 1, 50000, 100000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 1, 1, 200000, 200000),
(@id_seccion, '3.3', 'ALIVIO TERMICO TCF', 'EA', 1, NULL, 2500000, 2500000);

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '4.1', 'BROCAS', 'EA', 3, 1, 350000, 1050000),
(@id_seccion, '4.2', 'RIMAS', 'EA', 3, 1, 450000, 1350000),
(@id_seccion, '4.3', 'EXPANDER', 'EA', 3, 1, 1500000, 4500000),
(@id_seccion, '4.4', 'SOLDADURA', 'KG', 5, NULL, 18000, 90000),
(@id_seccion, '4.5', 'DISCOS PULIDORAS', 'EA', 10, NULL, 18000, 180000),
(@id_seccion, '4.6', 'LIQUIDOS PENETRANTES', 'KIT', 1, NULL, 500000, 500000);

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '5.1', 'TRASNPORTE CARTAGENA', 'EA', 1, 1, 5000000, 5000000),
(@id_seccion, '5.2', 'TRANASPORTE REFINERIA ECP BCA', 'EA', NULL, NULL, 1000000, 0);

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '6.1', 'PRECALENTAR', 'HR', NULL, 4, 70000, 0),
(@id_seccion, '6.2', 'APLICAR SOLDAURA', 'INCH', 148, 1, 35000, 5180000),
(@id_seccion, '6.3', 'MECANIZADO TORNO', 'HR', 24, 1, 80000, 1920000),
(@id_seccion, '6.4', 'CENTRO PUNTEAR  CABEZALES', 'HR', 7, NULL, 80000, 560000),
(@id_seccion, '6.5', 'PERFORAR CABEZALES', 'HR', 38, NULL, 80000, 3040000),
(@id_seccion, '6.6', 'RIMAR CABEZALES', 'HR', 45, NULL, 80000, 3600000),
(@id_seccion, '6.7', 'ACAMPANAR CABEZALES', 'HR', 3, NULL, 70000, 210000),
(@id_seccion, '6.8', 'RANURAS DE SELLO CABEZALES', 'HR', 6, NULL, 80000, 480000),
(@id_seccion, '6.9', 'RANURAS EXPANSION', 'HR', 9, NULL, 70000, 630000),
(@id_seccion, '6.10', 'ROSCAS TENSORAS', 'HR', 5, NULL, 70000, 350000),
(@id_seccion, '6.11', 'CORTE DE BAFLES Y SOLDAR PAQUETE', 'HR', 12, NULL, 70000, 840000),
(@id_seccion, '6.13', 'MONTAJE  CENTRO PUNTEAR BAFLES', 'HR', 8, NULL, 80000, 640000),
(@id_seccion, '6.14', 'PERFORAR  PAQUETE BAFLES', 'HR', 30, NULL, 80000, 2400000),
(@id_seccion, '6.15', 'MECANIZAR PAQUETE BAFLES', 'HR', 30, NULL, 70000, 2100000),
(@id_seccion, '6.16', 'ACAMPANAR BAFLES', 'HR', 2, NULL, 70000, 140000),
(@id_seccion, '6.17', 'SEGMENTAR BAFLES', 'HR', 1, NULL, 70000, 70000),
(@id_seccion, '6.18', 'CORTE SEPARADORES', 'HR', 8, NULL, 70000, 560000),
(@id_seccion, '6.19', 'ARMAR ESQUELETO', 'HR', 5, NULL, 70000, 350000),
(@id_seccion, '6.2', 'MONTAJE CABEZAL FIJO', 'HR', 2, NULL, 70000, 140000),
(@id_seccion, '6.21', 'ENTUBAR 390 TUBOS', 'HR', 12, NULL, 70000, 840000),
(@id_seccion, '6.22', 'MONTAJE CABEZAL FLOTANTE', 'HR', 2, NULL, 70000, 140000),
(@id_seccion, '6.23', 'REGRESAR TUBERIA', 'HR', 10, NULL, 70000, 700000),
(@id_seccion, '6.24', 'EXPANDIR', 'EA', 424, NULL, 15000, 6360000),
(@id_seccion, '6.25', 'MECANIZAR Y PERFORAR  ANILLOS DE PRUEBA HIDROSTATICA', 'HR', 12, NULL, 70000, 840000),
(@id_seccion, '6.26', 'INSTALAR PLATINAS DE SELLO E IMPACTO', 'HR', 8, NULL, 70000, 560000),
(@id_seccion, '6.27', 'SOLDAR CAP', 'PUL', 27, NULL, 70000, 1890000);

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, NULL, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, NULL, 70000, 350000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, NULL, 70000, 1120000);

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '8.1', 'SANDBLASTING TCF', 'M2', 5, NULL, 60000, 300000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 5, NULL, 60000, 300000);

-- --------------------------------------------------------
-- Hoja: E-4116A HAZ TCF BACKING
-- --------------------------------------------------------

-- Insertar estudio principal
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    'E-4116A', 'ECOPETROL', '2024-04-09', 
    'FABRICACION HAZ DE TUBOS ,  BACKING RING E-4116A', 
    NULL, '29 X 288"', 'AJS', NULL, 2, NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '1.1', 'CABEZAL FIJO  648 X 76  SA 516 GR 70 + 10 MIN  CLAD SB 171 C 46400', 'KG', 200, 1, 140000, 28000000),
(@id_seccion, '1.2', 'CABEZAL FIJO  574 X 76  SA 516 GR 70 + 10 MIN  CLAD SB 171 C 46400', 'EA', 170, 1, 140000, 23800000),
(@id_seccion, '1.3', 'TUBERIA 3/4" BWG 14 X 24 FT SB  171 C 46400', 'EA', 272, 1, 572000, 155584000),
(@id_seccion, '1.4', 'TUBERIA 3/4" BWG 14 X 24 FT SB  171 C 46400', 'EA', 6, 1, 572000, 3432000),
(@id_seccion, '1.5', 'BAFLES 584 X 13 A 36 SA 516 GR 70', 'KG', 33, 1, 7500, 247500),
(@id_seccion, '1.6', 'BAFLES 584 X 7 mm  A 36 SA 516 GR 70', 'KG', 20, 13, 7500, 150000),
(@id_seccion, '1.7', 'VARILLAS TENSORAS AC', 'UND.', 6, 1, 650000, 3900000),
(@id_seccion, '1.8', 'PALTINAS', 'EA', 2, 1, 2150000, 4300000),
(@id_seccion, '1.9', 'TCF ID 23" SA  516 GR 70', 'EA', 1, 1, 2300000, 2300000),
(@id_seccion, '1.10', 'LAMINA CAP', 'KG', 70, 1, 8500, 595000),
(@id_seccion, '1.11', 'FORJA  TCF  650 X 540 X 78 SA 266 GR 2', 'EA', 1, 1, 2150000, 2150000),
(@id_seccion, '1.12', 'FORJA  BACKING  650 X 540 X 96 SA 266 GR 2', 'EA', 1, 1, 2550000, 2550000),
(@id_seccion, '1.13', 'EMPAQUES ACERO AL CARBON', 'EA', 5, 2, 1350000, 6750000),
(@id_seccion, '1.14', 'ESPARRAGOS TUERCAS', 'KIT', 1, 1, 3500000, 3500000),
(@id_seccion, '1.15', 'ANODOS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.16', 'PINTURA TCF', 'EA', 1, 1, 1000000, 1000000),
(@id_seccion, '1.17', 'DISCOS PRUEBA HIDROSTATICA', 'KG', 230, 4, 7500, 1725000),
(@id_seccion, '1.18', 'ANILLOS PRUEBA', 'KG', NULL, 2, 7500, 0);

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 2, 1, 8500000, 17000000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 3, 1, 8500000, 25500000),
(@id_seccion, '2.3', 'PLANOSA HAZ', 'EA', 4, 1, 250000, 1000000);

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'EA', 2, 1, 50000, 100000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 1, 1, 200000, 200000),
(@id_seccion, '3.3', 'ALIVIO TERMICO TCF', 'EA', 1, 1, 2500000, 2500000);

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '4.1', 'EXPANDER', 'EA', 1, 1, 1800000, 1800000),
(@id_seccion, '4.2', 'BROCA', 'EA', 1, 1, 250000, 250000),
(@id_seccion, '4.3', 'RIMA', 'EA', 1, 1, 500000, 500000),
(@id_seccion, '4.4', 'SOLDADURA', 'KG', 5, 1, 18000, 90000),
(@id_seccion, '4.5', 'DISCOS PULIDORAS', 'EA', 10, 1, 18000, 180000),
(@id_seccion, '4.6', 'LIQUIDOS PENETRANTES', 'KIT', 1, 1, 500000, 500000);

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '5.1', 'TRASNPORTE ALIVIO', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '5.2', 'TRANASPORTE REFINERIA ECP BCA', 'EA', 1, 1, 1000000, 1000000);

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '6.1', 'MECANIZAR TORNO CABEZALES,FORJAS', 'HR', 24, 4, 70000, 6720000),
(@id_seccion, '6.2', 'PERFORA BRIDAS TCF BACKING', 'HR', 12, 2, 80000, 1920000),
(@id_seccion, '6.3', 'PROGRAMA Y MONTAJE CNC CABEZALES', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.4', 'CENTRO PUNTEAR  CABEZALES', 'HR', 7, 2, 80000, 1120000),
(@id_seccion, '6.5', 'PERFORAR CABEZALES', 'HR', 38, 2, 80000, 6080000),
(@id_seccion, '6.6', 'RIMAR CABEZALES', 'HR', 45, 2, 80000, 7200000),
(@id_seccion, '6.7', 'ACAMPANAR CABEZALES', 'HR', 3, 2, 70000, 420000),
(@id_seccion, '6.8', 'RANURAS DE SELLO CABEZALES', 'HR', 6, 2, 80000, 960000),
(@id_seccion, '6.9', 'RANURAS EXPANSION', 'HR', 9, 2, 70000, 1260000),
(@id_seccion, '6.10', 'ROSCAS TENSORAS', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.11', 'CORTE DE BAFLES Y SOLDAR PAQUETE', 'HR', 12, 2, 70000, 1680000),
(@id_seccion, '6.13', 'MONTAJE  CENTRO PUNTEAR BAFLES', 'HR', 8, 1, 80000, 640000),
(@id_seccion, '6.14', 'PERFORAR  PAQUETE BAFLES', 'HR', 30, 1, 80000, 2400000),
(@id_seccion, '6.15', 'MECANIZAR PAQUETE BAFLES', 'HR', 30, 1, 70000, 2100000),
(@id_seccion, '6.16', 'ACAMPANAR BAFLES', 'HR', 2, 15, 70000, 2100000),
(@id_seccion, '6.17', 'SEGMENTAR BAFLES', 'HR', 1, 15, 70000, 1050000),
(@id_seccion, '6.18', 'CORTE SEPARADORES', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.19', 'ARMAR ESQUELETO', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.2', 'MONTAJE CABEZAL FIJO', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.21', 'ENTUBAR 390 TUBOS', 'HR', 12, 1, 70000, 840000),
(@id_seccion, '6.22', 'MONTAJE CABEZAL FLOTANTE', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.23', 'REGRESAR TUBERIA', 'HR', 10, 1, 70000, 700000),
(@id_seccion, '6.24', 'EXPANDIR', 'EA', 424, 1, 15000, 6360000),
(@id_seccion, '6.25', 'MECANIZAR Y PERFORAR  ANILLOS DE PRUEBA HIDROSTATICA', 'HR', 12, 4, 70000, 3360000),
(@id_seccion, '6.26', 'INSTALAR PLATINAS DE SELLO E IMPACTO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.27', 'SOLDAR CAP', 'PUL', 27, 1, 70000, 1890000);

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 2, 70000, 700000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, 2, 70000, 2240000);

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '8.1', 'SANDBLASTING TCF', 'M2', 5, 1, 60000, 300000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 5, 3, 60000, 900000);

-- --------------------------------------------------------
-- Hoja: E-4169 COMPLETO AJS
-- --------------------------------------------------------

-- Insertar estudio principal
INSERT INTO estudios_factibilidad (
    codigo_estudio, cliente, fecha_estudio, alcance, cotizacion, 
    dimensiones, tipo, cod_fabricacion, cantidad, doc_referencia
) VALUES (
    'E-4169', 'ECOPETROL', '2024-04-09', 
    'FABRICACION INTERCAMBIADOR COMPLETO  E-4169', 
    NULL, '12 X 240"', 'AJS', NULL, 1, NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '1. MATERIALES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MATERIALES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '1.1', 'CABEZAL FIJO  384 X 50  SA 182 UNS 31803', 'KG', 1, 1, 7250000, 7250000),
(@id_seccion, '1.2', 'CABEZAL FIJO  315 X 50  SA 182 UNS 31803', 'EA', 1, 1, 5250000, 5250000),
(@id_seccion, '1.3', 'TUBERIA 3/4" BWG 16 X 20 FT  SA 789 UNS 31803', 'EA', 64, 1, 350000, 22400000),
(@id_seccion, '1.4', 'TUBERIA 3/4" BWG 14 X 24 FT SB  171 C 46400', 'EA', 6, 1, 350000, 2100000),
(@id_seccion, '1.5', 'BAFLES 310 X 10 SA 240 TP 304', 'KG', 5, 9, 16000, 80000),
(@id_seccion, '1.6', 'BAFLES 10 X 16 mm  SA 240 TP 304', 'KG', 15, 1, 16000, 240000),
(@id_seccion, '1.7', 'VARILLAS TENSORAS AC', 'UND.', 6, 1, 650000, 3900000),
(@id_seccion, '1.8', 'PALTINAS', 'EA', 2, 1, 2150000, 4300000),
(@id_seccion, '1.9', 'TCF ID 13" SA  516 GR 70', 'EA', 1, 1, 2300000, 2300000),
(@id_seccion, '1.10', 'LAMINA TCF  SA 240 TP 31803', 'KG', 40, 1, 50000, 2000000),
(@id_seccion, '1.11', 'FORJA  TCF  320 X 240 X 76  SA 182 F 31803', 'EA', 1, 1, 3950000, 3950000),
(@id_seccion, '1.12', 'FORJA  BACKING  320 X 240 X  85 SA 182 F 31803', 'EA', 1, 1, 4650000, 4650000),
(@id_seccion, '1.13', 'EMPAQUES ACERO INOX', 'EA', 5, 2, 1850000, 9250000),
(@id_seccion, '1.14', 'ESPARRAGOS TUERCAS', 'KIT', 1, 1, 3500000, 3500000),
(@id_seccion, '1.15', 'ANODOS CANAL', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.16', 'PINTURA EQUIPO  COMPLETO', 'M2', 12, 2, 150000, 1800000),
(@id_seccion, '1.17', 'DISCOS PRUEBA HIDROSTATICA', 'KG', NULL, 4, 7500, 0),
(@id_seccion, '1.18', 'ANILLOS PRUEBA', 'KG', NULL, 2, 7500, 0),
(@id_seccion, '1.19', 'LAMINA CASCO 1100 X 6000 X 10 SA 516 GR 70', 'KG', 550, 1, 8500, 4675000),
(@id_seccion, '1.20', 'LAMINA CANAL  1100 X 600 X 10 SA 516 GR 70', 'KG', 60, 1, 8500, 510000),
(@id_seccion, '1.21', 'LAMINA PLATINA DIVISORIA 320 X 600 X 13 SA 516 GR 70', 'KG', 30, 1, 8500, 255000),
(@id_seccion, '1.22', 'LAMINA SILLETAS', 'KG', 180, 1, 8500, 1530000),
(@id_seccion, '1.23', 'LAMINA RUANAS', 'KG', 24, 4, 8500, 204000),
(@id_seccion, '1.24', 'LAMINA TAPACASCO 16"', 'KG', 20, 1, 8500, 170000),
(@id_seccion, '1.25', 'FORJA TAPA CASCO 530 X 370 X 90 SA 266 GR 2', 'EA', 1, 1, 3150000, 3150000),
(@id_seccion, '1.26', 'FORJA CASCO 449 X 300 X 86 SA 266 GR 2', 'EA', 1, 1, 2650000, 2650000),
(@id_seccion, '1.27', 'FORJA CASCO 530 X 300 X 90 SA 266 GR 2', 'EA', 1, 1, 3200000, 3200000),
(@id_seccion, '1.28', 'FORJA CANAL 449 X 300 X 86 SA 266 GR 2', 'EA', 1, 1, 2650000, 2650000),
(@id_seccion, '1.29', 'FORJA CANAL 530X 300 X 90 SA 266 GR 2', 'EA', 1, 1, 3200000, 3200000),
(@id_seccion, '1.30', 'TAPA CANAL 449 X 50 SA 266 GR 2', 'EA', 1, 1, 1850000, 1850000),
(@id_seccion, '1.31', 'BRIDA 6 X 150', 'EA', 4, 1, 750000, 3000000),
(@id_seccion, '1.32', 'TUBO DE 6 SCH 80', 'MT', 2, 1, 1950000, 3900000),
(@id_seccion, '1.33', 'CAP DE 16"', 'EA', 1, 1, 2150000, 2150000);

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '2. INGENIERIA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de INGENIERIA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 3, 1, 8500000, 25500000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 3, 1, 8500000, 25500000),
(@id_seccion, '2.3', 'PLANOS HAZ', 'EA', 4, 1, 250000, 1000000),
(@id_seccion, '2.4', 'PLANO CASCO', 'EA', 4, 1, 250000, 1000000);

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '3. PRUEBAS NO DESTRUCTIVAS', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'EA', 20, 1, 50000, 1000000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 7, 1, 200000, 1400000),
(@id_seccion, '3.3', 'ALIVIO TERMICO TCF', 'EA', 1, 1, 2500000, 2500000),
(@id_seccion, '3.4', 'RADIAGRAFIAS', 'EA', 60, 1, 50000, 3000000),
(@id_seccion, '3.5', 'DISPONIBILIDA  RX', 'EA', 8, 1, 500000, 4000000);

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '4. CONSUMIBLES', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de CONSUMIBLES
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '4.1', 'EXPANDER', 'EA', 1, 1, 1800000, 1800000),
(@id_seccion, '4.2', 'BROCA', 'EA', 1, 1, 250000, 250000),
(@id_seccion, '4.3', 'RIMA', 'EA', 1, 1, 500000, 500000),
(@id_seccion, '4.4', 'SOLDADURA', 'KG', 30, 1, 18000, 540000),
(@id_seccion, '4.5', 'DISCOS PULIDORAS', 'EA', 40, 1, 18000, 720000),
(@id_seccion, '4.6', 'LIQUIDOS PENETRANTES', 'KIT', 2, 1, 500000, 1000000);

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '5. TRANSPORTE', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de TRANSPORTE
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '5.1', 'TRASNPORTE ALIVIO', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '5.2', 'TRANSPORTE  Y CMAION GRUA PINTURA', 'EA', 2, 1, 1000000, 2000000),
(@id_seccion, '5.3', 'TRANASPORTE REFINERIA ECP BCA', 'EA', 1, 1, 1000000, 1000000);

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '6. MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '6.1', 'MECANIZAR TORNO CABEZALES,FORJAS CASCO ,CANAL, TCF, T CASCO', 'HR', 20, 9, 70000, 12600000),
(@id_seccion, '6.2', 'PERFORA BRIDAS TCF BACKING,CASCO,TCF,CANAL', 'HR', 12, 7, 80000, 6720000),
(@id_seccion, '6.3', 'PROGRAMA Y MONTAJE CNC CABEZALES', 'HR', 6, 2, 80000, 960000),
(@id_seccion, '6.4', 'CENTRO PUNTEAR  CABEZALES', 'HR', 2, 2, 80000, 320000),
(@id_seccion, '6.5', 'PERFORAR CABEZALES', 'HR', 7, 2, 80000, 1120000),
(@id_seccion, '6.6', 'RIMAR CABEZALES', 'HR', 8, 2, 80000, 1280000),
(@id_seccion, '6.7', 'ACAMPANAR CABEZALES', 'HR', 3, 2, 70000, 420000),
(@id_seccion, '6.8', 'RANURAS DE SELLO CABEZALES', 'HR', 4, 2, 80000, 640000),
(@id_seccion, '6.9', 'RANURAS EXPANSION', 'HR', 5, 2, 70000, 700000),
(@id_seccion, '6.10', 'ROSCAS TENSORAS', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.11', 'CORTE DE BAFLES Y SOLDAR PAQUETE', 'HR', 10, 1, 70000, 700000),
(@id_seccion, '6.12', 'MONTAJE  CENTRO PUNTEAR BAFLES', 'HR', 5, 1, 80000, 400000),
(@id_seccion, '6.13', 'PERFORAR  PAQUETE BAFLES', 'HR', 10, 1, 80000, 800000),
(@id_seccion, '6.14', 'MECANIZAR PAQUETE BAFLES', 'HR', 24, 1, 70000, 1680000),
(@id_seccion, '6.15', 'ACAMPANAR BAFLES', 'HR', 2, 10, 70000, 1400000),
(@id_seccion, '6.16', 'SEGMENTAR BAFLES', 'HR', 1, 10, 70000, 700000),
(@id_seccion, '6.17', 'CORTE SEPARADORES', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.18', 'ARMAR ESQUELETO', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.19', 'MONTAJE CABEZAL FIJO', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.20', 'ENTUBAR 62 TUBOS', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.21', 'MONTAJE CABEZAL FLOTANTE', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.22', 'REGRESAR TUBERIA', 'HR', 10, 1, 70000, 700000),
(@id_seccion, '6.23', 'EXPANDIR', 'EA', 62, 1, 15000, 930000),
(@id_seccion, '6.24', 'MECANIZAR Y PERFORAR  ANILLOS DE PRUEBA HIDROSTATICA', 'HR', 12, 4, 70000, 3360000),
(@id_seccion, '6.25', 'INSTALAR PLATINAS DE SELLO E IMPACTO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.26', 'SOLDAR CAP TCF', 'PUL', 16, 1, 70000, 1120000),
(@id_seccion, '6.27', 'SOLDAR CAP CASCO', 'PUL', 16, 1, 70000, 1120000),
(@id_seccion, '6.28', 'SOLDAR BRIDAS CASCO CANAL', 'PUL', 13, 4, 70000, 3640000),
(@id_seccion, '6.29', 'SOLDAR VIROLAS CASCO', 'PUL', 13, 2, 70000, 1820000),
(@id_seccion, '6.30', 'SOLDAR LONGITUD CASCO', 'PUL', 240, 1, 10000, 2400000),
(@id_seccion, '6.31', 'FABRICAR E INSTRALAR SILLETAS', 'HR', 12, 2, 70000, 1680000),
(@id_seccion, '6.32', 'FABRICAR E INSTRALAR BOQUILLAS', 'PUL', 6, 8, 70000, 3360000),
(@id_seccion, '6.33', 'INSTALAR PLATINA DIVISORIA CANAL', 'HR', 10, 2, 70000, 1400000);

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '7. PRUEBA HIDROSTATICA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PRUEBA HIDROSTATICA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 2, 70000, 700000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, 2, 70000, 2240000);

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (id_estudio, nombre, subtotal, porcentaje)
VALUES (@id_estudio, '8. PINTURA MANO DE OBRA', NULL, NULL);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar ítems de PINTURA MANO DE OBRA
INSERT INTO items (id_seccion, codigo_item, descripcion, unidad, cantidad, no_piezas, tarifa, subtotal)
VALUES 
(@id_seccion, '8.1', 'SANDBLASTING', 'M2', 14, 2, 60000, 1680000),
(@id_seccion, '8.2', 'PINTURA', 'M2', 14, 2, 60000, 1680000);

-- ********************************************************************
-- Insertar datos del estudio de factibilidad para la hoja E-4176AB HAZ TCF BACKING
INSERT INTO estudios_factibilidad (
    codigo_estudio, 
    cliente, 
    fecha_estudio, 
    alcance, 
    cotizacion, 
    dimensiones, 
    tipo, 
    cod_fabricacion, 
    cantidad, 
    doc_referencia
) VALUES (
    'E-4176AB', 
    'ECOPETROL', 
    '2024-04-09', 
    'FABRICACION HAZ DE TUBOS , BACKING RING E-4176 AB', 
    NULL, 
    '27 x 240', 
    'AJS', 
    NULL, 
    2, 
    NULL
);

-- Obtener el ID del estudio recién insertado
SET @id_estudio = LAST_INSERT_ID();

-- Insertar sección 1. MATERIALES
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '1. MATERIALES', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 1. MATERIALES
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '1.1', 'CABEZAL FIJO  775 X 70  SA 516 GR 70 / SA 266 GR 2', 'EA', 1, 1, 5250000, 5250000),
(@id_seccion, '1.2', 'CABEZAL FIJO  710 X 70  SA 516 GR 70 / SA 266 GR 2', 'EA', 1, 1, 4650000, 4650000),
(@id_seccion, '1.3', 'TUBERIA 3/4" BWG 14 X 20FT  SA 179', 'EA', 424, 1, 58000, 24592000),
(@id_seccion, '1.4', 'TUBERIA 3/4" BWG 14 X 20FT  SA 179', 'EA', 6, 1, 58000, 348000),
(@id_seccion, '1.5', 'BAFLES 717 X 7  516 GR 70', 'KG', 24, 13, 8500, 204000),
(@id_seccion, '1.6', 'BAFLES 717 X 16 mm  A 36 SA 516 GR 70', 'KG', 55, 1, 8500, 467500),
(@id_seccion, '1.7', 'VARILLAS TENSORAS AC', 'UND.', 6, 1, 150000, 900000),
(@id_seccion, '1.8', 'PALTINAS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.9', 'TCF ID 26" SA  516 GR 70', 'EA', 1, 1, 2700000, 2700000),
(@id_seccion, '1.10', 'LAMINA CAP', 'KG', 90, 1, 8500, 765000),
(@id_seccion, '1.11', 'FORJA  TCF  776 X 650 X 79 SA 266 GR 2', 'EA', 1, 1, 2685000, 2685000),
(@id_seccion, '1.12', 'FORJA  BACKING  779 X 650 X 102 SA 266 GR 2', 'EA', 1, 1, 3150000, 3150000),
(@id_seccion, '1.13', 'EMPAQUES ACERO AL CARBON', 'EA', 5, 2, 1350000, 6750000),
(@id_seccion, '1.14', 'ESPARRAGOS TUERCAS', 'KIT', 1, 1, 3500000, 3500000),
(@id_seccion, '1.15', 'ANODOS', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '1.16', 'PINTURA TCF', 'EA', 1, 1, 1000000, 1000000),
(@id_seccion, '1.17', 'DISCOS PRUEBA HIDROSTATICA', 'KG', 280, 4, 7500, 2100000),
(@id_seccion, '1.18', 'ANILLOS PRUEBA', 'KG', NULL, 2, 7500, NULL);

-- Actualizar subtotal de la sección 1. MATERIALES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 2. INGENIERIA
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '2. INGENIERIA', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 2. INGENIERIA
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '2.1', 'CALCULOS MECANICOS,HIDRAULICOA Y TERMICOS', 'EA', 2, 1, 8500000, 17000000),
(@id_seccion, '2.2', 'INSSPECTOR ASME', 'EA', 3, 1, 8500000, 25500000),
(@id_seccion, '2.3', 'PLANOAS HAZ', 'EA', 4, 1, 250000, 1000000);

-- Actualizar subtotal de la sección 2. INGENIERIA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '3. PRUEBAS NO DESTRUCTIVAS', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 3. PRUEBAS NO DESTRUCTIVAS
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '3.1', 'LIQUIDOS PENETRANTE EN TCF', 'EA', 2, 1, 50000, 100000),
(@id_seccion, '3.2', 'DISPONIBILIDAD LIQUIDOS', 'EA', 1, 1, 200000, 200000),
(@id_seccion, '3.3', 'ALIVIO TERMICO TCF', 'EA', 1, 1, 2500000, 2500000);

-- Actualizar subtotal de la sección 3. PRUEBAS NO DESTRUCTIVAS
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 4. CONSUMIBLES
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '4. CONSUMIBLES', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 4. CONSUMIBLES
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '4.1', 'EXPANDER', 'EA', 1, 1, 1800000, 1800000),
(@id_seccion, '4.2', 'BROCA', 'EA', 1, 1, 250000, 250000),
(@id_seccion, '4.3', 'RIMA', 'EA', 1, 1, 500000, 500000),
(@id_seccion, '4.4', 'SOLDADURA', 'KG', 5, 1, 18000, 90000),
(@id_seccion, '4.5', 'DISCOS PULIDORAS', 'EA', 10, 1, 18000, 180000),
(@id_seccion, '4.6', 'LIQUIDOS PENETRANTES', 'KIT', 1, 1, 500000, 500000);

-- Actualizar subtotal de la sección 4. CONSUMIBLES
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 5. TRANSPORTE
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '5. TRANSPORTE', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 5. TRANSPORTE
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '5.1', 'TRASNPORTE ALIVIO', 'EA', 2, 1, 250000, 500000),
(@id_seccion, '5.2', 'TRANASPORTE REFINERIA ECP BCA', 'EA', 1, 1, 1000000, 1000000);

-- Actualizar subtotal de la sección 5. TRANSPORTE
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 6. MANO DE OBRA
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '6. MANO DE OBRA', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 6. MANO DE OBRA
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '6.1', 'MECANIZAR TORNO CABEZALES,FORJAS', 'HR', 24, 4, 70000, 1680000),
(@id_seccion, '6.2', 'PERFORA BRIDAS TCF BACKING', 'HR', 12, 2, 80000, 960000),
(@id_seccion, '6.3', 'PROGRAMA Y MONTAJE CNC CABEZALES', 'HR', 8, 2, 80000, 640000),
(@id_seccion, '6.4', 'CENTRO PUNTEAR  CABEZALES', 'HR', 7, 2, 80000, 560000),
(@id_seccion, '6.5', 'PERFORAR CABEZALES', 'HR', 35, 2, 80000, 2800000),
(@id_seccion, '6.6', 'RIMAR CABEZALES', 'HR', 45, 2, 80000, 3600000),
(@id_seccion, '6.7', 'ACAMPANAR CABEZALES', 'HR', 4, 2, 70000, 280000),
(@id_seccion, '6.8', 'RANURAS DE SELLO CABEZALES', 'HR', 6, 2, 80000, 480000),
(@id_seccion, '6.9', 'RANURAS EXPANSION', 'HR', 7, 2, 70000, 490000),
(@id_seccion, '6.10', 'ROSCAS TENSORAS', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.11', 'CORTE DE BAFLES Y SOLDAR PAQUETE', 'HR', 12, 1, 70000, 840000),
(@id_seccion, '6.13', 'MONTAJE  CENTRO PUNTEAR BAFLES', 'HR', 8, 1, 80000, 640000),
(@id_seccion, '6.14', 'PERFORAR  PAQUETE BAFLES', 'HR', 42, 1, 80000, 3360000),
(@id_seccion, '6.15', 'MECANIZAR PAQUETE BAFLES', 'HR', 24, 1, 70000, 1680000),
(@id_seccion, '6.16', 'ACAMPANAR BAFLES', 'HR', 2, 14, 70000, 140000),
(@id_seccion, '6.17', 'SEGMENTAR BAFLES', 'HR', 1, 14, 70000, 70000),
(@id_seccion, '6.18', 'CORTE SEPARADORES', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.19', 'ARMAR ESQUELETO', 'HR', 5, 1, 70000, 350000),
(@id_seccion, '6.20', 'MONTAJE CABEZAL FIJO', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.21', 'ENTUBAR 424 TUBOS', 'HR', 15, 1, 70000, 1050000),
(@id_seccion, '6.22', 'MONTAJE CABEZAL FLOTANTE', 'HR', 2, 1, 70000, 140000),
(@id_seccion, '6.23', 'REGRESAR TUBERIA', 'HR', 10, 1, 70000, 700000),
(@id_seccion, '6.24', 'EXPANDIR', 'EA', 424, 1, 15000, 6360000),
(@id_seccion, '6.25', 'MECANIZAR Y PERFORAR  ANILLOS DE PRUEBA HIDROSTATICA', 'HR', 12, 4, 70000, 840000),
(@id_seccion, '6.26', 'INSTALAR PLATINAS DE SELLO E IMPACTO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '6.27', 'SOLDAR CAP', 'PUL', 26, 1, 70000, 1820000);

-- Actualizar subtotal de la sección 6. MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 7. PRUEBA HIDROSTATICA
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '7. PRUEBA HIDROSTATICA', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 7. PRUEBA HIDROSTATICA
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '7.1', 'ARMAR EQUIPO', 'HR', 8, 1, 70000, 560000),
(@id_seccion, '7.2', 'LLENADO', 'HR', 5, 2, 70000, 350000),
(@id_seccion, '7.3', 'PRUEBA', 'HR', 16, 2, 70000, 1120000);

-- Actualizar subtotal de la sección 7. PRUEBA HIDROSTATICA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;

-- Insertar sección 8. PINTURA MANO DE OBRA
INSERT INTO secciones (
    id_estudio, 
    nombre, 
    subtotal, 
    porcentaje
) VALUES (
    @id_estudio, 
    '8. PINTURA MANO DE OBRA', 
    NULL, 
    NULL
);

SET @id_seccion = LAST_INSERT_ID();

-- Insertar items de la sección 8. PINTURA MANO DE OBRA
INSERT INTO items (
    id_seccion, 
    codigo_item, 
    descripcion, 
    unidad, 
    cantidad, 
    no_piezas, 
    tarifa, 
    subtotal
) VALUES 
(@id_seccion, '8.1', 'SANDBLASTING TCF', 'M2', 5, 1, 60000, 300000),
(@id_seccion, '8.2', 'PINTURA TCF', 'M2', 5, 3, 60000, 300000);

-- Actualizar subtotal de la sección 8. PINTURA MANO DE OBRA
UPDATE secciones SET subtotal = (
    SELECT SUM(subtotal) FROM items WHERE id_seccion = @id_seccion
) WHERE id_seccion = @id_seccion;