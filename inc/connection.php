<?php 
function dbconnect(){
    static $connect = null ; 
    if ( $connect === null){
        $connect = mysqli_connect('localhost' , 'ETU003930' , 'U10is7A0' , '');
        if (!$connect){
            die('Erreur' . mysqli_connect_error());
        }

        mysqli_set_charset($connect , 'utf8mb4');
    }
    return $connect;
}
?> 