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
		'today' => "Today",
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
/*
	//Settings
	'cp_bookmarklettext' => "Drag the image below onto your bookmarks to create the bookmarklet.";
	'cp_bookmarklet' => "Add to TaskStep";
	'cp_display_title' => "Display";
	'cp_display_tips' => "Display tips on the front page";
	'cp_display_css' => "Stylesheet";
	'cp_display_nocss' => "None";
	'cp_display_button' => "Update settings";
	'cp_display_settingsupdated' => "Settings updated";
	'cp_display_tipson' => "Displaying tips";
	'cp_display_tipsoff' => "Not displaying tips";
	'cp_display_defaultcss' => "Default stylesheet chosen";

	'cp_password_title' => "Password";
	'cp_password_current' => "Current password";
	'cp_password_new1' => "New password";
	'cp_password_new2' => "Confirm new password";
	'cp_password_use' => "Use passwords and sessions (Recommended)";
	'cp_password_fieldss' => "Fields marked with a";
	'cp_password_fieldse' => "are necessary for changes to be made.";
	'cp_password_button' => "Update password";
	'cp_password_incorrect' => "Incorrect password!";
	'cp_password_nomatch' => "Passwords do not match!";
	'cp_password_updated' => "Updated!";

	'cp_tools_title' => "Tools";
	'cp_tools_purge' => "Purge all done items";
	'cp_tools_update' => "Run update file";
	'cp_tools_export' => "Export all to <acronym title=\"Comma Separated Values\">CSV</acronym> file";
		//NB The HTML for the acronym has been included for the sake of completeness, but make sure you leave the slashes before the quotes or TaskStep will break!
	'cp_tools_purged' => " items purged.";
	'cp_tools_purgecheck' => "Are you sure you want to delete all done items?";

	//Insert updated parts after this point

	//--28/8/07--
    'print_commontitle' => "Print";
    'print_printalltasks' => "Tasks";
    'print_printtoday' => "Today";
    'print_sectionnotfound' => "Section not found!";
	//Insert updated parts before this point
*/
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