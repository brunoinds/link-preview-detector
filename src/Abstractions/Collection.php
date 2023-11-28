<?php

namespace Brunoinds\LinkPreviewDetector\Abstractions;

abstract class Collection{
    protected $data;

    public function getAll()
    {
        return $this->data;
    }
}