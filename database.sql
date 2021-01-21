CREATE DATABASE ID NOT EXISTS symfony_master;
USE symfony_master;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
role            varchar(50),
name            varchar(100),
surname         varchar(200),
email           varchar(255),
password        varchar(255),
created_at      datetime,
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS tasks (
id              int(255) auto_increment not null,
user_id         int(255) not null,
title           varchar(255)
content         text,
priority        varchar(20),
hours           int(100),
created_at      datetime,
CONSTRAINT pk_tasks PRIMARY KEY(id),
CONSTRAINT fk_task_user FOREIGN KEY(user_id) REFERENCES users(id) 
)ENGINE=InnoDb;


INSERT INTO users VALUES(null,'ROLE_USER','Test 1','Test 1','test1@gmail.com','123456',CURTIME());
INSERT INTO users VALUES(null,'ROLE_USER','Test 2','Test 2','test2@gmail.com','123456',CURTIME());
INSERT INTO users VALUES(null,'ROLE_USER','Test 3','Test 3','test3@gmail.com','123456',CURTIME());
INSERT INTO users VALUES(null,'ROLE_USER','Test 4','Test 4','test4@gmail.com','123456',CURTIME());

INSERT INTO tasks VALUES(null,1,'Task 1','Tast 1','Task 1',1,CURTIME());
INSERT INTO tasks VALUES(null,2,'Task 2','Tast 2','Task 2',1,CURTIME());
INSERT INTO tasks VALUES(null,3,'Task 3','Tast 3','Task 3',1,CURTIME());
INSERT INTO tasks VALUES(null,4,'Task 4','Tast 4','Task 4',1,CURTIME());
