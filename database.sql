ALTER TABLE tbl_user ENGINE=InnoDB ;
ALTER TABLE `tbl_ostan` ADD INDEX(`id`);
ALTER TABLE `tbl_user` ADD INDEX(`id`);
CREATE TABLE tbl_ostan_user
(
user_id     int(11),
ostan_id	int(11),
FOREIGN KEY (user_id) REFERENCES tbl_user(id),
FOREIGN KEY (ostan_id) REFERENCES tbl_ostan(id)
);
INSERT INTO `qmb`.`tbl_ostan_user` (`user_id`, `ostan_id`) VALUES ('1', '2');