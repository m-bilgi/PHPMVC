/*** Script Date: 14.08.2024 ***/
/*** Last Update: 24.09.2025 ***/
/*** MSSQL to MySQL DataType Convert: https://dev.mysql.com/doc/workbench/en/wb-migration-database-mssql-typemapping.html ***/

DELIMITER //

CREATE PROCEDURE sp_select_member (
	procType		varchar(20),
	anyValue01		varchar(100),
	anyValue02		varchar(100),
	userId			int,
	userEmail		varchar(50),
	userPassword	varchar(35),
	userLevel		tinyint,
	userStatus		tinyint
)

BEGIN
	/* start default */
	IF (procType = 'user') THEN
		SELECT	member.*
		FROM	member
		WHERE	(member.id=userId);
	END IF;

	IF (procType = 'userList') THEN
		SELECT		member.*
		FROM		member
		ORDER BY	member.id ASC;
	END IF;
	/* end default */

	IF (procType = 'loginByMail') THEN
		SELECT	member.id,
				member.email,
				member.password,
				member.level
		FROM	member
		WHERE	(member.email=userEmail) AND (member.password=userPassword) AND (member.status=1);
	END IF;
END//

DELIMITER ;
