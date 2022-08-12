<?php

class Deactivate{
	public function __construct() {
		flush_rewrite_rules();
	}
}