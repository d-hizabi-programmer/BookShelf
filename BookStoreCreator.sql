# creating book table to store books information
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

#creating order table to store Order's information
CREATE TABLE orders(
orderid int auto_increment primary key,
firstName varchar(60) not null,
lastName varchar(60),
paymentOption varchar(30) not null,
cardNum varchar(30) not null,
total double not null,
bookId int not null,
quantity int,
foreign key(bookId) references book(bookId));