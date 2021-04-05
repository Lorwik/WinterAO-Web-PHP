<?php

require_once("../../../util/Database.php");

function acreditarGemas($email, $gemas, $orderData) {
    try {
        $query = Database::connect()->prepare("UPDATE `account` SET `gemas` = `gemas` + $gemas WHERE `email` = :email");
        $query->execute(['email' => $email]);
  
        // Si devuelve algo, todo bien!
        if ($query->rowCount() > 0) {
          $_SESSION['gemas'] += $gemas;
        }

        return true;
      
    } catch (Exception $ex) {
        Log::paymentError($ex, $orderData);

        return false;
    }
}


function registrarCompra($id_cuenta, $producto, $cantidad, $precio, $orderData) {
    try {
        $query = Database::connect()->prepare("INSERT INTO compras (id_cuenta, producto, cantidad, precio) VALUES (:id_cuenta, :producto, :cantidad, :precio)");
        
        $query->execute([
            "id_cuenta" => $id_cuenta,
            "producto" => $producto,
            "cantidad" => $cantidad,
            "precio" => $precio,
        ]);  

        return true;
      
    } catch (Exception $ex) {
        Log::paymentError($ex, $orderData);

        return false;
    }

}