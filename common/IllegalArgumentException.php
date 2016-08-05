<?php
namespace ufds;

use ErrorException;

class IllegalArgumentException extends ErrorException {
  public function __construct($varName, $file, $line) {
    parent::__construct("IllegalArgument for $varName ($file,$line)");
  }
}
