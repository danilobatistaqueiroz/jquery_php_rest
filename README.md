# using jquery / jquery-validation / bootstrap / notifyjs

https://notifyjs.com/

http://bootstrap-notify.remabledesigns.com/#documentation

$ bower install jquery-validation
$ bower install jquery
$ bower install bootstrap

change the validation for this:
https://stackoverflow.com/questions/4198816/jquery-validate-plugin-and-ajax-form-submission
add this convert script from json to grid:
http://www.guriddo.net/demo/guriddojs/

# POSTGRESQL
### helpful tips
switch databases
\c DBNAME
or
\connect DBNAME

connect to database: psql -d doctrinedb -U postgres
start the server:   pg_ctl -D "C:/servers/pgsql/data" -l logfile start

list all databases and tables
\list or \l: list all databases
\dt: list all tables in the current database

create the database: create database petshop;
create the user: create user petadm;

To reset the password:
ALTER USER "petadm" WITH PASSWORD '123';

Rename a database:
ALTER DATABASE petshop RENAME TO petshopdb;

Rename a table;
alter table product rename to products;

Export a dump:
pg_dump -U postgres -d petshopdb > c:/pgsql/petshopdb.sql


###
### structure/data script
drop table products;
drop table categories;

create table category (
id serial primary key,
name varchar(30) not null
);

create table products (
id serial primary key,
name varchar(30) not null,
categoryId int references categories(id)
);

GRANT ALL PRIVILEGES ON DATABASE petshopdb to petadm;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO petadm;
GRANT ALL PRIVILEGES ON ALL sequences IN SCHEMA public TO petadm;

insert into categories (name) values ('cats');
insert into categories (name) values ('dogs');
insert into categories (name) values ('birds');

insert into products (name,categoryId) values ('food for dog', 2);
insert into products (name,categoryId) values ('food for cat', 1);
insert into products (name,categoryId) values ('Cat scratcher', 1);
insert into products (name,categoryId) values ('Cat toy', 1);
insert into products (name,categoryId) values ('bird's food', 3);
insert into products (name,categoryId) values ('Collar for dog', 2);

CREATE TABLE UserRoles (
    login character varying(255) NOT NULL,
    role character varying(32) NOT NULL
);

CREATE TABLE TYPES (
    name varchar(15) not null primary key
);

CREATE TABLE Users (
    login character varying(30) NOT NULL,
    name character varying(255) NOT NULL,
    passwd character varying(255) NOT NULL,
    email character varying(100) NOT NULL,
    address character varying(255) NOT NULL,
    type varchar(15) not null references types(name)
);

ALTER TABLE UserRoles OWNER TO petadm;
ALTER TABLE Users OWNER TO petadm;

ALTER TABLE ONLY Users ADD CONSTRAINT "Users_pkey" PRIMARY KEY (login);

insert into types values ('Admin'),('Customer'),('Supplier'),('Shipper');

COPY UserRoles (login, role) FROM stdin;
adam	admin
tomy	commonUser
mary	commonUser
batista	admin
queiroz	admin
\.

COPY Users (login, passwd, name, email, address, type) FROM stdin;
adam	A6xnQhbz4Vx2HuGl4lXwZ5U2I8iziLRFnhP5eNfIRvQ=	Adam Smith	adam@gmail.com	street new york	Admin
batista	A6xnQhbz4Vx2HuGl4lXwZ5U2I8iziLRFnhP5eNfIRvQ=	Batista Queiroz	batista@gmail.com	rua viana	Supplier
mary	A6xnQhbz4Vx2HuGl4lXwZ5U2I8iziLRFnhP5eNfIRvQ=	Mary Key	mary@gmail.com  mary	avenue north	Shipper
queiroz	A6xnQhbz4Vx2HuGl4lXwZ5U2I8iziLRFnhP5eNfIRvQ=	Danilo Queiroz	queiroz@gmail.com	rua cristiano viana	Admin
tomy	A6xnQhbz4Vx2HuGl4lXwZ5U2I8iziLRFnhP5eNfIRvQ=	Tomy Lee	tomy@gmail.com	street left	Customer
\.
###
