<?php
namespace Osynapsy\Html;



/**
 * Description of DOM
 *
 * @author peter
 */
class DOM
{
    const ASSET_ROOT = '/assets/vendor/osynapsy/';
    
    protected static $dom = [];
    protected static $require = [];
    
    public static function append($id, Tag $component)
    {
        self::$dom[$id] = $component;
    }
    
    /**
     * Return component through his id
     *
     * @param $id name of component to return;
     * @return object
     */
    public static function getById($id)
    {
        return self::$dom[$id] ?? null;
    }
    
    /**
     * Return list of required file (css, js etc) for correct initialization of component
     *
     * @return array
     */
    public static function getRequire()
    {
        return self::$require;
    }
    
    /**
     * Append required js file to list of required file
     *
     * @param $file web path of file;
     * @return void
     */
    public static function requireJs($file)
    {
        self::requireFile($file, 'js');
    }

    /**
     * Append required js code to list of required initialization
     *
     * @param $code js code to append at html page;
     * @return void
     */
    public static function requireJsCode($code)
    {
        self::$require[] = [$code, 'script'];
    }

    /**
     * Append required css to list of required File
     *
     * @param $file web path of css file;
     * @return void
     */
    public static function requireCss($file)
    {
        self::requireFile($file, 'css');
    }
    
    protected static function requireFile($file, $type)
    {
        $filePrefix = $file[0] === '/' ? '' : self::ASSET_ROOT;        
        $item = [$filePrefix . $file, $type];
        if (in_array($item, self::$require)) {
            return;
        }        
        self::$require[] = $item;
    }

    protected static function requireAssetFile($file, $type)
    {
        if (!array_key_exists($type, self::$require)) {
            self::$require[$type] = [];
        } elseif (in_array($file, self::$require[$type])) {
            return;
        }
        if ($type === 'jscode') {
            self::$require[$type][] = $file;
            return;
        }
        self::$require[$type][] = $file;
    }
    
    public function setJavascript($code)
    {
        self::$require['jscode'] = [$code];
    }
}
