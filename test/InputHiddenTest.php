<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\InputHidden;

final class InputHiddenTest extends TestCase
{
    public function testInputHiddenBox(): void
    {
        $InputHiddenBox = new InputHidden('test');
        $this->assertEquals(
            '<input id="test" type="hidden" name="test">',
            (string) $InputHiddenBox
        );
    }

    public function testInputHiddenBoxConstructWithClass(): void
    {
        $Button = new InputHidden('testId', 'testName', 'testClass');
        $this->assertEquals(
            '<input id="testId" type="hidden" name="testName" class="testClass">',
            (string) $Button
        );
    }

    public function testInputHiddenBoxValue(): void
    {        
        $InputHiddenBox = new InputHidden('test');
        $InputHiddenBox->setValue('testValue');
        $this->assertEquals(
            '<input id="test" type="hidden" name="test" value="testValue">',
            (string) $InputHiddenBox
        );
    }
}
