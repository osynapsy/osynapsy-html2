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

/**
 * Description of TagBuilder
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class TagBuilder
{
    const TAG_WITHOUT_CLOSURE = ['input', 'img', 'link', 'meta'];
    const DUMMY_TAG = 'dummy';

    public static function build(Tag $tagObject, $depth = 0)
    {
        $tagObject->preBuild();
        return $tagObject->getTag() === self::DUMMY_TAG ? self::buildBodyOfTag($tagObject, $depth - 1) : self::buildTag($tagObject, $depth);
    }

    protected static function buildTag($tagObject, $depth)
    {
        $tag = $tagObject->getTag();
        $indentation = self::buildIndedation($depth);
        $result = $indentation;
        $result .= sprintf('<%s%s>', $tag, self::buildAttributes($tagObject));
        if (!in_array($tag, self::TAG_WITHOUT_CLOSURE)) {
            $result .= self::buildBodyOfTag($tagObject, $depth);
            $result .= self::indendationBeforeClosingTag($tagObject, $indentation);
            $result .= self::buildClosingTag($tag);
        }
        return $result . (empty($depth) ? '' : PHP_EOL);
    }

    protected static function buildIndedation($depth)
    {
        return $depth > 0 ? str_repeat("\t", $depth) : '';
    }

    protected static function buildAttributes($tagObject)
    {
        $attributes = [];
        foreach ($tagObject->getAttributes() as $attribute => $value) {
            if (is_object($value) && !method_exists($value, '__toString')) {
                $attributes[] = 'error="Attribute value is object ('.get_class($value).')"';
                continue;
            } elseif (is_array($value)) {
                $attributes[] = 'error="Attribute value is array"';
                continue;
            }
            $attributes[] = sprintf('%s="%s"', $attribute, htmlspecialchars($value ?? '', ENT_QUOTES));
        }
        return empty($attributes) ? '' : ' '.implode(' ',$attributes);
    }

    protected static function buildBodyOfTag($tagObject, $depth, $carriageReturn = PHP_EOL)
    {
        $result = '';
        foreach ($tagObject->getChilds() as $i => $child) {
            if ($i === 0 && $child instanceof Tag) {
                $result .= $carriageReturn;
            }
            $result .= $child instanceof Tag ? TagBuilder::build($child, $depth + 1) : $child;
        }
        return $result;
    }

    protected static function indendationBeforeClosingTag($tagObject, $indentation)
    {
        $childs = $tagObject->getChilds();
        return (!empty($childs) && $childs[0] instanceof tag) ? $indentation : '';
    }

    protected static function buildClosingTag($tag)
    {
        return "</{$tag}>";
    }
}
