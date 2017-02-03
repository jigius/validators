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

use jigius\validators\FactoryInterface;
use jigius\validators\Entry;

class Factory implements FactoryInterface
{
    public static function createInstance($type)
    {
        $className = "jigius\\validators\\Type\\" . ucfirst(strtolower($type)) . 'Validator';
        $iface = "\\jigius\\validators\\ValidatorInterface";
        if (!is_subclass_of($className, $iface)) {
            throw new \InvalidArgumentException("${className} has not implementing ${iface} interface");
        }
        $validator = new $className();
        $validator->setLogger(Entry::getInstance()->getlogger());
        return $validator;
    }
}
