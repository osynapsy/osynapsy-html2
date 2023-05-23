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

use Osynapsy\Html\Component\Base;
use Osynapsy\Html\Tag;

//Costruttore del pannello html
class Panel extends Base
{
    private $tags = ['row' => 'tr', 'cell' => 'td'];
    private $rowClass = 'row';
    private $cellClass;
    protected $currentRow;
    protected $currentCell;

    public function __construct($id, $rowClass = null, $cellClass = null, $tag = 'table')
    {
        parent::__construct($tag, $id);
        if (!empty($rowClass)) {
            $this->rowClass = $rowClass;
        }
        if (!empty($cellClass)) {
            $this->cellClass = $cellClass;
        }
        if ($tag === 'div') {
            $this->tags = ['row' => 'div', 'cell' => 'div'];
        }
    }  

    protected function labelFactory($labelValue)
    {
        $label = new Tag('label');
        $label->add(trim($labelValue));
        return $label;
    }

    public function put($label, $content, $row = 0, $col = 0)
    {
        if (!array_key_exists($row, $this->data)) {
            $this->data[$row] = [];
        }
        if (!array_key_exists($col, $this->data[$row])) {
            $this->data[$row][$col] = [];
        }
        $this->data[$row][$col][] = ['label' => $label, 'content'=> $content];
    }
    
    public function addRow()
    {
        $this->currentRow = $this->add(new Tag($this->tags['row'], null, $this->rowClass));
    }
    
    public function addCell($class = '', $colspan = 1, $rowspan = 1)
    {
        if (empty($this->currentRow)) {
            $this->addRow();
        }
        $tableCell = $this->currentRow->add(new Tag($this->tags['cell'], null, trim($class. ' '.$this->cellClass)));
        if ($rowspan > 1) {
            $this->currentCell->attribute('rowspan', $rowspan);
        }
        if ($colspan > 1) {
            $this->currentCell->attribute('colspan', $colspan);
        }
        return $tableCell->add(new PanelCell());
    }
    
    public function getCurrentRow()
    {
        return $this->currentRow;
    }
    
    public function getCurrentCell()
    {
        return $this->currentCell;
    }
}
