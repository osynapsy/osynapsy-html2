<?php
namespace Osynapsy\Html\Component;

/**
 * Description of Check
 *
 * @author peter
 */
class Check extends Input
{
    protected $checked;
    
    public function __construct($id, $name, $value = 1)
    {
        parent::__construct($id, $name, 'checkbox');
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
