<?php

declare(strict_types=1);

namespace Magma\Utility;

use Magma\Base\Exception\BaseInvalidArgumentException;

class Sanitizer
{

    /**
     * Sanitize class
     * Global sanitization and filtering. the method accepts an array of argument which will
     * be check to determine whether the value is of a 'string, integer or an array'. Uses
     * native PHP filtering. Incase an argument is not supplied the method will the use
     * JSON data stream. if content is coming in via an API
     *
     * @param array $dirtyData - an associative array of key value pairs
     * @return array
     * @throws BaseInvalidArgumentException
     */
    public static function clean(array $dirtyData) : array
    {
        $input = [];
        if (count($dirtyData) > 0) {
            foreach ($dirtyData as $key => $value) {
                if (!isset($key)) {
                    throw new BaseInvalidArgumentException('Invalid key');
                }
                if (!is_array($value)) {
                    $value = trim(stripslashes($value));
                }

                switch ($value) {
                    case is_int($value) :
                        $input[$key] = isset($value) ? filter_var($value, FILTER_SANITIZE_NUMBER_INT) : '';
                        break;
                    case is_string($value) :
                        $input[$key] = isset($value) ? filter_var($value, FILTER_SANITIZE_STRING) : '';
                        break;
                    case is_array($value) :
                        if (count($value) > 0) {
                            foreach ($value as $arrKey => $arrValue) {
                                if (isset($arrKey) && $arrKey !='') {
                                    if (is_int($arrValue)) {
                                        $input[$arrKey] = isset($arrValue) ? filter_var($arrValue, FILTER_SANITIZE_NUMBER_INT) : '';
                                    } else {
                                        $input[$arrKey] = isset($arrValue) ? filter_var($value, FILTER_SANITIZE_STRING) : '';
                                    }
                                }
                            }
                        }
                        break;
                }
            }
            if (isset($input) && $input !='') {
                return $input;
            }
        }
    }

}