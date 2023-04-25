<?php

declare(strict_types=1);

namespace TaskStep\Controllers;

class ProjectController extends Controller
{
	public function get() {
		$projects = $this->service('projectDao')->readAll($this->user());

		$this->jsonResponse($projects);
	}
}