<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Html\Component;


class TextArea extends AbstractComponent
{
    protected $value;
    
    public function __construct($id)
    {
        parent::__construct('textarea', $id);
        $this->attribute('name', $id);
    }

    public function prebuild()
    {
        $this->add($this->value);        
    }

    public function setAction($action, $parameters = null, $confirmMessage = null, $class = self::EV_CHANGE)
    {
        return parent::setAction($action, $parameters, $confirmMessage, $class);
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
}
