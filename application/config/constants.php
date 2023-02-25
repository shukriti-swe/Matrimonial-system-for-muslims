<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('INVOICE_PDF_FILES_FOLDER', "./uploads/");

//define('STRIPE_KEY', 				"pk_test_M9UkjQS0U8WUK8SacU0CrPvw00EhalrTy3");
//define('STRIPE_SECRET_KEY', 		"sk_test_jAPXgtZXk3BRrCAAkaHq1aD900fWkcMUuD");
define('STRIPE_KEY', 				"pk_test_51KGKJzJI3nudhk0k5wAohzUKhGnuR0YxxMpjBhAhsRVs5ckHtdqq9rrlJGvBPpyrNcXvDRF1b5b6k6gzqi7SOLwY005ECuTns1");
define('STRIPE_SECRET_KEY', 		"sk_test_51KGKJzJI3nudhk0kjrT6wYMLlCGMLvxRCs4S7lkd5IexcHUaMhTdFCu1oOg86VqlayolWNAph5e8bprKYBOCCLXH00qPRx2mna");
define('STR_PAY_SUCCESS_WEBHOOK', 	"whsec_Azoh9bgwvhHcE9o9MsYJbNzVeuHN9iE8");

define('QUARTERLY_PLAN', 			"prod_IbFKTrw7iwSoYo");
define('QUARTERLY_PLAN_PRICE_KEY', 	"price_1L29FhJI3nudhk0k33MAj01b");

define('BI_ANNUAL_PLAN', 			"prod_IbFJjgfxPFcyCj");
define('BI_ANNUAL_PLAN_PRICE_KEY', 	"price_1L29FhJI3nudhk0kBF9RQB6s");

define('ANNUAL_PLAN', 				"prod_IbFHpPCRPiwIK1");
define('ANNUAL_PLAN_PRICE_KEY', 	"price_1L29FiJI3nudhk0kHbj0I1NW");

define('DAILY_PLAN', 				"prod_IbFF9LD0R5xV45");
define('DAILY_PLAN_PRICE_KEY', 	    "price_1L29FhJI3nudhk0kDc16boWI");


//paypal
//define('PAYPAL_ACCESS_TOKEN', 		"A21AALxchrSs9h1ORhvKtJZut-WO4NhmPgGyQhwXi2hugvzlsGcjYDjK-gqvgAFCs_xkyVKCrpf_KojgioJUPR4kKWmSmbDwA");
//define('PAYPAL_ACCESS_TOKEN', 		"A21AAL8gZbap5c8fu_JGnOIjK3KD4-mWYZDeIHxchA-z845uoILgLrywNIp-ztkms6dfUxcQTDRAThyC-0f15gpNk5VIA3-MQ");
define('_PRODUCE_ID', 	  "PROD-76618712EL2664839");
define('_PLAN_ID', 	  "P-3BR86891RY919581ML7QJISI");


//product id
define('PAYPAL_MEMBERSHIP_PRODUCE_ID', 	  "PROD-80B66573LX512650J");//membership product
define('PAYPAL_ADVERTISEMENT_PRODUCE_ID', "PROD-95E4677333589432D");//advertisement product
define('PAYPAL_COVER_PIC_PRODUCE_ID',     "PROD-05L60510XB400411R");//cover pucture product



define('PAYPAL_PER_MONTH_PLAN_ID', 	    "P-4N705238PK397611UMAB7P5Y");//membership per month plan
define('PAYPAL_THREE_MONTH_PLAN_ID', 	"P-43J88522GX8635343MAB7RCI");//membership 3 month plan
define('PAYPAL_SIX_MONTH_PLAN_ID', 	    "P-8D4066048N4523633MAB7SFA");//membership 6 month plan
define('PAYPAL_TWELVE_MONTH_PLAN_ID', 	"P-8VB60781S06723334MAB7TNQ");//membership 12 month plan
define('PAYPAL_M_TEST', 	"P-7N506628H1840983RL7TT3QQ");//test

define('PAYPAL_SIX_MONTH_ADS_PLAN_ID', 	    "P-8DY248131L1800107MCJXQNQ");
//Advertisement 6 month plan P-67U28474SB091332BMAB6QRI
define('PAYPAL_TWELVE_MONTH_ADS_PLAN_ID', 	"P-22G76871LG661705JMCJX4DI");
//Advertisement 12 month plan P-95X20952K4821981YMAB6P7I
define('PAYPAL_ADS_TEST', 	"P-95T250557E8918524L7TT3AA");//test

define('PAYPAL_COVER_PIC_PER_WEEK_PLAN_ID', "P-2N19376019288693FMAB6MGA");//Per Week Cover Picture Plan
define('PAYPAL_COVER_PIC_TWO_WEEK_PLAN_ID', "P-4XC57865DE037205MMAB6MZQ");//two Week Cover Picture Plan
define('PAYPAL_ONE_DAY_TEST', "P-2XC25683YJ0886306L7TT36A");//test

 





define('PAYPAL_QUARTERLY_PLAN_KEY', 	"P-2GU007753D229953TL7PR24A");
define('PAYPAL_BI_ANNUAL_PLAN_KEY', 	"P-2GU007753D229953TL7PR24A");
define('PAYPAL_ANNUAL_PLAN_KEY', 	    "P-2GU007753D229953TL7PR24A");
define('PAYPAL_DAILY_PLAN_KEY', 	    "P-2GU007753D229953TL7PR24A");