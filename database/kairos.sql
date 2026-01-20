-- =========================================================
-- BBDD: Kairos
-- =========================================================

drop database if exists kairos;
create database kairos character set utf8mb4 collate utf8mb4_general_ci;
use kairos;

-- =========================================================
-- TABLAS MAESTRAS / CATÁLOGOS
-- =========================================================

create table plataforma (
  id int auto_increment,
  nombre varchar(50) not null,
  primary key (id),
  unique (nombre)
);

create table modo_juego (
  id int auto_increment,
  nombre varchar(50) not null,
  primary key (id),
  unique (nombre)
);

create table genero (
  id int auto_increment,
  nombre varchar(50) not null,
  primary key (id),
  unique (nombre)
);

create table pais (
  id int auto_increment,
  nombre varchar(100) not null,
  primary key (id),
  unique (nombre)
);

create table rol (
  id int auto_increment,
  nombre varchar(50) not null,
  primary key (id),
  unique (nombre)
);

-- =========================================================
-- PRODUCTO
-- =========================================================

create table producto (
  id int auto_increment,
  titulo varchar(150) not null,
  cover varchar(255) not null,
  platform_id int not null,
  descuento int not null default 0,
  precio decimal(10,2) not null,
  modo int not null,
  descripcion varchar(1000) not null,

  reqmin_so varchar(150) not null,
  reqmin_procesador varchar(150) not null,
  reqmin_memoria varchar(50) not null,
  reqmin_tarjetagrafica varchar(150) not null,
  reqmin_almacenamiento varchar(50) not null,

  reqrec_so varchar(150) not null,
  reqrec_procesador varchar(150) not null,
  reqrec_memoria varchar(50) not null,
  reqrec_tarjetagrafica varchar(150) not null,
  reqrec_almacenamiento varchar(50) not null,

  primary key (id),
  foreign key (platform_id) references plataforma(id),
  foreign key (modo) references modo_juego(id)
);

-- =========================================================
-- RELACIÓN PRODUCTO - GENERO (N:M)
-- =========================================================

create table producto_genero (
  id_producto int not null,
  id_genero int not null,
  primary key (id_producto, id_genero),
  foreign key (id_producto) references producto(id),
  foreign key (id_genero) references genero(id)
);

-- =========================================================
-- USUARIO
-- =========================================================

create table usuario (
  id int auto_increment,
  username varchar(50) not null,
  password varchar(255) not null,
  nombre varchar(100) not null,
  apellidos varchar(150) not null,
  correo varchar(150) not null,
  fecha_nacimiento date null,
  pais int not null,
  codigo_postal varchar(10) not null,
  telefono varchar(20) not null,
  rol int not null,
  primary key (id),
  unique (username),
  unique (correo),
  foreign key (pais) references pais(id),
  foreign key (rol) references rol(id)
);

-- =========================================================
-- FAVORITOS (USUARIO - PRODUCTO) (N:M)
-- =========================================================

create table favorito_usuario (
  id_usuario int not null,
  id_producto int not null,
  primary key (id_usuario, id_producto),
  foreign key (id_usuario) references usuario(id),
  foreign key (id_producto) references producto(id)
);

-- =========================================================
-- CARRITO
-- =========================================================

create table carrito (
  id int auto_increment,
  id_usuario int not null,
  primary key (id),
  unique (id_usuario),
  foreign key (id_usuario) references usuario(id)
);

create table carrito_producto (
  id_carrito int not null,
  id_producto int not null,
  cantidad int not null,
  primary key (id_carrito, id_producto),
  foreign key (id_carrito) references carrito(id),
  foreign key (id_producto) references producto(id)
);

-- =========================================================
-- PEDIDO
-- =========================================================

create table pedido (
  id int auto_increment,
  id_usuario int not null,
  fecha datetime not null,
  estado varchar(20) not null,
  total decimal(10,2) not null,
  ciudad varchar(100) not null,
  codigo_postal varchar(10) not null,
  direccion_envio varchar(255) not null,
  telefono varchar(20) not null,
  primary key (id),
  foreign key (id_usuario) references usuario(id)
);

create table pedido_linea (
  id_pedido int not null,
  id_producto int not null,
  cantidad int not null,
  precio_unitario decimal(10,2) not null,
  primary key (id_pedido, id_producto),
  foreign key (id_pedido) references pedido(id),
  foreign key (id_producto) references producto(id)
);

-- =========================================================
-- VALORACIÓN DE PRODUCTOS
-- =========================================================

create table valoracion_producto (
  id_usuario int not null,
  id_producto int not null,
  valoracion int not null default 5,
  comentario varchar(500) null,
  primary key (id_usuario, id_producto),
  foreign key (id_usuario) references usuario(id),
  foreign key (id_producto) references producto(id)
);
