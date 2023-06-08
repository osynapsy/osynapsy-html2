<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\InputText;
//require_once 'StringClean.php';

final class InputTextTest extends TestCase
{
    public function testInputText(): void
    {
        $InputText = new InputText('test');
        $this->assertEquals(
            '<input id="test" type="text" name="test">',
            (string) $InputText
        );
    }

    public function testInputTextValue(): void
    {        
        $InputText = new InputText('textBoxTest');
        $InputText->setValue('hello word!');
        $this->assertEquals(
            '<input id="textBoxTest" type="text" name="textBoxTest" value="hello word!">',
            (string) $InputText
        );
    }

    public function testInputTextWithAction(): void
    {
        $InputText = new InputText('test');
        $InputText->setAction('test', ['#p1','value']);
        $this->assertEquals(
            '<input id="test" type="text" name="test" class="change-execute" data-action="test" data-action-parameters="#p1,value">',
            (string) $InputText
        );
    }
}

