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

class StringValidator extends Validator
{
    protected $errorTpls = [
        'tooShort' => "значение(%(value)s) слишком короткое(<%(minlen)d)",
        'tooLong' => "значение(%(value)s) больше разрешенного(>%(maxlen)d)",
    ];

    public function test($value, array $options = [])
    {
        if ($value === null || $value === "") {
            return true;
        }

        $value = (string)$value;

        $minlen = null;
        if (isset($options['minlen']) && $options['minlen'] !== null) {
            $minlen = (int)$options['minlen'];
            if ($minlen > mb_strlen($value)) {
                $this->setError('tooShort', $value, $options);
                return false;
            }
        }

        $maxlen = null;
        if (isset($options['maxlen']) && $options['maxlen'] !== null) {
            $maxlen = (int)$options['maxlen'];
            if ($maxlen < mb_strlen($value)) {
                $this->setError('tooLong', $value, $options);
                return false;
            }
        }
        return true;
    }
}
