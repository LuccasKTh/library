use library;

insert into users (name, email, cpf, password, user_role) values ('Lucas Kelim Thiel', '105.712.719-10', '123', 1);
insert into users (name, email, cpf, password, user_role) values ('Evelyn Vitória de Assis dos Santos', '105.722.715-12', '123', 1);

insert into categories (description) values ('Realista');
insert into categories (description) values ('Romance');
insert into categories (description) values ('Suspense');
insert into categories (description) values ('Terror');
insert into categories (description) values ('Erótico');
insert into categories (description) values ('Ação');
insert into categories (description) values ('Aventura');

insert into books (title, publication, book_cover, category_id) values ('Parque industrial', 2023, 'path', 1);
insert into books (title, publication, book_cover, category_id) values ('Iracema', 2012, 'path', 2);

insert into authors (name, last_name) values ('Lucas', 'Kelim Thiel');
insert into authors (name, last_name) values ('Evelyn Vitória', 'de Assis dos Santos');
