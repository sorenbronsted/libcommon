<?php

namespace ufds;

use Exception;

/* ApplicationException are recoverable */
class ApplicationException extends Exception {
  public function __construct($mesg) {
    parent::__construct($mesg);
  }
}
