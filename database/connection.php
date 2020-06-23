<?php
try{
    $connection=new PDO('mysql:host=localhost;dbname=php_basic_code','root', '');
}catch(Exception $e){
    echo 'Something went error !';
}
?>