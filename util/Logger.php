<?php

class Log {

    public static function databaseError($exception, $pdoInstance = null) {
        $content = "\r\n" . "Error - Base de Datos" . "\r\n";
        $content .= "Numero: " . $exception->getCode() . "\r\n";
        $content .= "Descripción: " . $exception->getMessage() . "\r\n";
        $content .= "Trace: " . "\r\n" . $exception->getTraceAsString() . "\r\n";
        
        // Mas info. relacionada con el PDO
        if ($pdoInstance) {
            $content .= "Query: " . $pdoInstance->debugDumpParams();
        }

        file_put_contents(__DIR__ . "/Logs/DatabaseError.log", $content, FILE_APPEND | LOCK_EX);
    }

    public static function paymentError($ex, $orderData) {
        $content = "\r\nError al acreditar gemas a la cuenta: " . $orderData->result->purchase_units[0]->reference_id;
        $content .= "\r\nUbicacion: GetOrder.php?orderID=" . $orderData->result->purchase_units[0]->custom_id;
        $content .= "\r\nDetalles del error: "  . $ex->getMessage();
        $content .= "\r\nEstado de la orden: " . $orderData->result->status;
        $content .= "\r\nDetalles de la orden: " . json_encode($orderData, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/Logs/PaypalErrors.log", $content, FILE_APPEND | LOCK_EX);
    }

}