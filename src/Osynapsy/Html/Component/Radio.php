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

class Radio extends Base
{
    protected $label;
    protected $radio;
    protected $checked;
    
    public function __construct($id, $label, $value = null)
    {
        parent::__construct('span', $id.'_box');
        $this->label = $label;
        $this->radio = $this->radioFactory($id, $value);
    }

    protected function radioFactory($id, $value)
    {
        $radio = new Tag('input', $id);
        $radio->attributes([
            'type' => 'radio',
            'name' => $id,
            'value' => $value
        ]);
        return $radio;
    }

    public function build($depth = 0)
    {
        if ($this->checked) {
            $this->getRadio()->attribute('checked','checked');
        }
        $this->add($this->getRadio());
        if (!empty($this->label)) {
            $this->add(' '.$this->label);
        }
        return parent::build($depth);
    }  

    public function getRadio()
    {
        return $this->radio;
    }

    public function setDisabled($condition)
    {
        if ($condition) {
            $this->getRadio()->attribute('disabled', 'disabled');
        }
    }
    
    public function setChecked($condition)
    {    
        $this->checked = $condition ? true : false;    
    }
}
