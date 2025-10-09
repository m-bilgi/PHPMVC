/*** Script Date: 08.08.2024 ***/
/*** Last Update: 25.07.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

CREATE TABLE member (
	`id` int UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NULL,
	`surname` varchar(50) NULL,
	`email` varchar(50) NOT NULL,
	`password` varchar(35) NOT NULL,
	`level` tinyint NOT NULL DEFAULT 1,
	`status` tinyint NOT NULL DEFAULT 1,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO member (`id`, `name`, `surname`, `email`, `password`, `level`, `status`) VALUES (1, 'Mustafa', 'Bilgi', 'admin@admin.com', 'admin', 4, 1);
INSERT INTO member (`id`, `name`, `surname`, `email`, `password`, `level`, `status`) VALUES (2, 'Test', 'User', 'test@user.com', 'admin', 1, 1);

ALTER TABLE member ADD CONSTRAINT uk_member_email UNIQUE(email);
