<?php
namespace Osynapsy\Html\Component;

/**
 * InputCheck return an object of typy check
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class InputCheckBox extends Input
{
    protected $checked;

    public function __construct($id, $class = null, $value = 1)
    {
        parent::__construct($id, 'checkbox', $class);
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
