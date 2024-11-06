create schema library;

use library;

create table users (
    id int primary key auto_increment,
    name varchar not null,
    email varchar not null,
    cpf varchar,
    password varchar not null,
    user_role int not null
);

create table authors (
    id int primary key auto_increment,
    name varchar not null,
    last_name varchar not null
);

create table categories (
    id int primary key auto_increment,
    description varchar not null    
);

create table books (
    id int primary key auto_increment,
    title varchar not null,
    publication int not null,
    book_cover varchar not null,
    category_id int not null,
    foreign key (category_id) references categories (id)
);

create table author_book (
    id int primary key auto_increment,
    author_id int not null,
    book_id int not null
);

create table purchases (
    id int primary key auto_increment,
    date datetime not null,
);

create table purchase_items (
    id int primary key auto_increment,
    book_id int not null,
    purchase_id int not null,
    unit_value float not null,
    quantity int not null,
    total_item_value float not null
);