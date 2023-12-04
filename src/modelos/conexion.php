<?php

class conexion
{
    private static $conexion;

    private function __construct()
    {
        // Constructor privado para evitar instanciación directa
    }

    public static function conectar()
    {
        $nombreServidor = "localhost";
        $baseDatos = "personalfinance";
        $usuario = "root";
        $password = "";

        if (!isset(self::$conexion)) {
            try {
                self::$conexion = new PDO('mysql:host=' . $nombreServidor . ';dbname=' . $baseDatos . ';', $usuario, $password);
                self::$conexion->exec("set names utf8");
            } catch (Exception $e) {
                self::$conexion = $e;
            }
        }

        return self::$conexion;
    }

    public static function inTransaction()
    {
        // Verificar si hay una transacción activa
        return self::$conexion instanceof PDO && self::$conexion->inTransaction();
    }

    public static function beginTransaction()
    {
        // Iniciar la transacción si la conexión existe y no hay una transacción activa
        if (self::$conexion instanceof PDO && !self::$conexion->inTransaction()) {
            return self::$conexion->beginTransaction();
        }

        return false;
    }
}

