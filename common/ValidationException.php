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
class ValidationException extends ApplicationException
{
    private $errors;
    private $warnings;
    private $cls;

    /**
     * ValidationException constructor.
     *
     * @param string $cls
     *    The name of the class for the properties that will be added by the add methods.
     */
    public function __construct(string $cls)
    {
        parent::__construct();
        $this->cls      = $cls;
        $this->errors   = [];
        $this->warnings = [];
    }

    /**
     * @return array
     *    The validations
     */
    public function validations(): array
    {
        return array_merge($this->errors, $this->warnings);
    }

    /**
     * Transform this class to the following json format:
     * ```
     * [{"property":"some_property", "msg":"some_message", "type":"error|warning", "class":"SomeProperty"}, ...]
     * ```
     *
     * @return string
     *    json encoded array of validations
     */
    public function toJson(): string
    {
        // consider using JSON_THROW_ON_ERROR instead when switching php 7.3+
        $json = json_encode($this->validations());
        return $json ? $json : '{}';
    }

    /**
     * Delegates to @return false|string
     *
     * @see toJson
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * Test whether some validations has been added.
     *
     * @return bool
     *    true if some validations has been added, otherwise false
     */
    public function hasValidations(): bool
    {
        return $this->hasErrors() | $this->hasWarnings();
    }

    /**
     * Test whether errors has been added.
     *
     * @return bool
     *    true if some errors has been added, otherwise false
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * Test whether warnings has been added.
     *
     * @return bool
     *    true if some errors has been added, otherwise false
     */
    public function hasWarnings(): bool
    {
        return count($this->warnings) > 0;
    }

    /**
     * Adds a error validation
     *
     * @param string $property
     *    A property belowing to @cls
     * @param string $msg
     *    The message to the user
     */
    public function addError(string $property, string $msg): void
    {
        $this->errors[] = [
            'property' => $property,
            'msg'      => $msg,
            'type'     => 'error',
            'class'    => $this->cls,
        ];
    }

    /**
     * Adds a waring validation
     *
     * @param string $property
     *    A property belowing to @cls
     * @param string $msg
     *    The message to the user
     */
    public function addWarning(string $property, string $msg): void
    {
        $this->warnings[] = [
            'property' => $property,
            'msg'      => $msg,
            'type'     => 'warning',
            'class'    => $this->cls,
        ];
    }
}
