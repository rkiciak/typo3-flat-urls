<?php
declare(strict_types = 1);

namespace Pagemachine\FlatUrls\Tests\Unit\Url;

/*
 * This file is part of the Pagemachine Flat URLs project.
 */

use Nimut\TestingFramework\TestCase\UnitTestCase;
use Pagemachine\FlatUrls\Page\Page;
use Pagemachine\FlatUrls\Page\PageOverlay;
use Pagemachine\FlatUrls\Url\FlatUrlBuilder;
use Prophecy\Argument;
use TYPO3\CMS\Core\Charset\CharsetConverter;

/**
 * Testcase for Pagemachine\FlatUrls\Url\FlatUrlBuilder
 */
class FlatUrlBuilderTest extends UnitTestCase
{
    /**
     * @var FlatUrlBuilder
     */
    protected $flatUrlBuilder;

    /**
     * Set up this testcase
     */
    protected function setUp()
    {
        /** @var CharsetConverter|\Prophecy\Prophecy\ObjectProphecy */
        $charsetConverter = $this->prophesize(CharsetConverter::class);
        $charsetConverter->specCharsToASCII('utf-8', Argument::type('string'))->willReturnArgument(1);

        $this->flatUrlBuilder = new FlatUrlBuilder($charsetConverter->reveal());
    }

    /**
     * @test
     */
    public function buildsFlatUrlForPages()
    {
        $page = $this->prophesize(Page::class);
        $page->getUrlIdentifier()->willReturn(10);
        $page->getTitle()->willReturn('The Page');

        $this->assertEquals('10/the-page', $this->flatUrlBuilder->buildForPage($page->reveal()));
    }

    /**
     * @test
     */
    public function buildsFlatUrlForPageOverlays()
    {
        $pageOverlay = $this->prophesize(PageOverlay::class);
        $pageOverlay->getUrlIdentifier()->willReturn(10);
        $pageOverlay->getTitle()->willReturn('Die Seite');

        $this->assertEquals('10/die-seite', $this->flatUrlBuilder->buildForPage($pageOverlay->reveal()));
    }

    /**
     * @test
     * @dataProvider values
     *
     * @param string $pageTitle
     * @param string $expected
     */
    public function convertsTitleToPathSegment(string $pageTitle, string $expected)
    {
        $page = $this->prophesize(Page::class);
        $page->getUrlIdentifier()->willReturn(10);
        $page->getTitle()->willReturn($pageTitle);

        $this->assertEquals($expected, $this->flatUrlBuilder->buildForPage($page->reveal()));
    }

    /**
     * @return array
     */
    public function values(): array
    {
        return [
            'simple' => ['Foo BAR', '10/foo-bar'],
            'with dashes' => ['a - b -- c -', '10/a-b-c'],
            'with special characters' => ['a & b / c + d? e, f!', '10/a-b-c-d-e-f'],
        ];
    }
}
