<?php

declare(strict_types=1);

namespace Magma\Base;

use Magma\Base\Exception\BaseInvalidArgumentException;
use Magma\Utility\Sanitizer;

class BaseEntity
{

    /**
     * BaseEntity constructor.
     * Assign the key which is now a property of this object to its array value
     * 
     * @param array $dirtyData
     * @return void
     * @throws BaseInvalidArgumentException
     */
    public function __construct(array $dirtyData)
    {
        if (empty($dirtyData)) {
            throw new BaseInvalidArgumentException('No data was submitted');
        }
        if (is_array($dirtyData)) {
            foreach ($this->cleanData($dirtyData) as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Return the sanitize post data back to the main constructor
     * 
     * @param array $dirtyData
     * @return array
     * @throws BaseInvalidArgumentException
     */
    private function cleanData(array $dirtyData) : array
    {
        $cleanData = Sanitizer::clean($dirtyData);
        if ($cleanData) {
            return $cleanData;
        }
    }

}