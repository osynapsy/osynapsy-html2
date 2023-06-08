<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\InputPassword;
//require_once 'StringClean.php';

final class InputPasswordTest extends TestCase
{
    public function testInputPassword(): void
    {
        $TextBox = new InputPassword('test');
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off">',
            (string) $TextBox
        );
    }

    public function testInputPasswordBoxValue(): void
    {        
        $TextBox = new InputPassword('textBoxTest');
        $TextBox->setValue('hello word!');
        $this->assertEquals(
            '<input id="textBoxTest" type="password" name="textBoxTest" autocomplete="off" value="hello word!">',
            (string) $TextBox
        );
    }

    public function testInputPasswordBoxWithAction(): void
    {
        $TextBox = new InputPassword('test');
        $TextBox->setAction('test', ['#p1','value']);
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off" class="change-execute" data-action="test" data-action-parameters="#p1,value">',
            (string) $TextBox
        );
    }
}
