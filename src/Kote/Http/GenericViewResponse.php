<?php

namespace Kote\Http;


class GenericViewResponse extends Response
{
    private $viewFileName;

    private $contextData = [];

    private static $viewDirectoryPrefix = "";

    public function __construct($viewFileName, array $context = [], $viewDirectoryPrefix = "")
    {
        $this->setViewFileName($viewFileName);
        $this->setContextData($context);
        $this->setViewDirectoryPrefix($viewDirectoryPrefix);
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function bindVariable($key, $value)
    {
        $this->contextData[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public static function getViewDirectoryPrefix()
    {
        return self::$viewDirectoryPrefix;
    }

    /**
     * @param string $viewDirectoryPrefix
     */
    public static function setViewDirectoryPrefix($viewDirectoryPrefix)
    {
        self::$viewDirectoryPrefix = $viewDirectoryPrefix;
    }

    /**
     * @return mixed
     */
    public function getViewFileName()
    {
        return $this->viewFileName;
    }

    /**
     * @param mixed $viewFileName
     * @return $this
     */
    public function setViewFileName($viewFileName)
    {
        $this->viewFileName = $viewFileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getViewFullPath()
    {
        return rtrim($this->getViewDirectoryPrefix(), "/") . "/" . $this->getViewFileName();
    }

    /**
     * @return mixed
     */
    public function getContextData()
    {
        return $this->contextData;
    }

    /**
     * @param mixed $contextData
     * @return $this
     */
    public function setContextData($contextData)
    {
        $this->contextData = $contextData;
        return $this;
    }

    public function renderContent()
    {
        renderGenericView($this->getViewFullPath(), $this->getContextData());
    }
}

/**
 * @param $view
 * @param array $context
 */
function renderGenericView($view, array $context)
{
    extract($context);

    unset($context);

    /** @noinspection PhpIncludeInspection */
    include $view;
}

/**
 * @param $stringToEscape
 * @param int $flags
 * @return string
 */
function e($stringToEscape, $flags = ENT_COMPAT | ENT_HTML401)
{
    return htmlentities($stringToEscape, $flags);
}
