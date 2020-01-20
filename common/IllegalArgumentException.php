<?php
namespace sbronsted;

use ErrorException;

/**
 * Class IllegalArgumentException are non-recoverable error. Use it when testing arguments for a function call.
 */
class IllegalArgumentException extends ErrorException {
  public function __construct($varName, $file, $line) {
    parent::__construct("IllegalArgument for $varName ($file,$line)");
  }
}
