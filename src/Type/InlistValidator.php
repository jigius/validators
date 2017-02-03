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

class InlistValidator extends Validator
{
    protected $errorTpls = [
        'nomatch' => "значение (%(value)s) не допустимо",
        'invalid' => "параметры заданы неверно"
    ];

    public function test($value, array $options = [])
    {
        if ($value === null || $value === "") {
            return true;
        }

        if (!isset($options['negative'])) {
            $options['negative'] = false;
        }

        if (!isset($options['list']) || !is_array($options['list'])) {
            $this->setError('invalid', $value, $options);
            return false;
        }
        if (!($options['negative'] xor in_array($value, $options['list']))) {
            $this->setError('nomatch', $value, $options);
            return false;
        }
        return true;
    }
}
