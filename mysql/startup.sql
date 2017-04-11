CREATE DATABASE image_edit;

CREATE USER 'img_read_user'@'localhost' IDENTIFIED BY 'P@ssw0rd1!';
GRANT SELECT, INSERT, UPDATE ON `image_edit`.* TO 'img_read_user'@'localhost';

CREATE USER 'img_del_user'@'localhost' IDENTIFIED BY 'P@ssw0rd2!';
GRANT DELETE ON `image_edit`.* TO 'img_del_user'@'localhost';
