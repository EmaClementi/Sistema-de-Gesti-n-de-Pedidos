-- Creacion de tablas

CREATE TABLE detalle_pedido (
  "id" int PRIMARY KEY,
  "id_pedido" int NOT NULL,
  "id_plato" int NOT NULL,
  "cantidad" int
);

CREATE TABLE cliente (
  "id_cliente" int PRIMARY KEY,
  "nombre" varchar(50),
  "apellido" varchar(50),
  "direccion" varchar(50),
  "telefono" varchar(50)
);

CREATE TABLE plato (
  "id_plato" int PRIMARY KEY,
  "nombre" varchar(50),
  "descripcion" varchar(100),
  "precio" int
);

CREATE TABLE pedido (
  "id_pedido" int PRIMARY KEY,
  "id_cliente" int NOT NULL,
  "fecha" date,
  "forma_de_pago" varchar(50),
  "total" int,
  "estado" varchar(50)
);

-- Modificacion de Campos para que hagan referencia a otra tabla (CLAVES FORANEAS)

ALTER TABLE detalle_pedido ADD FOREIGN KEY ("id_pedido") REFERENCES pedido ("id_pedido") ON DELETE CASCADE;

ALTER TABLE detalle_pedido ADD FOREIGN KEY ("id_plato") REFERENCES plato ("id_plato") ON DELETE CASCADE;

ALTER TABLE pedido ADD FOREIGN KEY ("id_cliente") REFERENCES cliente ("id_cliente") ON DELETE CASCADE;

-- Sequencias

-- Se crean para que a medida que vamos guardando datos los id se vallan incrementando

CREATE SEQUENCE cliente_id_cliente_seq;
CREATE SEQUENCE plato_id_plato_seq;
CREATE SEQUENCE pedido_id_pedido_seq;
CREATE SEQUENCE detalle_pedido_seq;


ALTER TABLE cliente
ALTER COLUMN id_cliente SET DEFAULT nextval('cliente_id_cliente_seq');

ALTER TABLE pedido
ALTER COLUMN id_pedido SET DEFAULT nextval('pedido_id_pedido_seq');

ALTER TABLE plato
ALTER COLUMN id_plato SET DEFAULT nextval('plato_id_plato_seq');

ALTER TABLE detalle_pedido
ALTER COLUMN id SET DEFAULT nextval('detalle_pedido_seq');

-- INSERTS PLATOS

INSERT INTO plato (id_plato, nombre, descripcion, precio) VALUES
(1, 'Asado', 'Tradicional barbacoa argentina con variedad de carnes', 1500),
(2, 'Locro', 'Sopa espesa de maíz, frijoles, patatas y carne', 1000),
(3, 'Choripán', 'Sándwich de chorizo asado con chimichurri', 500),
(4, 'Milanesa a la Napolitana', 'Milanesa con salsa de tomate, jamón y queso', 900),
(5, 'Pollo al disco', 'Pollo cocinado en disco de arado con vegetales', 1200),
(6, 'Provoleta', 'Queso provolone asado con orégano y ají', 600),
(7, 'Matambre arrollado', 'Carne enrollada con vegetales y huevo', 1100),
(8, 'Fugazza', 'Pizza argentina cubierta con cebollas y queso', 1300),
(9, 'Carbonada', 'Estofado de carne con maíz, patatas y frutas', 1100),
(10, 'Humita', 'Pasta de maíz con queso envuelta en hojas de maíz', 600),
(11, 'Puchero', 'Sopa de carne con verduras y garbanzos', 950),
(12, 'Vitel Toné', 'Rodajas de ternera en una salsa cremosa de atún y alcaparras', 1200),
(13, 'Matambre a la pizza', 'Carne a la parrilla cubierta con salsa de tomate y queso', 1400),
(14, 'Sorrentinos', 'Pasta rellena similar a los raviolis, pero más grande y redonda', 900),
(15, 'Bife de chorizo', 'Corte de carne de res jugoso y tierno', 1600);