<?php 
$db['db_host'] = 'localhost';
$db['db_user']='root';
$db['db_pass']='';
$db['db_name']='cms';

foreach($db as $key => $value){
    //Запись константы в окружение
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// if($connection){
//     echo "Connect okay";
// } else {
//     echo "Shit happens";
// }

?>