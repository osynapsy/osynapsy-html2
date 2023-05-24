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

class Input extends Base
{
    protected $value;
    
    public function __construct($id, $name, $type)
    {
        parent::__construct('input', $id);
        $this->attributes([
            'type' => $type,
            'name' => $name
        ]);             
    }   

    public function setValue($value)
    {
        $this->attributes(['value' => $value]);
        return $this;
    }
}
