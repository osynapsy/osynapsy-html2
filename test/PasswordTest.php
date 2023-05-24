<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\Password;
//require_once 'StringClean.php';

final class PasswordTest extends TestCase
{
    public function testPassword(): void
    {
        $TextBox = new Password('test');
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off">',
            (string) $TextBox
        );
    }

    public function testPasswordBoxValue(): void
    {        
        $TextBox = new Password('textBoxTest');
        $TextBox->setValue('hello word!');
        $this->assertEquals(
            '<input id="textBoxTest" type="password" name="textBoxTest" autocomplete="off" value="hello word!">',
            (string) $TextBox
        );
    }

    public function testPasswordBoxWithAction(): void
    {
        $TextBox = new Password('test');
        $TextBox->setAction('test', ['#p1','value']);
        $this->assertEquals(
            '<input id="test" type="password" name="test" autocomplete="off" class="change-execute" data-action="test" data-action-parameters="#p1,value">',
            (string) $TextBox
        );
    }
}

