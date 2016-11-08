-- MySQL dump

INSERT INTO `KlearUsers` VALUES (
	1,
	'username',
	'useremail',
	'$_salt$rounds=_rounds$_hash',
	1,
	'timestamp'
	)
;

/*

EXAMPLE DATA

INSERT INTO `KlearUsers` VALUES (
	1,
	'admin',
	'admin@domain.com',
	'$1$rounds=8000$abcd1234$dfgdfgdfgfgd2561fgh56gf4hj5gf4h561gh5df6gc/',
	1,
	'2016-11-08 12:00:00'
	)
;
*/
