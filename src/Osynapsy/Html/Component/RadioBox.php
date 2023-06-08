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

class RadioBox extends Base
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
        return new InputRadio($id, $id, $value);
    }

    public function preBuild()
    {        
        $this->add($this->getRadio());
        if (!empty($this->label)) {
            $this->add(' '.$this->label);
        }        
    }  

    public function getRadio()
    {
        return $this->radio;
    }

    public function setDisabled($condition)
    {
        $this->getRadio()->setDisabled($condition);
    }
    
    public function setChecked($condition)
    {    
        $this->getRadio()->setChecked($condition);
    }
}
