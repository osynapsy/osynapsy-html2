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

class Input extends AbstractComponent
{
    protected $value;
    public $formatValueFunction;

    public function __construct($id, $name, $type)
    {
        parent::__construct('input', $id);
        $this->attributes([
            'type' => $type,
            'name' => $name            
        ]);             
    }
    
    public function getValue()
    {
        return $this->getAttribute('value');
    }

    public function setValue($rawvalue)
    {
        $formattingFunction = $this->formatValueFunction;
        $value = is_callable($formattingFunction) ? $formattingFunction($rawvalue) : $rawvalue;
        $this->attribute('value', $value);
        return $this;
    }
}
