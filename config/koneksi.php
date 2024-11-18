<?php
// 
// 

$server = "localhost";
$dbuser = "root";
$dbpass = '';


$dbname = "universitas_brawijaya";

//connection 
$koneksi = mysqli_connect($server,$dbuser,$dbpass,$dbname);

if (mysqli_connect_errno()){
        echo "Failed connected to MySQL :".mysqli_connect_error();
                exit();
}else{
        echo"Connected to MySQL" .PHP_EOL       ;        
}

