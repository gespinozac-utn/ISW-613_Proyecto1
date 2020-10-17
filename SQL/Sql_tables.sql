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
    email varchar(100)
);

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'Administrador');