<?php

namespace Kote\Http;


class RawCookie extends Cookie
{
    /**
     * Sends raw cookie to client.
     */
    public function send()
    {
        setrawcookie(
            $this->getName(),
            $this->getValue(),
            $this->getExpire(),
            $this->getPath(),
            $this->getDomain(),
            $this->getSecure(),
            $this->getHttp()
        );
    }
}