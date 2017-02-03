<?php
/*
 * This file is part of the validators library.
 *
 * (c) Eduard Chernikov <jigius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jigius\validators;

use jigius\validators\Factory;
use jigius\validators\FactoryInterface;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;

class Entry
{
    use LoggerAwareTrait;

    protected static $instance;

    protected $factory;

    protected function __construct()
    {
        $this->factory = $this->setFactory();
        $this->logger = new NullLogger();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setFactory(FactoryInterface $factory = null)
    {
        if ($this->factory === null) {
            $this->factory = new Factory();
        } else {
            $this->factory = $factory;
        }
        return $this;
    }

    public function getFactory()
    {
        return $this->factory;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

}
