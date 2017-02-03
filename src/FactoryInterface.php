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

interface FactoryInterface
{
    public static function createInstance($type);
}
