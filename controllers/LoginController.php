<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function index(Router $router){
        if(!isset($_SESSION['auth_user'])){
            $router->render('login/index', []);
        }else{
            header('Location: /datetable/menu');
        }
    }
    public static function menu(Router $router){
        if(isset($_SESSION['auth_user'])){
            $router->render('menu/index', []);
        }else{
            header('Location: /datetable/');
        }
    }
    public static function loginAPI(){

        $catalogo = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($_POST['usu_password'], FILTER_DEFAULT);
        $usuarioRegistrado = Usuario::fetchFirst("SELECT * from usuario where usu_catalogo = $catalogo");

        try {      
            if(is_array($usuarioRegistrado)){
                $verificacion = password_verify($password, $usuarioRegistrado['usu_password']);
                $nombre = $usuarioRegistrado['usu_nombre'];
                if($verificacion){
                    session_start();
                    $_SESSION['auth_user'] = $catalogo;

                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => "Sesión iniciada correctamente. Bienvenido $nombre"
                    ]);
                }else{
                    echo json_encode([
                        'codigo' => 2,
                        'mensaje' => 'Contraseña incorrecta'
                    ]);
                }
            }else{
                echo json_encode([
                    'codigo' => 2,
                    'mensaje' => 'Usuario no encontrado'
                ]);
    
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'codigo' => 0,
                'mensaje' => 'Usuario no encontrado'
            ]);
        }


    }

    public static function logout(){
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location: /datetable/');
    }

}