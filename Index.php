<?php

// Iniciamos sesión
session_start();
require "Conexion.php";
require "Logica.php";

// Capturamos la acción
$accion = $_GET['page'] ?? 'login';


switch ($accion) {

    case 'login':

        include 'login.php';

    break;


    case 'validar':

        // Recibimos los datos del formulario
        $usuario = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validamos credenciales
        if ($usuario === 'admin@gmail.com' && $password === '1234') {

            $_SESSION['usuario'] = $usuario;

            // Redirección al dashboard
            header("Location: Index.php?page=dashboard");
            exit();

        } else {

            // Si falla vuelve al login
            header("Location: Index.php?page=login&error=1");
            exit();

        }

    break;


    case 'dashboard':

        // Protección de sesión
        if (!isset($_SESSION['usuario'])) {

            header("Location: Index.php?page=login");
            exit();

        }

        include 'Prin.php';

    break;


    case 'detalle':

        // Protección de sesión
        if (!isset($_SESSION['usuario'])) {

            header("Location: Index.php?page=login");
            exit();

        }

        include 'Det.php';

    break;


    case 'reportes':

        // Protección de sesión
        if (!isset($_SESSION['usuario'])) {

            header("Location: Index.php?page=login");
            exit();

        }

        include 'Reportes.php';

    break;


    case 'logout':

        session_destroy();

        header("Location: Index.php?page=login");
        exit();

    break;


    default:

        include 'login.php'; 

    break;
}

?>