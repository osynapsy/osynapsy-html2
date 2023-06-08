<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Osynapsy\Html\DOM;

final class DOMTest extends TestCase
{
    public function testDOM(): void
    {
        DOM::requireCss('base/textbox/style.css');
        $requiredFiles = DOM::getRequire();        
        $this->assertIsArray($requiredFiles);
       // $this->assertArrayHasKey('css', $requiredFiles);
        $this->assertEquals([['/assets/vendor/osynapsy/base/textbox/style.css', 'css']], $requiredFiles);        
    }   
}
