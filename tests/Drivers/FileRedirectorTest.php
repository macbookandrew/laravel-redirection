<?php

namespace SiroDiaz\Redirection\Tests\Drivers;

use SiroDiaz\Redirection\Drivers\FileRedirector;
use SiroDiaz\Redirection\Tests\TestCase;

class FileRedirectorTest extends TestCase
{
    /** @test */
    public function it_inserts_a_path_redirection_and_redirects_a_request_with_default_status_code(): void
    {
        $this->app['config']->set('redirection.driver', 'config');
        $this->app['config']->set('redirection.urls', [
            'old-url' => 'new/url',
        ]);

        $this->get('old-url')->assertRedirect('new/url');
    }

    /** @test */
    public function it_inserts_a_path_redirection_and_redirects_a_request_with_a_custom_status_code(): void
    {
        $this->app['config']->set('redirection.driver', 'config');
        $this->app['config']->set('redirection.urls', [
            'old-url' => [
                'new_url' => 'new/url',
                'status_code' => 302,
            ],
        ]);

        $response = $this->get('old-url');
        $response->assertRedirect('new/url');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
