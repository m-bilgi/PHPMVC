/*** Script Date: 06.08.2025 ***/
/*** Last Update: 06.10.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

DELIMITER //

CREATE PROCEDURE sp_select_category (
	procType		varchar(20),
	langValue		varchar(10),
	categoryId		smallint,
	categoryUrl		varchar(255),
	categoryStatus	tinyint
)

BEGIN
	/* start default */
	IF (procType = 'cat') THEN
		SELECT	module_category.*
		FROM	module_category
		WHERE	(module_category.id=categoryId);
	END IF;

	IF (procType = 'catList') THEN
		SELECT		module_category.*
		FROM		module_category
		ORDER BY	module_category.name;
	END IF;
	/* end default */
END//

DELIMITER ;
