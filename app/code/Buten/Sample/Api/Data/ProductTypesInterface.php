<?php

declare(strict_types=1);

namespace Buten\Sample\Api\Data;

/**
 * Interface ProductTypesInterface
 * @package Buten\Sample\Api\Data
 */
interface ProductTypesInterface
{
    const ID = 'entitty_id';
    const TYPE = 'type';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     */
    public function setType(string $type): void;
}
