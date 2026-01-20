insert ignore into genero (nombre) values
('Deportes'),
('Acción'),
('Aventura'),
('Shooter'),
('Carreras'),
('Plataformas');

-- ---------------------------------------------------------
-- 2) Insertar productos
--    Nota: se insertan con ID fijo (1..8) para que coincidan
--    con tu products.php. Si ya existen, se actualizan.
-- ---------------------------------------------------------

insert into producto (
  id, titulo, cover, platform_id, descuento, precio, modo, descripcion,
  reqmin_so, reqmin_procesador, reqmin_memoria, reqmin_tarjetagrafica, reqmin_almacenamiento,
  reqrec_so, reqrec_procesador, reqrec_memoria, reqrec_tarjetagrafica, reqrec_almacenamiento
) values
(
  1,
  'EA Sports FC 26',
  'assets/img/covers/fc26.jpg',
  (select id from plataforma where nombre = 'Steam' limit 1),
  30,
  39.99,
  (select id from modo_juego where nombre = 'Online' limit 1),
  'La próxima evolución del fútbol con mecánicas renovadas, física mejorada y experiencias competitivas online y offline.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  2,
  'EA Sports FC 25',
  'assets/img/covers/fc25.jpeg',
  (select id from plataforma where nombre = 'Steam' limit 1),
  10,
  49.99,
  (select id from modo_juego where nombre = 'Online' limit 1),
  'Fútbol con nuevas animaciones, modos renovados y mejoras de jugabilidad orientadas al competitivo.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  3,
  'God of War Ragnarök',
  'assets/img/covers/gow-ragnarok.jpg',
  (select id from plataforma where nombre = 'PlayStation' limit 1),
  25,
  44.99,
  (select id from modo_juego where nombre = 'Un jugador' limit 1),
  'Kratos y Atreus se enfrentan al Ragnarök en una aventura épica por los nueve reinos.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  4,
  'The Last of Us Part I',
  'assets/img/covers/tlou-part1.jpg',
  (select id from plataforma where nombre = 'PlayStation' limit 1),
  15,
  59.99,
  (select id from modo_juego where nombre = 'Un jugador' limit 1),
  'Una versión modernizada del clásico con mejoras gráficas, de IA y de accesibilidad.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  5,
  'Halo Infinite',
  'assets/img/covers/halo-infinite.jpeg',
  (select id from plataforma where nombre = 'Xbox' limit 1),
  40,
  29.99,
  (select id from modo_juego where nombre = 'Online' limit 1),
  'El Jefe Maestro regresa con campaña y multijugador para combates de arena.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  6,
  'Forza Horizon 5',
  'assets/img/covers/forza-horizon-5.jpeg',
  (select id from plataforma where nombre = 'Xbox' limit 1),
  20,
  47.99,
  (select id from modo_juego where nombre = 'Online' limit 1),
  'Festival de conducción en mundo abierto con cientos de coches y eventos en México.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  7,
  'The Legend of Zelda: Tears of the Kingdom',
  'assets/img/covers/zelda-totk.jpeg',
  (select id from plataforma where nombre = 'Nintendo' limit 1),
  5,
  64.99,
  (select id from modo_juego where nombre = 'Un jugador' limit 1),
  'Explora Hyrule y los cielos con nuevas habilidades y construcción de artefactos.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
),
(
  8,
  'Super Mario Bros. Wonder',
  'assets/img/covers/mario-wonder.jpg',
  (select id from plataforma where nombre = 'Nintendo' limit 1),
  15,
  54.99,
  (select id from modo_juego where nombre = 'Local' limit 1),
  'Nueva aventura 2D con flores maravilla, niveles creativos y cooperativo.',
  'N/D','N/D','N/D','N/D','N/D',
  'N/D','N/D','N/D','N/D','N/D'
)
on duplicate key update
  titulo = values(titulo),
  cover = values(cover),
  platform_id = values(platform_id),
  descuento = values(descuento),
  precio = values(precio),
  modo = values(modo),
  descripcion = values(descripcion);

-- ---------------------------------------------------------
-- 3) Insertar relaciones producto_genero
-- ---------------------------------------------------------

-- FC 26 -> Deportes
insert ignore into producto_genero (id_producto, id_genero)
values (1, (select id from genero where nombre = 'Deportes' limit 1));

-- FC 25 -> Deportes
insert ignore into producto_genero (id_producto, id_genero)
values (2, (select id from genero where nombre = 'Deportes' limit 1));

-- God of War -> Accion + Aventura
insert ignore into producto_genero (id_producto, id_genero)
values
(3, (select id from genero where nombre = 'Acción' limit 1)),
(3, (select id from genero where nombre = 'Aventura' limit 1));

-- TLOU Part I -> Accion + Aventura
insert ignore into producto_genero (id_producto, id_genero)
values
(4, (select id from genero where nombre = 'Acción' limit 1)),
(4, (select id from genero where nombre = 'Aventura' limit 1));

-- Halo Infinite -> Shooter
insert ignore into producto_genero (id_producto, id_genero)
values (5, (select id from genero where nombre = 'Shooter' limit 1));

-- Forza Horizon 5 -> Carreras
insert ignore into producto_genero (id_producto, id_genero)
values (6, (select id from genero where nombre = 'Carreras' limit 1));

-- Zelda TOTK -> Aventura
insert ignore into producto_genero (id_producto, id_genero)
values (7, (select id from genero where nombre = 'Aventura' limit 1));

-- Mario Wonder -> Plataformas
insert ignore into producto_genero (id_producto, id_genero)
values (8, (select id from genero where nombre = 'Plataformas' limit 1));