<?php

/* Fichier de traduction (espagnol) *

Le texte à été repris tel quel du fichier originalement compilé par Opikanoba (opikanoba.info)
et Campanilla (campanilla.info) en 2007.

NOTE: Voir `en.php` pour les notes sur la migration 

*/

return [
/*
	// Login
	$l_login_button = "Acceder";
	$l_login_l1 = "Introduce tu clave para acceder";
	$l_login_l2 = "Clave correcta.";
	$l_login_l3 = "Haz click aqu&iacute; para ir a tus listas.";
	$l_login_l4 = "Clave incorrecta.";
	$l_login_l5 = "Acceso identificado desactivado. Esto no es seguro, por favor cambialo si estas en un servidor p&uacute;blico.";
*/
	// Navigation
	'navigation' => [
		'today' => "Hoy",
		'home' => "Inicio",
		'allItems' => "Todos",
		'context' => "Por contexto",
		'project' => "Por proyecto",
		'settings' => "Configuraci&oacute,n",
		'help' => "Ayuda",
		'logout' => "Salir",
	],

	// Sidebar
	'sidebar' => [
		'add' => "A&ntilde;adir",
	],

	// Sections
	'sections' => [
		'ideas' => "Ideas",
		'tobuy' => "Quiero comprar",
		'immediate' => "Inmediatamente",
		'week' => "Esta semana",
		'month' => "Este mes",
		'year' => "Este a&ntilde;o",
		'lifetime' => "Quiz&aacute; alg&uacute;n d&iacute;a",
	],

	// Front page
	'index' => [
		'welcome' => "Bienvenido a TaskStep",
		'tip' => "Nota",
		'noImmediate' => "No tienes nada por hacer ahora mismo, &iexcl;<a href='edit.php'>a&ntilde;ade algo</a>!",
		'introMorning' => "Buenos d&iacute;as",
		'introAfternoon' => "Buenas tardes",
		'introEvening' => "Buenas noches",
		'introText' => ", y bienvenido a TaskStep. TaskStep ha sido dise&ntilde;ado para ayudarte en tus tareas del d&iacute;a a d&iacute;a, a largo plazo y en general tus listas de tareas , vagamente organizadas al estilo <a href='http://www.davidco.com/'>GTD</a> con contextos y proyectos.</p> <p>Para aquellos que no esten familiarizados con la idea, cualquier cosa que requiera m&aacute;s de un acci&oacute;n o paso es considerado un proyecto. Un contexto es donde se va a realizar la acci&oacute;n, por ejemplo, en tu ordenador.</p><p><b><img src='images/exclamation.png' alt='' /> Esto es una versi&oacute;n beta y pude tener comportamientos impredecibles. Por ahora, es recomendable que uses la <a href='http://enes.explicatus.org/wiki/CamelCase'>NotacionDeCamello</a> para evitar fallos con los espacios en los proyectos y contextos, de todas formas los espacios deber&iacute;an funcionar.</b></p>",
		'oneTask' => "Tienes una tarea por hacer.",
		'nTasks' => "Tienes %d tareas por hacer.",
	],

	// Items
	'items' => [
		'do' => "Marcar como hecho",
		'undo' => "Marcar como no hecho",
		'edit' => "Editar",
		'del' => "Borrar",
		'print' => "Imprimir listado (3 x 5 Index card)",
		'sort' => [
			'title' => "Titulo",
			'date' => "Fecha",
			'context' => "Contexto",
			'project' => "Proyecto",
			'done' => "Hecho"
		],
		'sorttext' => "Ordenar por:",
		'sortbutton' => "Ordenar",
		'defaultTitle' => "Titulo de la tarea o acci&oacute;n",
	],

	// "Display by" pages
	'context' => [
		'chooseToList' => "Filtrar por contexto. Opcionalmente, a&ntilde;adir uno nuevo.",
		'chooseToEdit' => "Selecciona un contexto para editarlo o a&ntilde;ade uno nuevo.",
		'add' => "A&ntilde;adir contexto",
		'edit' => "Editar contexto",
		'delete' => "Borrar contexto",
		'defaultTitle' => "Mi Nuevo Contexto",
	],
	'project' => [
		'chooseToList' => "Filtrar por proyecto. Opcionalmente, a&ntilde;adir uno nuevo.",
		'chooseToEdit' => "Selecciona un poyecto para editarlo o a&ntilde;ade uno nuevo.",
		'add' => "A&ntilde;adir proyecto",
		'edit' => "Editar proyecto",
		'delete' => "Borrar proyecto",
		'defaultTitle' => "Mi Nuevo Proyecto",
	],

	//Forms (add, edit etc.)
	'forms' => [
		'title' => "T&iacute;tulo",
		'notes' => "Notas",
		'section' => "Secci&oacute;n",
		'context' => "Contexto",
		'project' => "Proyecto",
		'editContexts' => "Editar contextos",
		'editProjects' => "Editar proyectos",
		'date' => "Fecha prevista:",
		'url' => "Url",
		'addButton' => "A&ntilde;adir",
		'editButton' => "Editar",
	],

	// Messages
	'message' => [
		'noItems' => "No hay nada en esta secci&oacute;n",
		'addSome' => "&iexcl;a&ntilde;ade algo!",
		'noneToday' => "No hay nada hoy. Es posible que no tengas nada que hacer, o quiz&aacute; quieras",
		'actionError' => "Comando o acci&oacute;n inv&aacute;lida",
		'unspecific' => "Es imprescindible especificar un contexto, proyecto y secci&oacute;n.",
		'noId' => "Error en la URL. Deberia haber una id especificada.",
    	'exportedTo' => "Exportado a",
    	'item' => [
			'updated' => "Actualizado correctamente",
			'added' => "A&ntilde;adido correctamente",
			'deleted' => "Borrado correctamente",
			'done' => "Marcado como hecho",
			'undone' => "Marcado como no hecho",
		],
		'context' => [
			'updated' => "Contexto actualizado",
			'added' => "Contexto a&ntilde;adido",
			'deleted' => "Contexto borrado",
		],
		'project' => [
			'updated' => "Proyecto actualizado",
			'added' => "Proyecto a&ntilde;adido",
			'deleted' => "Proyecto borrado",
		],
	],
/*
	//Settings
	$l_cp_bookmarklettext = "Arrastra la imagen a tus favoritos para a&ntilde;adirla a tus marcadores";
	$l_cp_bookmarklet = "A&ntilde;adir a TaskStep";
	$l_cp_display_title = "T&iacute;tulo";
	$l_cp_display_tips = "Mostrar notas en la p&aacute;gina principal";
	$l_cp_display_css = "Hoja de estilo";
	$l_cp_display_nocss = "Ninguna";
	$l_cp_display_button = "Guardar cambios";
	$l_cp_display_settingsupdated = "Cambios guardados";
	$l_cp_display_tipson = "Mostrar notas";
	$l_cp_display_tipsoff = "No mostrar notas";
	$l_cp_display_defaultcss = "Hoja de estilo por defecto elegida";

	$l_cp_password_title = "Clave";
	$l_cp_password_current = "Clave actual";
	$l_cp_password_new1 = "Nueva clave";
	$l_cp_password_new2 = "Confirma la nueva clave";
	$l_cp_password_use = "Usar clave y sesiones (Recomendado)";
	$l_cp_password_fieldss = "Campos marcados con";
	$l_cp_password_fieldse = "son obligatorios.";
	$l_cp_password_button = "Cambiar clave";
	$l_cp_password_incorrect = "Clave incorrecta";
	$l_cp_password_nomatch = "Las claves no coinciden";
	$l_cp_password_updated = "Clave modificada con &eacute;xito";

	$l_cp_tools_title = "Herramientas";
	$l_cp_tools_purge = "Borrar las tareas terminadas";
	$l_cp_tools_update = "Ejecutar archivo de actualizaci&oacute;n";
	$l_cp_tools_export = "Exportar todo a archivo  <acronym title=\"Comma Separated Values\">CSV</acronym>";
		//NB The HTML for the acronym has been included for the sake of completeness, but make sure you leave the slashes before the quotes or TaskStep will break!
	$l_cp_tools_purged = " Borradas.";
	$l_cp_tools_purgecheck = "&iquest;Estas seguro de que quieres borrar todas las tareas finalizadas?";

	//Insert updated parts after this point
	//--1/4/07--

	//--28/8/07--
    $l_print_commontitle = "Imprimir";
    $l_print_printalltasks = "Tareas";
    $l_print_printtoday = "Hoy";
    $l_print_sectionnotfound = "Secci&oacute;n no encontrado!";
	//Insert updated parts before this point
*/
    'tips' => ['...'],
];