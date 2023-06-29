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

//costruttore del text box
class InputText extends Input
{
    public function __construct($id, $class = null)
    {
        parent::__construct($id, 'text', $class);
    }

    public function onTyping($jsCode)
    {
        return $this->addClass('typing-execute')->attribute('ontyping', $jsCode);
    }

    public function onDblClick($jsCode)
    {
        return $this->attribute('ondblclick', $jsCode);
    }

    public function setAction($action, array $parameters = [], $confirmMessage = null, $class = self::EV_CHANGE)
    {
        return parent::setAction($action, $parameters, $confirmMessage, $class);
    }
}