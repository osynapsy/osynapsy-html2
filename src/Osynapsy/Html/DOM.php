<?php
namespace Osynapsy\Html;

/**
 * Description of DOM
 *
 * @author Pietro Celeste <pietro.celeste@gmail.com>
 */
class DOM
{
    protected static $dom = [];
    protected static $require = [];
    protected static $actions = [];

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

    public static function getAllComponents()
    {
        return self::$dom;
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
    public static function requireJs($file, $namespace = null)
    {
        self::requireFile($file, 'js', $namespace);
    }

    /**
     * Append required js code to list of required initialization
     *
     * @param $code js code to append at html page;
     * @return void
     */
    public static function requireScript($code)
    {
        self::$require[] = [$code, 'script'];
    }

    /**
     * Append required css to list of required File
     *
     * @param $file web path of css file;
     * @return void
     */
    public static function requireCss($file, $namespace = null)
    {
        self::requireFile($file, 'css', $namespace);
    }

    protected static function requireFile($rawPathFile, $type, $namespace = null)
    {
        $osyPathPrefix = !empty($namespace) && $rawPathFile[0] !== '/' ? self::buildScriptWebPathWithComposer($namespace, $rawPathFile) : '';
        $item = [$rawPathFile, $type, $osyPathPrefix . $rawPathFile];
        if (!in_array($item, self::$require)) {
            self::$require[] = $item;
        }        
    }

    protected static function buildScriptWebPathWithComposer($objectNamespace)
    {
        $class = new \ReflectionClass($objectNamespace);
        $packageName = self::getComposerPackageName($class->getNamespaceName(), pathinfo($class->getFileName())['dirname']);        
        return sprintf('/assets/%s/', sha1($packageName));
    }

    protected static function getComposerPackageName($namespace, $classpath)
    {
        $composerPath = realpath(str_replace(array_map(function ($elem) { return '/'.$elem;}, explode('\\',$namespace)), '', $classpath).'/../composer.json');
        if (!file_exists($composerPath)) {
            throw new \Exception(sprintf('Composer file not found in %s', $composerPath));
        }
        $composerParams = json_decode(file_get_contents($composerPath), true);
        return key($composerParams['autoload']['psr-4']);
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

    public static function addEventListener($event, $sourceId, $action)
    {
        self::$actions[$sourceId.'.'.$event] = $action;
    }
}
