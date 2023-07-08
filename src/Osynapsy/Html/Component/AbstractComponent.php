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
use Osynapsy\Html\DOM;
use Osynapsy\Mvc\Action\ActionInterface;

/*
 * Master class component
 */
class AbstractComponent extends Tag
{
    const EV_CLICK = 'click-execute';
    const EV_CHANGE = 'change-execute';
    const EV_KEYPRESS = 'keypress-execute';

    protected $dataset = [];

    public function __construct($tag, $id = null)
    {
        parent::__construct($tag, $id);
        if (!empty($id)) {
            DOM::append($id, $this);
        }
    }

    /**
     * Return data array
     *
     * @return array
     */
    public function getDataset()
    {
        return $this->dataset;
    }

    /**
     * Set action to recall via ajax
     *
     * @param string $actionClass name of the external action without Action final
     * @param string $parameters parameters list (comma separated) to pass action
     * @param string $confirmMessage prompt Message showed before action executed.
     * @param string $eventClass css class associated at event required to execute action
     * @return $this
     */
    public function setAction(string $actionClass, array $parameters = [], $confirmMessage = null, $eventClass = self::EV_CLICK)
    {
        if (class_exists($actionClass) && !in_array(ActionInterface::class, class_implements($actionClass) ?: [])) {
            throw new \Exception(sprintf("Class %s must implement interface %s %s", $actionClass, ActionInterface::class, print_r(class_implements($actionClass), true)));
        }
        $action = class_exists($actionClass) ? sha1($actionClass) : $actionClass;
        $this->addClass($eventClass);
        $this->attribute('data-action', $action);
        if (!empty($parameters)) {
            $this->attribute('data-action-parameters', implode(',', $parameters));
        }
        if (!empty($confirmMessage)) {
            $this->attribute('data-confirm', $confirmMessage);
        }
        DOM::addEventListener(str_replace('-execute', '', $eventClass), $this->getAttribute('id'), $action);
        return $this;
    }

    /**
     * Set data internal property of component
     *
     * @param array $dataset set of data;
     * @return $this
     */
    public function setDataset(array $dataset)
    {
        $this->dataset = $dataset;
        return $this;
    }

    /**
     * Set disabled property
     *
     * @param boolen $condition evalute condition for set disabled property
     * @return $this
     */
    public function setDisabled($condition)
    {
        if ($condition) {
            $this->attribute('disabled', 'disabled');
        }
        return $this;
    }

    /**
     * Set placeholder attribute
     *
     * @param string $placeholder placeholder value
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->attribute('placeholder', $placeholder);
        return $this;
    }

    /**
     * Set readonly property
     *
     * @param boolen $condition evalute condition for set readonly property
     * @return $this
     */
    public function setReadOnly($condition)
    {
        if ($condition) {
            $this->attribute('readonly', 'readonly');
        }
        return $this;
    }

    public function onClick(callable $listener)
    {
        $this->addClass('dispatch-event dispatch-event-click');
        $this->addListener('Click', $listener);
    }

    public function onChange(callable $listener)
    {
        $this->addClass('dispatch-event dispatch-event-change');
        $this->addListener('Change', $listener);
    }

    protected function addListener($event, callable $listener)
    {
        DOM::addEventListener($event, $this->id, $listener);
        if (class_exists('\Osynapsy\Event\Dispatcher')) {
            $eventId = sprintf('%s%s', $this->id, $event);
            \Osynapsy\Event\Dispatcher::addListener($listener, [$eventId]);
        }
    }

    protected function requireJs($filepath)
    {
        DOM::requireJs($filepath, get_class($this));
    }

    protected function requireCss($filepath)
    {
        DOM::requireCss($filepath, get_class($this));
    }

    protected function requireScript($code)
    {
        DOM::requireScript($code);
    }
}
