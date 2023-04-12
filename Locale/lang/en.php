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

	// Navigation
	'nav_today' => "Today";
	'nav_home' => "Home";
	'nav_context' => "By context";
	'nav_project' => "By project";
	'nav_settings' => "Settings";
	'nav_help' => "Help";
	'nav_logout' => "Logout";

	// Sidebar
	'side_add' => "Add item";

*/
	//Sections
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

	//Items
	'items' => [
		'do' => "Mark as done",
	],
/*
	'items_undo' => "Mark as not done";
	'items_edit' => "Edit item";
	'items_del' => "Delete";
	'items_print' => "Print list (3 x 5 Index card)";
	'items_sort' => array('title' => "Title", //Another array for list purposes
	'date' => "Date",
	'context' => "Context",
	'project' => "Project",
	'done' => "Done");
	'items_sorttext' => "Sort items by:";
	'items_sortbutton' => "Sort";

	//"Display by" pages
	'dbp_l1'['>context'] = "Choose a context to list the items for. Alternatively, add a new context.";
	'dbp_l1'['>project'] = "Choose a project to list the items for. Alternatively, add a new project.";
	'dbp_l2'['>context'] = "Choose a context to edit. Alternatively, add a new context.";
	'dbp_l2'['>project'] = "Choose a project to edit. Alternatively, add a new project.";
	'dbp_add'['>context'] = "Add context";
	'dbp_add'['>project'] = "Add project";
	'dbp_edit'['>context'] = "Edit context";
	'dbp_edit'['>project'] = "Edit project";
	'dbp_del'['>context'] = "Delete context";
	'dbp_del'['>project'] = "Delete project";
	'dbp_new'['>context'] = "NewContext";
	'dbp_new'['>project'] = "NewProject";

	//Forms (add, edit etc.)
	'forms_title' => "Title";
	'forms_notes' => "Notes";
	'forms_section' => "Section";
	'forms_context' => "Context";
	'forms_project' => "Project";
	'forms_contexte' => "Edit contexts";
	'forms_projecte' => "Edit projects";
	'forms_date' => "Due date";
	'forms_url' => "Url";
	'forms_button'['>add'] = "Add item";
	'forms_button'['>edit'] = "Edit item";

	//Messages
	'msg_noitems' => "No items in this section!";
	'msg_addsome' => "Add some!";
	'msg_notoday' => "No items today! Either there is nothing to do, or you should";
	'msg_itemedit' => "Item updated!";
	'msg_itemadd' => "Item added!";
	'msg_itemdel' => "Item deleted";
	'msg_itemdo' => "Marked as done";
	'msg_itemundo' => "Marked as not done";
	'msg_actionerror' => "Command or action invalid";
	'msg_unspecific' => "Sorry, you need to specify a context, project and section.";
	'msg_updated'['>context'] = "Context updated";
	'msg_updated'['>project'] = "Project updated";
	'msg_added'['>context'] = "Context added";
	'msg_added'['>project'] = "Project added";
	'msg_deleted'['>context'] = "Context deleted";
	'msg_deleted'['>project'] = "Project deleted";
	'msg_noid' => "Sorry, there is an error in the URL. There should be an id specified.";

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
	//--1/4/07--
	'nav_allitems' => "All Items";

	//--28/8/07--
    'forms_titledefval' => "Task or step title";
    'msg_updateassoctasks' => "Update associated tasks?";
    'print_commontitle' => "Print";
    'print_printalltasks' => "Tasks";
    'print_printtoday' => "Today";
    'print_sectionnotfound' => "Section not found!";
    'msg_exportedto'=">Exported to";
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