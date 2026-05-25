<?php

session_start();

require_once __DIR__ . '/AuthController.php';
require_once __DIR__ . '/../models/Auditoria.php';

AuthController::verificarSesion();

/*
|--------------------------------------------------------------------------
| Obtener registros de auditoría
|--------------------------------------------------------------------------
*/

$auditoriaModel = new Auditoria();
$registros = $auditoriaModel->obtenerTodos();

/*
|--------------------------------------------------------------------------
| Cargar vista
|--------------------------------------------------------------------------
*/

include __DIR__ . '/../views/auditoria/index.php';
?>