CREATE TABLE book(
bookId int AUTO_INCREMENT PRIMARY KEY,
bookName varchar(30) not null,
bookAuthor varchar(30) not null,
bookDescirption varchar(500) not null,
totalPages int,
publishYear int,
quantity int,
price double not null
);