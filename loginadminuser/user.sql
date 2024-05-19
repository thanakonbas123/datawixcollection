CREATE TABLE user (
    id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username Varchar(50) NOT NULL,
    password Varchar(50) NOT NULL,
    firstname Varchar(50) NOT NULL,
    lastname Varchar(50) NOT NULL,
    userlevel Varchar(1) NOT NULL
)ENGINE = InnoDB DEFAULT CHARSET = utf8;
