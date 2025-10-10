/*** Script Date: 11.10.2025 ***/
/*** Last Update: 11.10.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

DELIMITER //

CREATE PROCEDURE sp_delete_category (
	procType		varchar(20),
	categoryId		smallint
)

BEGIN
	/* start default */
	IF (procType = 'delete') THEN
		DELETE FROM category
		WHERE		(category.id=categoryId);
	END IF;
	/* end default */
END//

DELIMITER ;
