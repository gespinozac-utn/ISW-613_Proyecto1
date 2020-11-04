CREATE DATABASE ´ISW-613_Proyecto1´;
USE ´ISW-613_Proyecto1´;

create table users(
    id int not null auto_increment primary key,
    username varchar(150),
    password varchar(100),
    role varchar(13) DEFAULT 'Cliente'
);

create table clients(
    id int not null auto_increment primary key,
    idUser int not null,
    name varchar(150),
    email varchar(100),
    phone varchar(150),
    address varchar(150)
);

create table category(
    id int not null auto_increment primary key,
    name varchar(50),
    parent varchar(50)
);

create table product(
    id int not null auto_increment primary key,
    sku varchar(50) not null,
    name varchar(50),
    description varchar(150),
    imageURL varchar(100) DEFAULT 'UPLOADS/PLACEHOLDER.png',
    idCategory int,
    stock int,
    price float
);

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES (1, 'admin', 'admin', 'Administrador');

SELECT 
        p.`SKU`,
        p.`name`,
        p.`description`,
        p.`idCategory`,
        c.`name` as CATEGORY
    FROM product as p 
        INNER JOIN category as c  on (p.idCategory = c.id);

-- SELECTOR DE BUSQUEDA CON FILTROS EN name, sku, Y nombre de categoria
-- SELECT p.*,c.name AS categoryName 
-- FROM product as p 
--     INNER JOIN category AS c ON (p.idCategory = c.id) 
--     INNER JOIN category AS pa ON (c.parent = pa.name)
-- WHERE p.`name` LIKE '%%' OR 
--             p.`SKU` LIKE '%%' OR 
--             c.`name` LIKE '%%' OR
--             pa.`name` LIKE '%%';

-- CONSULTA PARA BUSCAR CATEGORIAS CON PRODUCTOS RELACIONADOS
-- SELECT p.* FROM product AS p 
--     INNER JOIN category AS c ON (p.idCategory = c.id)
-- WHERE p.idCategory = '';

-- CONSULTA PARA BUSCAR CATEGORIAS PADRES CON CATEGORIAS HIJOS
-- SELECT c.* FROM category AS c
--     INNER JOIN category AS p ON(p.name = c.parent)
-- WHERE p.id = '';

-- SELECTOR DE BUSQUEDA CON FILTROS EN producto nombre y sku, categoria nombre y padre
-- SELECT p.name,c.name AS categoryName 
-- FROM product as p 
--     INNER JOIN category AS c ON (p.idCategory = c.id) 
--     INNER JOIN category AS pa ON (pa.name = c.parent OR p.idCategory = pa.id)
-- WHERE p.`name` LIKE '%Ropa%' OR 
--             p.`SKU` LIKE '%Ropa%' OR 
--             c.`name` LIKE '%Ropa%' OR
--             pa.`name` LIKE '%Ropa%';

-- SELECTOR DE FILTRADO PARA BUSCAR PRODUCTOS POR CATEGORIA
-- SELECT DISTINCT p.*
-- FROM product AS p
--     INNER JOIN category AS c ON (p.idCategory = c.id)
--     INNER JOIN category AS pa ON (p.idCategory = pa.id OR c.parent = pa.name)
-- WHERE c.id = '' or pa.id = '';