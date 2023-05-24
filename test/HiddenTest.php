<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\Hidden;

final class HiddenTest extends TestCase
{
    public function testHiddenBox(): void
    {
        $HiddenBox = new Hidden('test');
        $this->assertEquals(
            '<input id="test" type="hidden" name="test">',
            (string) $HiddenBox
        );
    }

    public function testHiddenBoxConstructWithClass(): void
    {
        $Button = new Hidden('testId', 'testName', 'testClass');
        $this->assertEquals(
            '<input id="testId" type="hidden" name="testName" class="testClass">',
            (string) $Button
        );
    }

    public function testHiddenBoxValue(): void
    {        
        $HiddenBox = new Hidden('test');
        $HiddenBox->setValue('testValue');
        $this->assertEquals(
            '<input id="test" type="hidden" name="test" value="testValue">',
            (string) $HiddenBox
        );
    }
}