/*** Script Date: 11.10.2025 ***/
/*** Last Update: 11.10.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

DELIMITER //

CREATE PROCEDURE sp_insert_category (
	procType		varchar(20),
	categoryName	varchar(100),
	categoryHit		tinyint,
	categoryImage	varchar(100),
	categoryShort	tinyint,
	categoryUrl		varchar(255),
	categoryStatus	tinyint
)

BEGIN
	/* start default */
	IF (procType = 'insert') THEN
		INSERT INTO	category (
					category.name,
					category.hit,
					category.image,
					category.sort_order,
					category.url,
					category.status
		) VALUES (
					categoryName,
					categoryHit,
					categoryImage,
					categoryShort,
					categoryUrl,
					categoryStatus
		);
	END IF;
	/* end default */
END//

DELIMITER ;
