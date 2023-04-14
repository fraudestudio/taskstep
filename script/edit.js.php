// Set all calendars to the chosen language
function setLanguages(jacsLanguage) {
	for (const calendarId of JACS.cals()) {
		var jacsCal = document.getElementById(calendarId);
		
		jacsCal.language = jacsLanguage;
		jacsSetLanguage(jacsCal);

		// Refresh any static calendars so that the change shows immediately.
		if (!jacsCal.dynamic) JACS.show(jacsCal.ele,jacsCal.id,jacsCal.days);
	}
};

window.onload = () => {
	JACS.make("jacs",true);
	setLanguages('<?= l->language() ?>');

	let titleInput;
	if (titleInput = document.getElementById("addtitle")) {
		titleInput.focus();
		titleInput.select();
	}
};