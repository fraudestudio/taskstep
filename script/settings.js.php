function check() {
	let message = confirm('<?= $l_cp_tools_purgecheck ?>');

	if (message) {
		this.location.href = "settings.php?delete=confirm";
	} else {
		this.location.href = "settings.php";
	}
}