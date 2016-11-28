<?php

use LasseHaslev\LaravelFieldable\FieldType;
use LasseHaslev\LaravelFieldable\Traits\Fieldable;
use LasseHaslev\LaravelFieldable\Traits\Valueable;
use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Mocced classes
 */
class FieldableClass extends FieldType { use Fieldable; }
class NonValueableClass extends FieldType {};
class FieldableAndValueable extends FieldType{ use Valueable, Fieldable; }
class ValueableClass extends FieldType { use Valueable; }

/**
 * Class TestCase
 * @author Lasse S. Haslev
 */
class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/../database/migrations'),
        ]);
        $this->withFactories(__DIR__.'/../database/factories');
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            'LasseHaslev\LaravelSortable\Providers\ServiceProvider',
            'LasseHaslev\LaravelFieldable\Providers\ServiceProvider',
        ];
    }

}
