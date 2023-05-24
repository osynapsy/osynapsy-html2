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


class Hidden extends Input
{
    public function __construct($id, $name = null, $class = '')
    {
        parent::__construct($id, $name ?? $id, 'hidden');
        if (!empty($class)) {
            $this->addClass($class);
        }
    }
}
