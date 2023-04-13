<?php

/* Fichier de traduction (russe) *

Le texte à été repris tel quel du fichier originalement compilé par Cord en 2007.

NOTE: Voir `en.php` pour les notes sur la migration 

*/

return [
/*
	// Login
	$l_login_button = "Войти";
	$l_login_l1 = "Пожалуйста, введите пароль.";
	$l_login_l2 = "Пароль принят.";
	$l_login_l3 = "Нажмите сюда для перехода к списку задач.";
	$l_login_l4 = "Неверный пароль.";
	$l_login_l5 = "Защита паролем была отключена. Это небезопасно, поэтому, если TaskStep размещен на публичном сервере, то активизируйте защиту.";
*/
	// Navigation
	'navigation' => [
		'today' => "Сегодня",
		'home' => "Главная",
		'allItems' => "Все задачи",
		'context' => "Разделы",
		'project' => "Проекты",
		'settings' => "Настройки",
		'help' => "Помощь",
		'logout' => "Выйти",
	],

	// Sidebar
	'sidebar' => [
		'add' => "Новая задача",
	],

	// Sections
	'sections' => [
		'ideas' => "Идеи",
		'tobuy' => "Покупки",
		'immediate' => "Неотложное",
		'week' => "На этой неделе",
		'month' => "В этом месяце",
		'year' => "В этом году",
		'lifetime' => "Когда-нибудь",
	],

	// Front page
	'index' => [
		'welcome' => "Добро пожаловать в TaskStep",
		'tip' => "Совет",
		'noImmediate' => "Неотложных задач нет! <a href='edit.php'>Новая задача</a>.",
		'introMorning' => "Доброе утро",
		'introAfternoon' => "Добрый день",
		'introEvening' => "Добрый вечер",
		'introText' => "! Вы находитесь в TaskStep. TaskStep создан для того,
		    чтобы помогать вам работать с каждодневными задачами, долгосрочными целями
		    и управлять вашим временем. TaskStep размещает информацию в <a href='http://www.davidco.com/'>GTD-стиле</a>,
		    разбивая ее на разделы и проекты.</p>
		    <p>Под проектом следует понимать все, что требует больше одного действия либо шага.</p>",
		'oneTask' => "Осталась одна задача.",
		'nTasks' => "Осталось задач: %d."
	],

	// Items
	'items' => [
		'do' => "Пометить как сделанную",
		'undo' => "Пометить как несделанную",
		'edit' => "Изменить",
		'delete' => "Удалить",
		'print' => "Распечатать список 3 x 5",
		'sort' => [
			'title' => "Названию",
			'date' => "Дате",
			'context' => "Разделу",
			'project' => "Проекту",
			'done' => "Статусу"
		],
		'sortText' => "Сортировать по:",
		'sortButton' => "Отсортировать",
	],

	// "Display by" pages
	'context' => [
		'chooseToList' => "Выберите раздел, чтобы вывести все задачи, размещенные в нем. Либо добавьте новый раздел.",
		'chooseToEdit' => "Выберите раздел для изменения. Либо добавьте новый раздел.",
		'add' => "Добавить раздел",
		'edit' => "Изменить раздел",
		'delete' => "Удалить раздел",
		'defaultName' => "НовыйРаздел",
	],
	'project' => [
		'chooseToList' => "Выберите проект, чтобы вывести все задачи, размещенные в нем. Либо добавьте новый проект.",
		'chooseToEdit' => "Выберите проект для изменения. Либо добавьте новый проект.",
		'add' => "Добавить проект",
		'edit' => "Изменить проект",
		'delete' => "Удалить проект",
		'defaultName' => "НовыйПроект",
	],
/*
	//Forms (add, edit etc.)
	$l_forms_title = "Название",
	$l_forms_notes = "Замечания";
	$l_forms_section = "Категория";
	$l_forms_context = "Раздел";
	$l_forms_project = "Проект";
	$l_forms_contexte = "Управление разделами";
	$l_forms_projecte = "Управление проектами";
	$l_forms_date = "Дедлайн";
	$l_forms_url = "URL";
	$l_forms_button['add'] = "Добавить задачу";
	$l_forms_button['edit'] = "Изменить задачу";
*/
	// Messages
	'message' => [
		'noItems' => "В этой категории нет задач!",
		'addSome' => "Новая задача!",
		'noneToday' => "На сегодня задач нет! Либо ничего делать не нужно, либо вам следует",
		'actionError' => "Неверная команда или действия",
		'unspecific' => "Извините, но вам нужно нужно указать категорию, раздел и проект.",
		'noId' => "Извините, но в URL имеет ошибка. Параметр id должен быть определен.",
		'exportedTo' => "Экспортировано в",
		'item' => [
			'updated' => "Задача обновлена!",
			'added' => "Задача добавлена!",
			'deleted' => "Задача удалена!",
			'done' => "Помечена как выполненная",
			'undone' => "Помечена как невыполненная",
		],
		'context' => [
			'updated' => "Раздел обновлен",
			'added' => "Раздел добавлен",
			'deleted' => "Раздел удален",
		],
		'project' => [
			'updated' => "Проект обновлен",
			'added' => "Проект добавлен",
			'deleted' => "Проект удален.",
		]
	],
/*
	//Settings
	$l_cp_bookmarklettext = "Перетащите изображение, размещенное ниже, для создания закладки.";
	$l_cp_bookmarklet = "Добавить в TaskStep";
	$l_cp_display_title = "Интерфейс";
	$l_cp_display_tips = "Отображать советы на главной странице";
	$l_cp_display_css = "стили";
	$l_cp_display_nocss = "Нет";
	$l_cp_display_button = "Обновить настройки";
	$l_cp_display_settingsupdated = "Настройки обновлены";
	$l_cp_display_tipson = "Советы отображаются";
	$l_cp_display_tipsoff = "Советы не отображаются";
	$l_cp_display_defaultcss = "Стиль по умолчанию выбран";

	$l_cp_password_title = "Пароль";
	$l_cp_password_current = "Текущий пароль";
	$l_cp_password_new1 = "Новый пароль";
	$l_cp_password_new2 = "Повторите новый пароль";
	$l_cp_password_use = "Использовать пароли и сессии (рекомендуется)";
	$l_cp_password_fieldss = "Поля, помеченныые";
	$l_cp_password_fieldse = ", являются обязательными.";
	$l_cp_password_button = "Обновить пароль";
	$l_cp_password_incorrect = "Неверный пароль!";
	$l_cp_password_nomatch = "Пароли не совпадают!";
	$l_cp_password_updated = "Обновление прошло успешно!";

	$l_cp_tools_title = "Сервис";
	$l_cp_tools_purge = "Удалить все выполненые задачи";
	$l_cp_tools_update = "Выполнить файл обновления";
	$l_cp_tools_export = "Экспортировать в <acronym title=\"Comma Separated Values\">CSV</acronym>";
		//NB The HTML for the acronym has been included for the sake of completeness, but make sure you leave the slashes before the quotes or TaskStep will break!
	$l_cp_tools_purged = " задач(а, и) удалено.";
	$l_cp_tools_purgecheck = "Вы уверены, что вы хотите удалить все выполненные задачи?";

	//Insert updated parts after this point
	//--1/4/07--

    //--28/8/07--
    $l_forms_titledefval = "Название задачи или шага";
    $l_print_commontitle = "Печать";
    $l_print_printalltasks = "Задачи";
    $l_print_printtoday = "Сегодня";
    $l_print_sectionnotfound = "Категория не найдена!";
	//Insert updated parts before this point
*/
    'tips' => [
    	'Кликните на дату для вывода задач на сегодня.',
    	'Все маленькие иконки с сайта <a href="http://www.famfamfam.com">famfamfam.com</a>.',
    	'Вы можете вывести все задачи по проекту или по разделу целиком - воспользуйтесь для этого главным меню. ',
		'Не используйте на публичном сервере. ',
		'Вы можете печатать не только на карточках 3x5, используйте функцию печати браузера.',
		'Проблемы? Смотрите помощь.',
		'Нажмите на главной странице (вы на ней) на список неотложных задач для изменений.',
		'Кликните по полю во время ввода для вывода календаря.',
		'Календарь с сайта <a href="http://www.garrett.nildram.co.uk/calendar/jacs.htm">Anthony Garrett</a>.'
    ],
];