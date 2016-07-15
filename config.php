<?php
define('SISTEMA', 'Armoni House');
define('VERSION', 'v 1.0');
define('ALIAS', '');
define('AUTOR', 'Hugo Luis Santiago Altamirano');
define('EMAIL', 'hugooluisss@gmail.com');
define('EMAILSOPORTE', 'hugooluisss@gmail.com');
define('STATUS', 'En desarrollo');

define('LAYOUT_DEFECTO', 'layout/default.tpl');
define('LAYOUT_AJAX', 'layout/update.tpl');

#Login y su controlador
$conf['inicio'] = array(
	'descripcion' => '',
	'seguridad' => false,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('login.js'),
	'capa' => 'layout/login.tpl');

$conf['logout'] = array(
	'controlador' => 'login.php',
	#'vista' => 'usuarios/panel.tpl',
	'descripcion' => 'Salir del sistema',
	'seguridad' => false,
	'js' => array(),
	'capa' => LAYOUT_DEFECTO);
	
$conf['clogin'] = array(
	'controlador' => 'login.php',
	'descripcion' => 'Inicio de sesion',
	'seguridad' => false,
	'capa' => LAYOUT_AJAX);
	
$conf['bienvenida'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/bienvenida.tpl',
	'descripcion' => 'Bienvenida al sistema',
	'seguridad' => true,
	'capa' => LAYOUT_DEFECTO);

$conf['admonUsuarios'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/panel.tpl',
	'descripcion' => 'Administración de usuarios',
	'seguridad' => true,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('usuarios.js'),
	'capa' => LAYOUT_DEFECTO);

$conf['listaUsuarios'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/lista.tpl',
	'descripcion' => 'Lista de usuarios',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['cusuarios'] = array(
	'controlador' => 'usuarios.php',
	'descripcion' => 'Controlador de usuarios',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/*Datos de usuario desde el panel*/
$conf['usuarioDatosPersonales'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/datosPersonales.tpl',
	'descripcion' => 'Cambiar datos personales',
	'seguridad' => true,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('datosUsuario.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['admonUsuarios'] = array(
	'controlador' => 'usuarios.php',
	'vista' => 'usuarios/panel.tpl',
	'descripcion' => 'Administración de usuarios',
	'seguridad' => true,
	'js' => array('usuario.class.js'),
	'jsTemplate' => array('usuarios.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['panelPrincipal'] = array(
	#'controlador' => 'index.php',
	'vista' => 'inicio.tpl',
	'descripcion' => 'Vista del panel',
	'seguridad' => true,
	'js' => array(),
	'capa' => LAYOUT_DEFECTO);
	
#Configuracion
$conf['configuracion'] = array(
	'controlador' => 'configuracion.php',
	'vista' => 'configuracion.tpl',
	'descripcion' => 'Configuración del sistema',
	'seguridad' => true,
	'jsTemplate' => array('configuracion.js'),
	'capa' => LAYOUT_DEFECTO);
	
$conf['cconfiguracion'] = array(
	'controlador' => 'configuracion.php',
	'descripcion' => 'Controlador de configuración del sistema',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
/* Clientes */
$conf['clientes'] = array(
	'controlador' => 'clientes.php',
	'vista' => 'clientes/panel.tpl',
	'descripcion' => 'Administración de las cuentas de clientes',
	'seguridad' => true,
	'js' => array('cliente.class.js'),
	'jsTemplate' => array('clientes.js'),
	'capa' => LAYOUT_DEFECTO);

$conf['listaClientes'] = array(
	'controlador' => 'clientes.php',
	'vista' => 'clientes/lista.tpl',
	'descripcion' => 'Lista de clientes',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['cclientes'] = array(
	'controlador' => 'clientes.php',
	'descripcion' => 'Controlador de clientes',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['listaSuscripciones'] = array(
	'controlador' => 'clientes.php',
	'vista' => 'clientes/listaSuscripciones.tpl',
	'descripcion' => 'Lista de suscripciones',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['listaClienteMomentos'] = array(
	'controlador' => 'clientes.php',
	'vista' => 'clientes/listaMomentos.tpl',
	'descripcion' => 'Lista de momentos de registro de datos del cliente',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
#Alimentos	
$conf['alimentos'] = array(
	'controlador' => 'alimentos.php',
	'vista' => 'alimentos/panel.tpl',
	'descripcion' => 'Administración de alimentos',
	'seguridad' => true,
	'js' => array('alimento.class.js'),
	'jsTemplate' => array('alimentos.js'),
	'capa' => LAYOUT_DEFECTO);

$conf['listaAlimentos'] = array(
	'controlador' => 'alimentos.php',
	'vista' => 'alimentos/lista.tpl',
	'descripcion' => 'Lista de alimentos',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
	
$conf['calimentos'] = array(
	'controlador' => 'alimentos.php',
	'descripcion' => 'Controlador de alimentos',
	'seguridad' => true,
	'capa' => LAYOUT_AJAX);
?>