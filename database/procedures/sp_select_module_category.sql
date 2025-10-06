/*** Script Date: 06.08.2025 ***/
/*** Last Update: 06.10.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

DELIMITER //

CREATE PROCEDURE sp_select_module_category (
	procType		varchar(20),
	langValue		varchar(10),
	categoryId		smallint,
	moduleId		smallint,
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
		WHERE		(module_category.module_id=moduleId)
		ORDER BY	module_category.name;
	END IF;
	/* end default */

	/* start multilanguage */
	IF (procType = 'mlangCatList') THEN
		SELECT			module_category.*,
						multilanguage.title as mlang_title,
						multilanguage.keywords as mlang_keywords,
						multilanguage.summary as mlang_summary,
						multilanguage.content as mlang_content
		FROM			module_category
		LEFT OUTER JOIN multilanguage ON ((module_category.guid=multilanguage.guid) AND (multilanguage.language=langValue))
		WHERE			(module_category.module_id=moduleId) AND (module_category.status=1)
		ORDER BY		module_category.sort_order, module_category.name;
	END IF;

	/* start test, not used */
	IF (procType = 'mlangTestCatSubcatList') THEN
		SELECT		c.id AS category_id,
					c.name AS category_name,
					sc.id AS subcategory_id,
					sc.name AS subcategory_name,
					sc.data_count,
					mlc.title AS mlang_category_title,
					mls.title AS mlang_subcategory_title
		FROM		module_category c
		LEFT JOIN	module_subcategory sc ON sc.category_id = c.id
		LEFT JOIN	multilanguage mlc ON mlc.guid=c.guid AND mlc.language=langValue
		LEFT JOIN	multilanguage mls ON mls.guid=sc.guid AND mls.language=langValue
		WHERE		(sc.module_id=moduleId) AND (sc.status=1) AND (c.status=1)
		ORDER BY	c.name, sc.sort_order, sc.name;
	END IF;
	/* end test, not used */
	/* end multilanguage */
END//

DELIMITER ;
