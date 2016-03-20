<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 15.03.2016
 * Time: 13:10
 */

namespace Kote\Http;


class StreamResponse extends Response
{
    const PIPE_BUFFER_SIZE = 4096;

    private $streamHandle;

    public function __construct($streamHandle = null, $statusCode = StatusCode::HTTP_OK)
    {
        if ("stream" != $type = get_resource_type($streamHandle)) {
            throw new \InvalidArgumentException("Invalid stream handle passed into response.");
        }

        $this->setStreamHandle($streamHandle);
        $this->setStatusCode($statusCode);
    }

    public function setStreamHandle($fp)
    {
        $this->streamHandle = $fp;

        return $this;
    }

    public function renderContent()
    {
        while ($data = fread($this->streamHandle, self::PIPE_BUFFER_SIZE)) {
            echo $data;
            flush();
        }
    }
}