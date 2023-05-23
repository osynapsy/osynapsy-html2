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

use Osynapsy\Html\Tag;

class CheckBox extends Base
{
    private $checkbox = null;
    private $checked = false;
    private $label;

    public function __construct($id, $label = '', $value = '1', $tag = 'span')
    {
        parent::__construct($tag, $id.'_container');
        $this->checkbox = $this->checkboxFactory($id, $value);
        $this->label = $label;
    }

    protected function checkboxFactory($id, $value)
    {
        $checkbox = new Tag('input', $id);
        $checkbox->attributes([
            'type' => 'checkbox', 
            'name' => $id, 
            'value' => $value
        ]);
        return $checkbox;
    }

    public function preBuild()
    {
        $checkBoxId = $this->getCheckbox()->getAttribute('id');
        if ($this->checked) {
            $this->getCheckbox()->attribute('checked', 'checked');
        }
        if (strpos($this->getCheckbox()->name, '[') === false) {
            $this->add($this->hiddenFieldFactory($checkBoxId));
        }
        $this->add($this->getCheckbox());
        if (!empty($this->label)) {
            $this->add(sprintf('&nbsp;%s',$this->label));
        }
    }

    protected function hiddenFieldFactory($name)
    {
        return sprintf('<input type="hidden" name="%s" value="0">', $name);
    }

    public function getCheckbox()
    {
        return $this->checkbox;
    }

    public function setDisabled($condition)
    {
        if ($condition) {
            $this->getCheckbox()->attribute('disabled', 'disabled');
        }
        return $this;
    }
    
    public function setChecked($condition)
    {        
        $this->checked = $condition ? true : false;        
    }
}
