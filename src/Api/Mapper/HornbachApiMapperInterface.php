<?php

namespace Hornbach\Api\Mapper;

interface HornbachApiMapperInterface
{
    /**
     * @param array<int, array<string, int|float>> $apiResponse
     * @return array<int, array<string, int|float>>
     */
    public function cleanupResponseFields(array $apiResponse): array;
}