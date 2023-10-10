<?php

namespace Hornbach\Api\Normalizer;

interface HornbachApiNormalizerInterface
{
    /**
     * @param array<int, array<string, int|float>> $item
     * @return array<int, array<string, int|float>>
     */
    public function normalize(array $item): array;
}