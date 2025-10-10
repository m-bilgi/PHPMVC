/*** Script Date: 11.10.2025 ***/
/*** Last Update: 11.10.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

DELIMITER //

CREATE PROCEDURE sp_update_category (
	procType		varchar(20),
	categoryId		smallint,
	categoryName	varchar(100),
	categoryHit		tinyint,
	categoryImage	varchar(100),
	categoryShort	tinyint,
	categoryUrl		varchar(255),
	categoryStatus	tinyint
)

BEGIN
	/* start default */
	IF (procType = 'update') THEN
		UPDATE	category
		SET		category.name = categoryName,
				category.image = categoryImage,
				category.sort_order = categoryShort,
				category.url = categoryUrl,
				category.status = categoryStatus
		WHERE	(category.id=categoryId);
	END IF;
	/* end default */

	IF (procType = 'updateHit') THEN
		UPDATE	category
		SET		category.hit = category.hit + 1
		WHERE	(category.id=categoryId);
	END IF;
END//

DELIMITER ;
