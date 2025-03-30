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

class CheckList extends AbstractComponent
{
    private $parents = [];

    public function __construct($name)
    {
        parent::__construct('div', $name);
        $this->addClass('ocl-checklist');
    }

    public function preBuild()
    {
        $checkedItems = $this->getCheckedItems($this->dataset);
        foreach ($this->dataset as $value) {
            $value[2] = in_array($value[0], $checkedItems) ? true : false;
            $this->add($this->rowFactory($value));
        }
    }

    protected function getCheckedItems($dataset)
    {
        if (array_key_exists($this->id, $_REQUEST)) {
            return $_REQUEST[$this->id];
        }
        if (empty($dataset) || !array_key_exists(2, $dataset[0])) {
            return [];
        }
        $result = [];
        foreach($dataset as $row) {
            if (!empty($row[2])) {
                $result[] = $row[0];
            }
        }
        return $result;
    }

    protected function rowFactory($value, $level = 0)
    {
        $tr = new Tag('div', null, 'ocl-checklist-row');
        $tr->add(str_repeat('&nbsp;', $level * 7));
        $tr->add($this->checkBoxFactory($value));
        if (!empty($this->parents[$value[0]])) {
            foreach($this->parents[$value[0]] as $value) {
               $tr->add($this->rowFactory($value, $level + 1));
            }
        }
        return $tr;
    }

    protected function checkBoxFactory($value)
    {
        $CheckBox = new CheckBox(sprintf('%s', $this->id.'_'.$value[0]), $value[1], $value[0], 'span');
        $CheckBox->getCheckbox()->attribute('name', $this->id . '[]');
        if (!empty($value[2])) {
           $CheckBox->getCheckbox()->attribute('checked', 'checked');
        }
        return $CheckBox;
    }

    public function setDataset(array $dataset)
    {
        foreach($dataset as $rec) {
            if (empty($rec['parent'])) {
                $this->dataset[] = array_slice(array_values($rec), 0 ,2);
            } else {
                $this->parents[$rec['parent']][] = $rec;
            }
        }
    }

    public function setHeight($px)
    {
        $this->addStyle(sprintf('height: %spx; border: 1px solid black; overflow: auto;', $px));
    }
}
