<?php

namespace Tests\Feature;

use Tests\TestCase;

class BreadcrumbsViewTest extends TestCase
{
    public function test_single_level_page_shows_no_breadcrumb()
    {
        $html = view('partials.breadcrumbs', [
            'breadcrumbs' => collect([(object) ['title' => 'Dashboard', 'url' => '/']]),
        ])->render();

        $this->assertSame('', trim($html));
    }

    public function test_nested_page_links_parents_and_ends_with_current_page()
    {
        $html = view('partials.breadcrumbs', [
            'breadcrumbs' => collect([
                (object) ['title' => 'Master Data', 'url' => '/master'],
                (object) ['title' => 'Detail', 'url' => '/master/1'],
            ]),
        ])->render();

        $this->assertStringContainsString('<a href="/master" class="text-muted text-hover-primary">Master Data</a>', $html);
        $this->assertStringContainsString('<li class="breadcrumb-item text-gray-700">Detail</li>', $html);
        $this->assertStringNotContainsString('href="/master/1"', $html);
    }
}
