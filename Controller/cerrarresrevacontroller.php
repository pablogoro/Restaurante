<?php
REQUIRE_ONCE "../Model/reservamesa.php";
try {
    ReservaMesa::delete($_POST['idM']);
    echo "ok";
}catch (Exception $e){

}
