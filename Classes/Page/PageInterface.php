<?php
declare(strict_types = 1);

namespace Pagemachine\FlatUrls\Page;

/*
 * This file is part of the Pagemachine Flat URLs project.
 */

interface PageInterface
{
    /**
     * @return int
     */
    public function getUid(): int;

    /**
     * @return int
     */
    public function getPid(): int;

    /**
     * @return int
     */
    public function getUrlIdentifier(): int;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getPathSegment(): string;

    /**
     * @param string $pathSegment
     * @return void
     */
    public function setPathSegment(string $pathSegment);
}
