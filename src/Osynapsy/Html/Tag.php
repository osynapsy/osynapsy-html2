<?php
/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Html;

class Tag
{   
    private $attributes = [];
    private $childs = [];
    private $tag;   
    public $parent;

    /**
     * Constructor of tag
     *
     * @param type $tag to build
     * @param type $id identity of tag
     * @param type $class css class
     */
    public function __construct($tag = 'dummy', $id = null, $class = null)
    {
        $this->tag = $tag;
        if (!empty($id)) {
            $this->attribute('id', str_replace(['[]', '[', ']'], ['', '-',''], $id));
        }
        if (!empty($class)) {
            $this->addClass($class);
        }
    }

    /**
     * Check if inaccessible property is in attribute
     *
     * @param type $attributeId
     * @return type
     */
    public function __get($attributeId)
    {
        return $attributeId == 'tag' ? $this->tag : $this->getAttribute($attributeId);        
    }

    /**
     *
     * @param type $attribute
     * @param type $value
     */
    public function __set($attribute, $value)
    {        
        $this->attribute($attribute, $value);
    }

    /**
     * Add child content to childs repo
     *
     * @param $child
     * @return \Osynapsy\Html\Tag|$this
     */
    public function add($child)
    {
        if ($child instanceof Tag) {            
            $child->parent =& $this;
        }
        //Append child to childs repo
        $this->childs[] = $child;
        //If child isn't object return $this tag
        return !is_object($child) ? $this : $child;
    }
    
    /**
     * Add childs from array
     *
     * @param array $childCollection
     * @return $this
     */
    public function addFromArray(array $childCollection)
    {
        foreach ($childCollection as $child) {
            $this->add($child);
        }
        return $this;
    }

    public function addClass($class)
    {
        $this->appendToAttribute('class', $class);
        return $this;
    }

    public function addStyle($style, $value)
    {
        return $this->appendToAttribute('style', sprintf('%s: %s;', $style, $value));
    }   

    /**
     * Add attribute on tag
     *
     * @param string $attribute
     * @param string $value
     * @param bool $concat
     * @return $this
     */
    public function attribute($attribute, $value)
    {        
        if (is_array($value)) {
            throw new \Exception('Illegal content of value attribute (' . print_r($value, true) . ')');
        }
        $this->attributes[$attribute] = $value;
        return $this;
    }
    
    public function appendToAttribute($attribute, $value)
    {
        $this->attribute($attribute, trim($this->getAttribute($attribute). ' ' . $value));
    }
    
    /**
     * Massive add of attributes on tag
     *
     * @param array $attributes     
     * @return $this
     */
    public function attributes(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->attribute($key, $value);
        }
        return $this;
    }

    public function preBuild()
    {        
    }
    
    /**
     * Build html tag e return string
     *
     * @return string
     */
    protected function build()
    {        
        return TagBuilder::build($this);
    }
        
    /**
     * Static method for create a tag object
     *
     * @param string $tag
     * @param string $id
     * @return \Osynapsy\Html\Tag
     */
    public static function create($tag, $id = null, $class = null)
    {
        return new Tag($tag, $id, $class);
    }

    /**
     * Get html string of tag
     *
     * @return type
     */
    public function get()
    {
        return $this->build();
    }

    public function getAttribute($attributeId)
    {
        return array_key_exists($attributeId, $this->attributes) ? $this->attributes[$attributeId] : null;
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Get $index child from repo
     *
     * @param int $index
     * @return boolean
     */
    public function getChild($index = 0)
    {        
        if (array_key_exists($index, $this->childs)) {
            return $this->childs[$index];
        }
        return false;
    }
    
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Check if tag content is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return count($this->childs) > 0 ? false : true;
    }

    /**
     * Magic method for rendering tag in html
     *
     * @return type
     */
    public function __toString()
    {
        return $this->get();
    }
}
