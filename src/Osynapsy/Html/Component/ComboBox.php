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

use Osynapsy\Html\Tag as Tag;
use Osynapsy\Html\Component\Base;

class ComboBox extends Base
{    
    protected $placeholder = ['', '- Seleziona -'];
    protected $value;    

    public function __construct($name)
    {
        parent::__construct('select', $name);
        $this->attribute('name', $name);
    }

    public function prebuild()
    {        
        if (!empty($this->placeholder) && is_array($this->dataset)){
            array_unshift($this->dataset, $this->placeholder);
        }
        $this->optionsFactory();        
    }

    protected function optionsFactory()
    {
        foreach ($this->dataset as $item) {
            $item = array_values(!is_array($item) ? [trim($item)] : $item);
            $value = $item[0];
            $label = isset($item[1]) ? $item[1] : $item[0];
            $disabled = empty($item[2]) ? false : true;
            $this->optionFactory($value, $label, $disabled);
        }
    }

    protected function optionFactory($value, $label, $disabled = 0)
    {
        $option = (new Tag('option'))->attribute('value', $value);
        $option->add($label ?? $value);
        if ($disabled) {
            $this->atttribute('disabled','disabled');
        }
        if ($this->value == $value) {
            $option->attribute('selected', 'selected');
        }
        if (empty($this->getAttribute('readonly')) || !empty($option->getAttribute('selected'))) {
            $this->add($option);
        }
        return $option;
    }

    public function countOption()
    {
        return count($this->dataset);
    }

    public function setAction($action, array $parameters = [], $confirmMessage = null, $class = 'change-execute')
    {
        return parent::setAction($action, $parameters, $class, $confirmMessage);
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setPlaceholder($label, $value = '')
    {
        $this->placeholder = $label === false ? [] : [$value, $label, null];
        return $this;
    }
}
