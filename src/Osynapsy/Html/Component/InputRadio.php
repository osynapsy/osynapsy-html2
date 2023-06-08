<?php
namespace Osynapsy\Html\Component;

/**
 * Description of Radio
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class InputRadio extends Input
{
    protected $checked;
    
    public function __construct($id, $name, $value = 1)
    {
        parent::__construct($id, $name, 'radio');
        $this->setValue($value);
    }
    
    public function preBuild()
    {
        if ($this->checked) {
            $this->attribute('checked', 'checked');
        }
    }
    
    public function setDisabled($condition)
    {
        if ($condition) {
            $this->attribute('disabled', 'disabled');
        }
        return $this;
    }
    
    public function setChecked($condition)
    {        
        $this->checked = $condition ? true : false;        
    }
}
