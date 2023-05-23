<?php
namespace Osynapsy\Html\Component;

use Osynapsy\Html\Tag;

/**
 * Description of PanelCell
 *
 * @author peter
 */
class PanelCell extends Tag
{
    public function push($label , $content)
    {
        $this->add(new Tag('label'))->add($label);
        $this->add($content);
    }
}
