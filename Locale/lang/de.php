<?php

/* Fichier de traduction (allemand) *

Le texte à été repris tel quel du fichier originalement compilé par Thomas Hooge en 2019.

NOTE: Voir `en.php` pour les notes sur la migration 

*/

return [
	// Login
	'login' => [
		'button' => "Login",
		'prompt' => "Bitte geben Sie Ihr Kennwort ein, um sich anzumelden",
		'incorrect' => "Falsches Kennwort.",
		'alreadyLoggedIn' => "Du bist bereits angemeldet! <a href='?action=logout>Melden du sich ab</A> oder fährst du mit der <a href='index.php'>Hauptseite</a> fort.",
	],

	// Navigation
	'navigation' => [
		'today' => "Heute: %s",
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
		'defaultTitle' => "Aufgaben- oder Schritt-Titel",
	],

	// "Display by" pages
	'context' => [
		'chooseToList' => "Wählen Sie einen Kontext aus, in dem die Elemente aufgelistet werden sollen. Alternativ können Sie einen neuen Kontext hinzufügen.",
		'chooseToEdit' => "Wählen Sie einen Kontext zum Bearbeiten. Alternativ können Sie einen neuen Kontext hinzufügen.",
		'add' => "Kontext hinzufügen",
		'edit' => "Bearbeite Kontext",
		'delete' => "Lösche Kontext",
		'defaultTitle' => "Neuer Kontext",
	]
	'project' => [
		'chooseToList' => "Wählen Sie ein Projekt aus, für das die Elemente aufgelistet werden sollen. Alternativ können Sie ein neues Projekt hinzufügen.",
		'chooseToEdit' => "Wählen Sie ein Projekt zum Bearbeiten. Alternativ können Sie ein neues Projekt hinzufügen.",
		'add' => "Projekt hinzufügen",
		'edit' => "Bearbeite Projekt",
		'delete' => "Lösche Projekt",
		'defaultTitle' => "NeuesProjekt",
	],

	//Forms (add, edit etc.)
	'forms' => [
		'title' => "Titel",
		'notes' => "Bemerkungen",
		'section' => "Abschnitt",
		'context' => "Kontext",
		'project' => "Projekt",
		'editContexts' => "Bearbeite Kontexte",
		'editProjects' => "Bearbeite Projekte",
		'date' => "Fälligkeitsdatum",
		'url' => "Url",
		'addButton' => "Aufgabe hinzufügen",
		'editButton' => "Aufgabe bearbeiten",
	],

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

	//Settings
	'settings' => [
		'bookmarklet' => [
			'text' => "Ziehen Sie das Bild unten auf Ihre Lesezeichen, um das Lesezeichen zu erstellen.",
			'link' => "TaskStep Aufgabe",
		],
		'display' => [
			'title' => "Darstellung",
			'tips' => "Zeige Tips auf der Titelseite an",
			'css' => "Stylesheet",
			'noCss' => "Kein",
			'button' => "Aktualisiere Einstellungen",
			'settingsUpdated' => "Einstellungen aktualisiert",
			'tipsOn' => "Zeige Tips an",
			'tipsOff' => "Zeige keine Tips an",
			'usingStyle' => 'Benutze "%s" stylesheet',
		],
		'password' => [
			'title' => "Kennwort",
			'current' => "Aktuelles Kennwort",
			'new' => "Neues Kennwort",
			'newAgain' => "Kennwortbestätigung",
			'requiredFields' => "Felder markiert mit einem %s sind erforderlich um Änderungen durchzuführen.",
			'button' => "Aktualisiere Kennwort",
			'incorrect' => "Falsches Kennwort!",
			'noMatch' => "Kennworte stimmen nicht überein!",
			'updated' => "Aktualisiert!",
		],
		'tools' => [
			'title' => "Werkzeuge",
			'purge' => "Lösche alle erledigten Einträge",
			'update' => "Führe Update-Datei aus",
			'export' => "Exportiere alles in eine <acronym title='Comma Separated Values'>CSV</acronym>-Datei",
			'purged' => "%d Einträge gelöscht.",
			'purgeCheck' => "Möchten Sie wirklich alle erledigten Einträge löschen ??",
		],
	],

	'print' => [
		'commonTitle' => "Druck",
		'printAllTasks' => "Aufgaben",
		'printToday' => "Heute (%s)",
		'sectionNotFound' => "Abschnitt nicht gefunden!",
	],

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