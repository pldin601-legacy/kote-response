<?php

namespace Kote\Http;


class PlainResponse extends Response
{
    private $content = "";

    public function __construct($content = "") {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    public function write(...$string)
    {
        foreach ($string as $item) {
            $this->content .= $item;
        }
    }

    public function renderContent()
    {
        echo $this->content;
        flush();
    }
}