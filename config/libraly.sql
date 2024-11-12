CREATE SCHEMA library;

USE library;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cpf VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    user_role INT NOT NULL
);

CREATE TABLE authors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL    
);

CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    publication YEAR NOT NULL,
    book_cover VARCHAR(255) NOT NULL,
    price DECIMAL(5, 2) NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories (id)
);

CREATE TABLE author_book (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    book_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors (id),
    FOREIGN KEY (book_id) REFERENCES books (id)
);

CREATE TABLE purchases (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATETIME NOT NULL
);

CREATE TABLE purchase_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT NOT NULL,
    purchase_id INT NOT NULL,
    unit_value FLOAT NOT NULL,
    quantity INT NOT NULL,
    total_item_value FLOAT NOT NULL,
    FOREIGN KEY (book_id) REFERENCES books (id),
    FOREIGN KEY (purchase_id) REFERENCES purchases (id)
);
