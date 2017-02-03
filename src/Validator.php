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

use jigius\utils\Strings;

use Psr\Log\LoggerTrait;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

abstract class Validator implements ValidatorInterface, LoggerAwareInterface, LoggerInterface
{
    use LoggerTrait;
    use LoggerAwareTrait;

    protected $error;

    protected $errorTpls = [];

    abstract public function test($value, array $options = []);

    final protected function initializeErrorTpls(array $aa)
    {
        foreach ($aa as $k => $v) {
            $this->errorTpls[$k] = $v;
        }
    }

    protected function setError($errKey, $value, array $options = [])
    {
        if (isset($options['errorTpls']) && is_array($options['errorTpls'])) {
            $this->initializeErrorTpls($options['errorTpls']);
        }
        $options['value'] = $value; // add key with current value that has been tested
        $this->error = Strings::interpolation($this->errorTpls[$errKey], $options);
    }

    final public function getError()
    {
        return $this->error;
    }

    public function log($level, $message, array $context = [])
    {
        $message = get_called_class() . " " . $message;
        $this->logger->log($message, $context);
    }
}
