<?php
/*
 * This file is part of the validators library.
 *
 * (c) Eduard Chernikov <jigius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jigius\validators\Type;

use jigius\validators\Validator;

class RegexpValidator extends Validator
{
    protected $errorTpls = [
        'nomatch' => "значение (%(value)s) не соответствует шаблону (%(pattern)s)",
        'invalid' => "параметры заданы неверно"
    ];

    public function test($value, array $options = [])
    {
        if ($value === null || $value === "") {
            return true;
        }

        if (!isset($options['pattern'])) {
            $this->setError('invalid', $value, $options);
            return false;
        }
        if (($res = @preg_match($options['pattern'], $value)) === false) {
            throw new \InvalidArgumentException('error occurs');
        }
        if (!$res) {
            $this->setError('nomatch', $value, $options);
            return false;
        }
        return true;
    }
}
