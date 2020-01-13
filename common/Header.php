<?php
namespace sbronsted;

class Header {
	public function out($text) {
		header($text);
	}
}