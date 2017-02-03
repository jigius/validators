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

class IntegerValidator extends Validator
{
    protected $errorTpls = array(
        'tooSmall' => "значение(%(value)d) меньше разрешенного(%(minval)d)",
        'tooBig' => "значение(%(value)d) больше разрешенного(%(maxval)d)",
        'invalid' => "значение(%(value)s) не целое число"
    );

    public function test($value, array $options = [])
    {
        if ($value === null || $value === "") {
            return true;
        }

        if (!preg_match('/^[-+]?\d+$/', $value)) {
            $this->setError('invalid', $value, $options);
            return false;
        }
        $value = (int)$value;

        $minval = null;
        if (isset($options['minval']) && $options['minval'] !== null) {
            $minval = (int)$options['minval'];
            if ($minval > $value) {
                $this->setError('tooSmall', $value, $options);
                return false;
            }
        }

        $maxval = null;
        if (isset($options['maxval']) && $options['maxval'] !== null) {
            $maxval = (int)$options['maxval'];
            if ($maxval < $value) {
                $this->setError('tooBig', $value, $options);
                return false;
            }
        }
        return true;
    }
}
