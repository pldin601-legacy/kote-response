<?php

namespace Kote\Http;


class EmptyResponse extends Response
{
    public function render()
    {
        // Don't render anything
    }

    protected function renderContent()
    {
        // Don't render content
    }
}