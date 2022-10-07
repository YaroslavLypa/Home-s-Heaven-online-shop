# Home's Heaven. Online shop by Yaroslav Lypa

## Database structure
### Countries
```mysql
create table countries
(
    id int auto_increment primary key,
    country_name varchar(80) not null
)
    charset = utf8;
```
### Users
```mysql
create table users
(
    id int unsigned auto_increment primary key,
    email varchar(100) charset utf8 not null,
    login varchar(100) charset utf8 not null,
    name varchar(100) charset utf8 not null,
    password varchar(32) charset utf8 not null,
    birthdate date not null,
    country varchar(100) charset utf8 not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    constraint email unique (email),
    constraint login unique (login)
)
    charset = utf8;
```
### Goods
```mysql
create table goods
(
id int auto_increment primary key,
title varchar(100) charset utf8 not null,
color varchar(100) charset utf8 not null,
width varchar(100) charset utf8 not null,
height varchar(100) charset utf8 not null,
price varchar(100) charset utf8 not null,
img text charset utf8 not null
)
charset = utf8;
```