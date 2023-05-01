function check() {
	let message = confirm('<?= l->settings->tools->purgeCheck ?>');

	if (message) {
		this.location.href = "settings.php?delete=confirm";
	} else {
		this.location.href = "settings.php";
	}
}

function copylink(ev) {
	ev.preventDefault();
	navigator.clipboard
		.writeText(ev.target.href)
		.then(() => window.alert('Copied to clipboard!'));
}