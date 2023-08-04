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


class InputDateTime extends Input
{
    public function __construct($id, $class = '')
    {
        parent::__construct($id, 'datetime-local', $class);
    }

    public function setMin($minDate)
    {
        $this->attribute('min', $minDate);
    }

    public function setMax($maxDate)
    {
        $this->attribute('max', $maxDate);
    }
}
