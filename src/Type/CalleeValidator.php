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

class CalleeValidator extends Validator
{
    protected $errorTpls = [
        'invalid' => "Неверное значение"
    ];

    public function test($value, array $options = [])
    {
        if ($value === null || $value === "" || (is_array($value) && count($value) == 0)) {
            return true;
        }

        if (empty($options || isset($options['callee']) && !is_callable($options['callee']))) {
            return false;
        }

        if (($res = call_user_func_array($options['callee'], array($value, $options))) === false) {
            throw new \InvalidArgumentException('error occurs');
        }
        if (!$res) {
            $this->setError('invalid', $value, $options);
                return false;
        }
        return true;
    }
}
