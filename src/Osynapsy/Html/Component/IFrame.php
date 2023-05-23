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

//Component iframe
class IFrame extends Base
{
    public function __construct($id, $source = null)
    {
        parent::__construct('iframe', $id);
        $this->attribute('name', $id);
        if (!empty($source)) {
            $this->attribute('src', $source);
        }
    }
}
