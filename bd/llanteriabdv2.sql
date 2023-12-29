create database llanteriabd;

use llanteriabd;

create table usuarios(
				id_usuario int auto_increment,
				nombre varchar(50),
				apellido varchar(50),
				username varchar(50),
				password text(50),
				fechaAlta date,
				primary key(id_usuario)
					);

create table categorias (
				id_categoria int auto_increment,
				id_usuario int not null,
				nombreCategoria varchar(150),
				fechaCaptura date,
				primary key(id_categoria)
						);

create table imagenes(
				id_imagen int auto_increment,
        id_categoria int not null,
				nombre varchar(500),
				ubicacion varchar(500),
				fechaSubida date,
				primary key(id_imagen)
					);

create table productos(
				id_producto int auto_increment,
        id_categoria int not null,
				id_imagen int not null,
				id_usuario int not null,
				nombre varchar(50),
				descripcion varchar(500),
				cantidad int,
				precio float,
				fechaCaptura date,
				primary key(id_producto)
					);

create table empleados(
				id_empleado int auto_increment,
				id_usuario int not null,
				nombre varchar(200),
				apellido varchar(200),
				dni varchar(8),
        ocupacion varchar(200),
				email varchar(200),
				telefono varchar(200),
        fechaContrato varchar(200),
				primary key(id_empleado)
					);

create table pedidos(
				id_pedido int auto_increment,
				id_usuario int not null,
        fecha date,
				nombreCliente varchar(200),
        apellidoCliente varchar(200),
				dniCliente varchar(200),
				emailCliente varchar(200),
				telefonoCliente varchar(200),
        direccionCliente varchar(200),
        estadocivil varchar(200),
        foto varchar(200),
				primary key(id_pedido)
					);
          

create table ventas(
				id_venta int not null,
				id_pedido int,
				id_producto int,
				id_usuario int,
				precio float,
				fecha date
					);