<?php
namespace sbronsted;

/**
 * Class ValidationException is a recoverable error. It is used to collect property errors on domain classes
 * and return them to the caller.
 *
 * Usage:
 * ```
 * $e = new ValidationException('SomeClass');
 * $e->addError('name','A message to user');
 * $e->addWaring('name','A message to user');
 * ```
 */
class ValidationException extends ApplicationException {
  private $validations;
  private $cls;

	/**
	 * ValidationException constructor.
	 * @param string $cls
	 * 	The name of the class for the properties that will be added by the add methods.
	 */
	public function __construct(string $cls) {
  	parent::__construct();
  	$this->cls = $cls;
		$this->validations = [];
	}

	/**
	 * @return array
	 * 	The validations
	 */
	public function validations() : array {
		return $this->validations;
	}
	/**
	 * Transform this class to the following json format:
	 * ```
	 * [{"property":"some_property", "msg":"some_message", "type":"error|warning", "class":"SomeProperty"}, ...]
	 * ```
	 *
	 * @return false|string
	 * 	json encoded array of validations
	 */
	public function toJson() {
    return json_encode($this->validations);
  }

	/**
	 * Delegates to @see toJson
	 * @return false|string
	 */
  public function __toString() {
    return $this->toJson();
  }

	/**
	 * Test whether some validations has been added.
	 * @return bool
	 * 	true if some validations has been added, otherwaie false
	 */
	public function hasValidations() {
		return count($this->validations) > 0;
	}

	/**
	 * Adds a error validation
	 * @param string $property
	 * 	A property belowing to @cls
	 * @param string $msg
	 * 	The message to the user
	 */
	public function addError(string $property, string $msg) {
		$this->validations[] = ['property' => $property, 'msg' => $msg, 'type' => 'error', 'class' => $this->cls];
	}

	/**
	 * Adds a waring validation
	 * @param string $property
	 * 	A property belowing to @cls
	 * @param string $msg
	 * 	The message to the user
	 */
	public function addWarning(string $property, string $msg) {
		$this->validations[] = ['property' => $property, 'msg' => $msg, 'type' => 'warning', 'class' => $this->cls];
	}
}
