-- 创建数据库
CREATE DATABASE notebook CHARACTER SET utf8 COLLATE utf8_general_ci;

-- 创建表用户表
CREATE TABLE users(
	id int primary key auto_increment,
	name varchar(80),
	username varchar(80),
	password varchar(80),
	email varchar(80),
	phone varchar(80),
	created_at datetime DEFAULT NOW() COMMENT '注册时间',
	updated_at datetime DEFAULT NOW() COMMENT '更新时间'
)CHARACTER SET utf8 COLLATE utf8_general_ci;

-- 创建文章表
CREATE TABLE articles(
	`id` int primary key auto_increment,
	`user_id` int,
	`title` varchar(255),
	`content` text,
	`created_at` datetime DEFAULT NOW() COMMENT '文章创建时间',
	`updated_at` datetime DEFAULT NOW() COMMENT '文章更新时间'
)CHARACTER SET utf8 COLLATE utf8_general_ci;