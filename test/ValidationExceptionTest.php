<?php
namespace sbronsted;

use PHPUnit\Framework\TestCase;

require __DIR__.'/settings.php';

class ValidationExceptionTest extends TestCase {

	public function testDefault() {
		$e = new ValidationException('SomeClass');
		$this->assertFalse($e->hasValidations());

		$e->addError('name', 'Should have a value');
		$e->addWarning('zipcode', 'This zipcode is not valid');
		$this->assertTrue($e->hasValidations());

		$this->assertStringContainsString('SomeClass', $e);
		$this->assertStringContainsString('name', $e);
		$this->assertStringContainsString('Should have a value', $e);
		$this->assertStringContainsString('error', $e);

		$this->assertStringContainsString('zipcode', $e);
		$this->assertStringContainsString('This zipcode is not valid', $e);
		$this->assertStringContainsString('warning', $e);
	}
}
