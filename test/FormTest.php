<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\Component\Form;
require_once 'StringClean.php';

/**
 * Description of FormTest
 *
 * @author peter
 */
final class FormTest extends TestCase
{
    use StringClean;
    
    public function testForm(): void
    {
        $Form = new Form('test');
        $result = $this->tabAndEolRemove((string) $Form);
        $this->assertEquals(
            '<form id="test" name="test" method="post"><table id="test_panel"></table></form>',
            $result
        );
    }
}
