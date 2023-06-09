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

class Form extends Base
{
    protected $panel;

    public function __construct($id, $method = 'post')
    {
        parent::__construct('form', $id);
        $this->attributes([
            'name' => $id,
            'method' => $method
        ]);
        $this->panel = $this->add($this->panelFactory($id));
    }

    protected function panelFactory($id)
    {
        return new Panel($id.'_panel');
    }
    
    protected function getPanel()
    {
        return $this->panel;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->getPanel(), $name], $arguments);
    }
}
