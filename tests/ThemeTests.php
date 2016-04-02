<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThemeTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->theme = app('Displore\Machete\Theme\Theme');
    }

    public function test_it_can_get_and_set_a_theme()
    {
        $this->theme->set('bootstrap');

        $this->assertEquals('bootstrap', $this->theme->get());
    }

    public function test_it_can_get_the_default_theme_from_config()
    {
        Config::shouldReceive('get')
                ->once()
                ->with('machete.default')
                ->andReturn('master');

        $this->assertEquals('master', $this->theme->getDefault());
    }
    public function test_it_can_set_and_get_the_default_theme()
    {
        $this->theme->setDefault('bootstrap');

        $this->assertEquals('bootstrap', $this->theme->getDefault());
    }
}
