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

class InputPassword extends Input
{
    public function __construct($name, $id = null)
    {
        parent::__construct($name, $id ?? $name, 'password');
        $this->attribute('autocomplete','off');
    }

    public function setAction($action, $parameters = null, $confirmMessage = null, $class = self::EV_CHANGE)
    {
        return parent::setAction($action, $parameters, $confirmMessage, $class);
    }
}
