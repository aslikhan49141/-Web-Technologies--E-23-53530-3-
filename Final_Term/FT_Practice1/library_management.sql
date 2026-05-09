create database if not exists library_management;
use library_management;

create table if not exists books(
    id int auto_increment primary key,
    title varchar(100) not null,
    author varchar(100) not null,
    category varchar(50) not null,
    status varchar(20) not null
);
