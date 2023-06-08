<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\InputFile;

final class InputFileTest extends TestCase
{
    public function testInputFileBox(): void
    {
        $InputFileBox = new InputFile('test');
        $this->assertEquals(
            '<input id="test" type="file" name="test">',
            (string) $InputFileBox
        );
    }

    public function testInputFileBoxConstructWithClass(): void
    {
        $Button = new InputFile('testId', 'testName', 'testClass');
        $this->assertEquals(
            '<input id="testId" type="file" name="testName" class="testClass">',
            (string) $Button
        );
    }

    public function testInputFileBoxValue(): void
    {        
        $InputFileBox = new InputFile('test');
        $InputFileBox->setValue('testValue');
        $this->assertEquals(
            '<input id="test" type="file" name="test" value="testValue">',
            (string) $InputFileBox
        );
    }
}
