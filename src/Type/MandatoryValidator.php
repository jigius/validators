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

class MandatoryValidator extends Validator
{
    protected $errorTpls = ['invalid' => "значение не определено"];

    public function test($value, array $options = [])
    {
        if ($value !== null && $value !== "") {
            // value not empty. Not interesting...
            return null;
        }

        if (!isset($options['trigger']) || !empty($options['trigger'])) {
            // value empty but mandatory!
            $this->setError('invalid', $value, $options);
            return false;
        } else {
            // value empty and not mandatory
            return true;
        }
    }
}
