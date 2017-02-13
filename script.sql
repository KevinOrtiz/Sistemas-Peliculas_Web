create database Sistema_Peliculas;
USE Sistema_Peliculas;

create table Usuario(
 id integer auto_increment,
 nombre varchar(35),
 apellido varchar(35),
 usuario varchar(35),
 contrasena varchar(10),
 primary key(id),
 pelicula_id integer,
 foreign key(pelicula_id) references Pelicula(id) ON DELETE CASCADE
);


create table Administrador(
id  integer auto_increment,
nombre varchar(35),
usuario varchar(35),
contrasena varchar(10),
primary key(id),
estudiante_id integer,
foreign key(estudiante_id) references Usuario(id) on delete CASCADE
);

create table Pelicula(
 id integer auto_increment,
 nombre_pelicula varchar(50),
 descripcion_pelicula varchar(100),
 estrella  integer,
 url varchar(120),
 imagen varchar(120),
 veces_vista integer,
 primary key(id)
);