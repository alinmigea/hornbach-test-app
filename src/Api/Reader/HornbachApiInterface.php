<?php

namespace Hornbach\Api\Reader;

interface HornbachApiInterface
{
    /**
     * @return array<int, array<string, int|float>>
     */
    public function getResponse(): array;
}