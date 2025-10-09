/*** Script Date: 09.08.2024 ***/
/*** Last Update: 01.09.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

CREATE TABLE category (
	`id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
	`guid` varchar(64) NOT NULL,
	`name` varchar(100) NULL,
	`hit` int UNSIGNED NOT NULL DEFAULT 0,
	`image` varchar(100) NULL,
	`sort_order` smallint NOT NULL DEFAULT 0,
	`url` varchar(255) NULL,
	`status` tinyint NOT NULL DEFAULT 0,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO module_category (`id`, `module_id`, `guid`, `name`, `hit`, `image`, `sort_order`, `status`, `url`) VALUES (1,  'Biographies', 440345, NULL, 0,1, 'biyografiler');
INSERT INTO module_category (`id`, `module_id`, `guid`, `name`, `hit`, `image`, `sort_order`, `status`, `url`) VALUES (2,  'Art and Philosophy', 83568, NULL, 0,0, 'sanat-ve-felsefe');
INSERT INTO module_category (`id`, `module_id`, `guid`, `name`, `hit`, `image`, `sort_order`, `status`, `url`) VALUES (3,  'Literature', 67849, NULL, 0,1, 'edebiyat');
INSERT INTO module_category (`id`, `module_id`, `guid`, `name`, `hit`, `image`, `sort_order`, `status`, `url`) VALUES (4, 'Poetry', 4365, NULL, 0,0, 'siirler');
INSERT INTO module_category (`id`, `module_id`, `guid`, `name`, `hit`, `image`, `sort_order`, `status`, `url`) VALUES (5, 'Articles and Research', 1885111, NULL, 0,1, 'makale-ve-arastirmalar');
INSERT INTO module_category (`id`, `module_id`, `guid`, `name`, `hit`, `image`, `sort_order`, `status`, `url`) VALUES (6, 'Art Movements', 54870, NULL, 0,1, 'sanat-akimlari');
