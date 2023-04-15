<?php

/* Fichier de traduction (anglais) *

Le texte à été repris tel quel du fichier originalement compilé par Rob L. en 2006.

NOTE: Décommentez le fichier au fur et à mesure que vous migrez vers le nouveau système
      de traduction. Les notes doivent être suprimmées une fois la migration terminée.

NOTE: Pensez à ranger les traductions ajoutées à la fin dans les sections correspondantes.

*/

return [
/*
	// Login
	'login_button' => "Login";
	'login_l1' => "Please enter your password to login";
	'login_l2' => "Password accepted.";
	'login_l3' => "Click here to go to your lists.";
	'login_l4' => "Incorrect password.";
	'login_l5' => "Password has been disabled. This isn't very secure, so please change this if you're using this on a public server.";
*/
	// Navigation
	'navigation' => [
		'today' => "Today: %s",
		'home' => "Home",
		'allItems' => 'All Items',
		'context' => "By context",
		'project' => "By project",
		'settings' => "Settings",
		'help' => "Help",
		'logout' => "Logout",
	],

	// Sidebar
	'sidebar' => [
		'add' => "Add item",
	],

	// Sections
	'sections' => [
		'ideas' => "Ideas",
		'tobuy' => "Might Want to Buy",
		'immediate' => "Immediate",
		'week' => "This week",
		'month' => "This month",
		'year' => "This year",
		'lifetime' => "Some day maybe",
	],

	// Front page
	'index' => [
		'welcome' => "Welcome to TaskStep",
		'tip' => "Tip",
		'noImmediate' => "No immediate items left to-do! <a href='edit.php'>Add some</a>!",
		'introMorning' => "Good morning",
		'introAfternoon' => "Good afternoon",
		'introEvening' => "Good evening",
		'introText' => ", and welcome to TaskStep. TaskStep is designed to help you with day-to-day tasks, long-term aims and general lists, vaguely organising them <a href='http://www.gettingthingsdone.com/'>GTD</a>-style with contexts and projects.</p> <p>For those of you unfamiliar with the idea, anything which requires more than one action/step is a project. A context is where you will be doing the action, for example, at your computer.</p>",
		'oneTask' => "There is currently 1 task left to do.",
		'nTasks' => "There are currently %d tasks left to do.",
	],

	// Items
	'items' => [
		'do' => "Mark as done",
		'undo' => "Mark as not done",
		'edit' => "Edit item",
		'delete' => "Delete",
		'print' => "Print list (3 x 5 Index card)",
		'sort' => [
			'title' => "Title",
			'date' => "Date",
			'context' => "Context",
			'project' => "Project",
			'done' => "Done"
		],
		'sortText' => "Sort items by:",
		'sortButton' => "Sort",
    	'defaultTitle' => "Task or step title",
	],

	// "Display by" pages
	'context' => [
		'chooseToList' => "Choose a context to list the items for. Alternatively, add a new context.",
		'chooseToEdit' => "Choose a context to edit. Alternatively, add a new context.",
		'add' => "Add context",
		'edit' => "Edit context",
		'delete' => "Delete context",
		'defaultTitle' => "New Context",
	],
	'project' => [
		'chooseToList' => "Choose a project to list the items for. Alternatively, add a new project.",
		'chooseToEdit' => "Choose a project to edit. Alternatively, add a new project.",
		'add' => "Add project",
		'edit' => "Edit project",
		'delete' => "Delete project",
		'defaultTitle' => "New Project",
	],

	// Forms (add, edit etc.)
	'forms' => [
		'title' => "Title",
		'notes' => "Notes",
		'section' => "Section",
		'context' => "Context",
		'project' => "Project",
		'editContexts' => "Edit contexts",
		'editProjects' => "Edit projects",
		'date' => "Due date",
		'url' => "Url",
		'addButton' => "Add item",
		'editButton' => "Edit item",
	],

	// Messages
	'message' => [
		'noItems' => "No items in this section!",
		'addSome' => "Add some!",
		'noneToday' => "No items today! Either there is nothing to do, or you should",
		'actionError' => "Command or action invalid",
		'unspecific' => "Sorry, you need to specify a context, project and section.",
		'noId' => "Sorry, there is an error in the URL. There should be an id specified.",
    	'exportedTo' => "Exported to %s",
		'item' => [
			'updated' => "Item updated!",
			'added' => "Item added!",
			'deleted' => "Item deleted",
			'done' => "Marked as done",
			'undone' => "Marked as not done",
		],
		'context' => [
			'updated' => "Context updated",
			'added' => "Context added",
			'deleted' => "Context deleted",
		],
		'project' => [
			'updated' => "Project updated",
			'added' => "Project added",
			'deleted' => "Project deleted",
		],
	],

	//Settings
	'settings' => [
		'bookmarklet' => [
			'text' => "Drag the image below onto your bookmarks to create the bookmarklet.",
			'link' => "Add to TaskStep",
		],
		'display' => [
			'title' => "Display",
			'tips' => "Display tips on the front page",
			'css' => "Stylesheet",
			'noCss' => "None",
			'button' => "Update settings",
			'settingsUpdated' => "Settings updated",
			'tipsOn' => "Displaying tips",
			'tipsOff' => "Not displaying tips",
			'usingStyle' => 'Using the %s stylesheet',
		],
		'password' => [
			'title' => "Password",
			'current' => "Current password",
			'new' => "New password",
			'newAgain' => "Confirm new password",
			'use' => "Use passwords and sessions (Recommended)",
			'requiredFields' => "Fields marked with a %s are necessary for changes to be made.",
			'button' => "Update password",
			'incorrect' => "Incorrect password!",
			'noMatch' => "Passwords do not match!",
			'updated' => "Updated!",
		],
		'tools' => [
			'title' => "Tools",
			'purge' => "Purge all done items",
			'update' => "Run update file",
			'export' => "Export all to <acronym title='Comma Separated Values'>CSV</acronym> file",
			'purged' => "%d items purged.",
			'purgeCheck' => "Are you sure you want to delete all done items?",
		]
	],

	'print' => [
	    'commonTitle' => "Print",
	    'printAllTasks' => "Tasks",
	    'printToday' => "Today",
	    'sectionNotFound' => "Section not found!",
    ],

    'tips' => [
    	'Clicking the date gives you the tasks due today.',
		'All the small icons here are from <a href="http://www.famfamfam.com">famfamfam.com</a>.',
		'You can list all the items by context or project.',
		'Don\'t try this on a public server! It\'s not very secure!',
		'The printing is designed for 3x5 index cards, but you can print to A4 by going to File → Print in your browser.',
		'Problems? Try the help section.',
		'On the index page (this one) click an item in the immediate list to edit it.',
		'You can now select the date from a calendar. Just click in the date box as if you were typing.',
		'The calendar script is <a href="http://www.garrett.nildram.co.uk/calendar/jacs.htm">JACS</a> by Anthony Garrett.',
    ],
];