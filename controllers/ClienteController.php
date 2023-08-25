<?php

namespace Controllers;
use Exception;
use Model\Cliente;
use MVC\Router;

class ClienteController{
    public static function index(Router $router) {
              
    if(isset($_SESSION['auth_user'])){
        $router->render('clientes/index', []);
    }else{
        header('Location: /datetable/');
    }
       
    }


    public static function guardarApi(){
     
        try {
            $cliente = new Cliente($_POST);
            $resultado = $cliente->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

   
    public static function buscarApi()
    {
        // $cliente = Cliente::all();
        $cliente_nombre = $_GET['cliente_nombre'];
        $cliente_nit = $_GET['cliente_nit'];
       

        $sql = "SELECT * FROM clientes where cliente_situacion = 1 ";
        if ($cliente_nombre != '') {
            $sql .= " and LOWER(cliente_nombre) like LOWER ('%$cliente_nombre%') ";
        }

        if ($cliente_nit != '') {
            $sql .= " and LOWER (cliente_nit) like LOWER ('%$cliente_nit%') ";
        }
        
        
        try {
            
            $cliente = Cliente::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($cliente);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarApi(){
     
        try {
            $cliente = new Cliente($_POST);
            // $resultado = $arma->crear();

            $resultado = $cliente -> actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function eliminarApi(){
     
        try {
            $cliente_id = $_POST['cliente_id'];
            $cliente=  Cliente::find($cliente_id);
            $cliente ->cliente_situacion = 0;
            $resultado = $cliente ->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

}
 
?>