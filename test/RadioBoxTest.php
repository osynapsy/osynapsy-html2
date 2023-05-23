<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\Radio;
require_once 'StringClean.php';

final class RadioBoxTest extends TestCase
{
    use StringClean;
    
    public function testRadioBox(): void
    {
        $RadioBox = new Radio('test', 'test', '1');
        $this->assertEquals(
            '<span id="test_box"><input id="test" type="radio" name="test" value="1"> test</span>',
            $this->tabAndEolRemove((string) $RadioBox)
        );
    }

    public function testRadioBoxDisabled(): void
    {
        $RadioBox = new Radio('test', 'test', '1');
        $RadioBox->setDisabled(true);
        $this->assertEquals(
            '<span id="test_box"><input id="test" type="radio" name="test" value="1" disabled="disabled"> test</span>',
            $this->tabAndEolRemove((string) $RadioBox)
        );
    }

    public function testRadioBoxChecked(): void
    {
        $_REQUEST['radioTest'] = '9';
        $RadioBox = new Radio('radioTest', 'labelTest', '9');
        $RadioBox->setChecked(($_REQUEST['radioTest'] === '9'));
        $this->assertEquals(
            '<span id="radioTest_box"><input id="radioTest" type="radio" name="radioTest" value="9" checked="checked"> labelTest</span>',
            $this->tabAndEolRemove((string) $RadioBox)
        );
    }
}
