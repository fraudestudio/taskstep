<?php

/* Fichier de traduction (allemand) *

Le texte à été repris tel quel du fichier originalement compilé par Thomas Hooge en 2019.

NOTE: Voir `en.php` pour les notes sur la migration 

*/

return [
/*

	// Login
	$l_login_button = "Login";
	$l_login_l1 = "Bitte geben Sie Ihr Kennwort ein, um sich anzumelden";
	$l_login_l2 = "Kennwort akzeptiert.";
	$l_login_l3 = "Klicken Sie hier, um zu Ihren Listen zu gelangen.";
	$l_login_l4 = "Falsches Kennwort.";
	$l_login_l5 = "Kennwort wurde deaktiviert. Dies ist nicht sehr sicher. Bitte ändern Sie die Einstellung, wenn Sie TaskStep auf einem öffentlichen Server verwenden.";
*/
	// Navigation
	'navigation' => [
		'today' => "Heute",
		'home' => "Home",
		'allItems' => "Alle Aufgaben",
		'context' => "Nach Kontext",
		'project' => "Nach Projekt",
		'settings' => "Einstellungen",
		'help' => "Hilfe",
		'logout' => "Abmelden",
	],

	// Sidebar
	'sidebar' => [
		'add' => "Aufgabe hinzufügen",
	],

	// Sections
	'sections' => [
		'ideas' => "Ideen",
		'tobuy' => "Wunschliste",
		'immediate' => "Sofort",
		'week' => "Diese Woche",
		'month' => "Diesen Monat",
		'year' => "Dieses Jahr",
		'lifetime' => "Irgendwann vielleicht"
	],

	// Front page
	'index' => [
		'welcome' => "Willkommen bei TaskStep",
		'tip' => "Tip",
		'noImmediate' => "Keine unmittelbaren Dinge mehr zu tun! <a href='edit.php'>Aufgabe hinzufügen</a>!",
		'introMorning' => "Guten Morgen",
		'introAfternoon' => "Guten Tag",
		'introEvening' => "Guten Abend",
		'introText' => " und wilkommen bei TaskStep. "
			. "TaskStep wurde entwickelt, um Sie bei alltäglichen Aufgaben, langfristigen Zielen und allgemeinen Listen zu unterstützen und diese grob GTD-artig mit Kontexten und Projekten zu organisieren. "
			. "Für diejenigen von Ihnen, die mit dem Konzept nicht vertraut sind, ist alles, was mehr als eine Aktion oder einen Schritt erfordert, ein Projekt. "
			. "In einem Kontext führen Sie Tätigkeiten beispielsweise an Ihrem Computer aus.",
		'oneTask' => "Derzeit ist noch eine Aufgabe zu erledigen.",
		'nTasks' => "Derzeit gibt es %d Aufgaben zu erledigen.",
	],	

	// Items
	'items' => [
		'do' => "Markiere als erledigt",
		'undo' => "Markiere als unerledigt",
		'edit' => "Aufgabe Bearbeiten",
		'delete' => "Löschen",
		'print' => "Drucke Liste (3 x 5 Indexkarten)",
		'sort' => [
			'title' => "Titel",
			'date' => "Datum",
			'context' => "Kontext",
			'project' => "Projekt",
			'done' => "Erledigt"
		],
		'sortText' => "Sortiere Aufgaben nach:",
		'sortButton' => "Sortiere",
	],

	// "Display by" pages
	'context' => [
		'chooseToList' => "Wählen Sie einen Kontext aus, in dem die Elemente aufgelistet werden sollen. Alternativ können Sie einen neuen Kontext hinzufügen.",
		'chooseToEdit' => "Wählen Sie einen Kontext zum Bearbeiten. Alternativ können Sie einen neuen Kontext hinzufügen.",
		'add' => "Kontext hinzufügen",
		'edit' => "Bearbeite Kontext",
		'delete' => "Lösche Kontext",
		'defaultName' => "Neuer Kontext",
	]
	'project' => [
		'chooseToList' => "Wählen Sie ein Projekt aus, für das die Elemente aufgelistet werden sollen. Alternativ können Sie ein neues Projekt hinzufügen.",
		'chooseToEdit' => "Wählen Sie ein Projekt zum Bearbeiten. Alternativ können Sie ein neues Projekt hinzufügen.",
		'add' => "Projekt hinzufügen",
		'edit' => "Bearbeite Projekt",
		'delete' => "Lösche Projekt",
		'defaultName' => "NeuesProjekt",
	],
/*
	//Forms (add, edit etc.)
	$l_forms_title = "Titel";
	$l_forms_notes = "Bemerkungen";
	$l_forms_section = "Abschnitt";
	$l_forms_context = "Kontext";
	$l_forms_project = "Projekt";
	$l_forms_contexte = "Bearbeite Kontexte";
	$l_forms_projecte = "Bearbeite Projekte";
	$l_forms_date = "Fälligkeitsdatum";
	$l_forms_url = "Url";
	$l_forms_button['add'] = "Aufgabe hinzufügen";
	$l_forms_button['edit'] = "Aufgabe bearbeiten";
*/
	// Messages
	'message' => [
		'noItems' => "Keine Einträge in diesem Abschnitt!",
		'addSome' => "Füge einen hinzu!",
		'noneToday' => "Keine Einträge heute! Entweder ist nichts zu tun oder Sie sollten",
		'actionError' => "Command or action invalid",
		'unspecific' => "Sorry, you need to specify a context, project and section.",
		'noId' => "Entschuldigung, die URL enthält einen Fehler. Es sollte eine ID angegeben werden.",
		'exportedTo' => "Exportiert nach",
		'item' => [
			'updated' => "Aufgabe aktualisiert!",
			'added' => "Aufgabe hinzugefügt!",
			'deleted' => "Aufgabe gelöscht",
			'done' => "Als Erledigt marktiert",
			'undone' => "Als Unerledigt markiert",
		],
		'context' => [
			'updated' => "Kontext aktualisiert",
			'added' => "Kontext hinzugefügt",
			'deleted' => "Kontext gelöscht",
		],
		'project' => [
			'updated' => "Projekt aktualisiert",
			'added' => "Projekt hinzugefügt",
			'deleted' => "Projekt gelöscht",
		],
	],
/*
	//Settings
	$l_cp_bookmarklettext = "Ziehen Sie das Bild unten auf Ihre Lesezeichen, um das Lesezeichen zu erstellen.";
	$l_cp_bookmarklet = "TaskStep Aufgabe";
	$l_cp_display_title = "Darstellung";
	$l_cp_display_tips = "Zeige Tips auf der Titelseite an";
	$l_cp_display_css = "Stylesheet";
	$l_cp_display_nocss = "Kein";
	$l_cp_display_button = "Aktualisiere Einstellungen";
	$l_cp_display_settingsupdated = "Einstellungen aktualisiert";
	$l_cp_display_tipson = "Zeige Tips an";
	$l_cp_display_tipsoff = "Zeige keine Tips an";
	$l_cp_display_defaultcss = "Standard-Stylesheet ausgewählt";

	$l_cp_password_title = "Kennwort";
	$l_cp_password_current = "Aktuelles Kennwort";
	$l_cp_password_new1 = "Neues Kennwort";
	$l_cp_password_new2 = "Kennwortbestätigung";
	$l_cp_password_use = "Kennworte und Sitzungen verwenden (empfohlen)";
	$l_cp_password_fieldss = "Felder markiert mit einem";
	$l_cp_password_fieldse = "sind erforderlich um Änderungen durchzuführen.";
	$l_cp_password_button = "Aktualisiere Kennwort";
	$l_cp_password_incorrect = "Falsches Kennwort!";
	$l_cp_password_nomatch = "Kennworte stimmen nicht überein!";
	$l_cp_password_updated = "Aktualisiert!";

	$l_cp_tools_title = "Werkzeuge";
	$l_cp_tools_purge = "Lösche alle erledigten Einträge";
	$l_cp_tools_update = "Führe Update-Datei aus";
	$l_cp_tools_export = "Exportiere alles in eine <acronym title=\"Comma Separated Values\">CSV</acronym>-Datei";
		//NB The HTML for the acronym has been included for the sake of completeness, but make sure you leave the slashes before the quotes or TaskStep will break!
	$l_cp_tools_purged = " Einträge gelöscht.";
	$l_cp_tools_purgecheck = "Möchten Sie wirklich alle erledigten Einträge löschen??";

	//Insert updated parts after this point
	//--1/4/07--

	//--28/8/07--
	$l_forms_titledefval = "Aufgaben- oder Schritt-Titel";
	$l_print_commontitle = "Druck";
	$l_print_printalltasks = "Aufgaben";
	$l_print_printtoday = "Heute";
	$l_print_sectionnotfound = "Abschnitt nicht gefunden!";
	//Insert updated parts before this point
*/
	'tips' => [
		'Wenn Sie auf das Datum klicken, werden die heute fälligen Aufgaben angezeigt.',
		'Alle kleinen Symbole hier stammen von <a href="http://www.famfamfam.com">famfamfam.com</a>.',
		'Sie können alle Elemente nach Kontext oder Projekt auflisten.',
		'Versuchen Sie dies nicht auf einem öffentlichen Server! Es ist nicht sehr sicher!',
		'Der Druck ist für 3x5-Karteikarten vorgesehen. Sie können jedoch auf A4 drucken, indem Sie in Ihrem Browser auf Datei → Drucken klicken.',
		'Probleme? Probieren Sie doch die Hilfe aus.',
		'Klicken Sie auf dieser Indexseite auf ein Element in der Liste "Sofort", um es zu bearbeiten.',
		'Sie können jetzt das Datum aus einem Kalender auswählen. Klicken Sie einfach in das Datumsfeld, als würden Sie tippen.',
		'Das Kalenderskript ist <a href="http://www.garrett.nildram.co.uk/calendar/jacs.htm"> JACS </a> von Anthony Garrett.',
	],
];