<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

//change to upper case
foreach ($db as $key => $value) {
	define(strtoupper($key), $value);

}
//function to connect to the data_base
$connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

/*if($connection){
	echo "We are connected";
}*/

?>