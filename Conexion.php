<?php

    class Conexion {

        static $pDO = null; 

        static public function getConexion() {
            
            if (!Conexion::$pDO) {
                Conexion::$pDO = self::nuevaConexion();
            }   
            return Conexion::$pDO;
        }

        static function nuevaConexion() {
            $host = 'localhost'; // Normalmente "localhost"
            $dbname = 'Sistema_Gestion_Pedidos';
            $dbport = 5432;
            $usuario = 'postgres';
            $password = 'postgres';
    
            $pDO = new PDO("pgsql:host=$host;dbname=$dbname;port=$dbport", $usuario, $password);
    
            if ($pDO) {
                echo ('Conexion exitosa'.PHP_EOL);
            } else {
                echo ('Error en Conexion'.PHP_EOL);
            }
    
            return $pDO;
        }

        /**
         * Recibe un sql de consulta y devuelve un arreglo de objetos
         */
        static function query($sql) {
            $pDO = self::getConexion();
            $statement = $pDO->query($sql, PDO::FETCH_OBJ);
            $resultado = $statement->fetchAll();
            return $resultado;
        }

        /**
         * Recibe un sql de ejecutcion
         */
        static function ejecutar($sql) {
            $pDO = self::getConexion();
            $pDO->query($sql);
        }

        static function getLastId() {
            $pDO = self::getConexion();
            $lastId = $pDO->lastInsertId();
            
            return $lastId;
        }

    }