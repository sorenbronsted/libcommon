<?php
namespace sbronsted;

/**
 * Class Header is a wrapper for the header function. This means you can make header testable.
 */
class Header {
	public function out($text) {
		header($text);
	}
}