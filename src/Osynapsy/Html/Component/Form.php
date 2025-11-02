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

class Form extends AbstractComponent
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

    protected function initCsrfToken($secretKey)
    {
        $nonce = bin2hex(random_bytes(16));
        $token = hash_hmac('sha256', $nonce, $secretKey);
        $this->add(new InputHidden('crsf_nonce'))->setValue($nonce);
        $this->add(new InputHidden('crsf_token'))->setValue($token);
    }
    
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->getPanel(), $name], $arguments);
    }
    
    public static function validateCrsfToken($secretKey)
    {
        $nonce = filter_input(\INPUT_POST, 'csrf_nonce');
        $token = filter_input(\INPUT_POST, 'csrf_token');;        
        $expectedToken = hash_hmac('sha256', $nonce, $secretKey);
        if (!hash_equals($expectedToken, $token)) {
            throw new \Exception();
        }
    }
}
