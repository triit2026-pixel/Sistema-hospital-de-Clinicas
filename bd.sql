CREATE DATABASE IF NOT EXISTS crudlitesystem;
USE crudlitesystem;

CREATE TABLE IF NOT EXISTS usuario (
    ci VARCHAR(10) NOT NULL PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL
);

INSERT INTO usuario (ci, nombre, apellido) VALUES ('11111111', 'Foo', 'Bar');