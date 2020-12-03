<?php

declare(strict_types=1);

namespace Magma\Datatable;

use Magma\Base\Exception\BaseInvalidArgumentException;
use Magma\Datatable\DatatableInterface;

abstract class AbstractDatatable implements DatatableInterface
{

    protected const TABLE_PROPERTIES = [
        'status' => '',
        'orderby' => '',
        'table_class' => [],
        'table_id' => '',
        'show_table_thead' => true,
        'show_table_tfoot' => false,
        'before' => '<div>',
        'after' => '</div>'
    ];

    protected const COLUMNS_PARTS = [
        'db_row' => '',
        'dt_row' => '',
        'class' => '',
        'show_column' => true,
        'sortable' => false,
        'formatter' => ''
    ];

    protected array $attr = [];

    public function __construct(array $attributes)
    {
        if ($attributes) {
            $this->attr = array_merge(self::TABLE_PROPERTIES, $attributes);
        } else {
            $this->attr = self::TABLE_PROPERTIES;
        }
        foreach ($this->attr as $key => $value) {
            if (!$this->validAttributes($key, $value)) {
                $this->validAttributes($key, self::TABLE_PROPERTIES[$key]);
            }
        }
    }

    private function validAttributes(string $key, $value) : void
    {
        if (empty($key)) {
            throw new BaseInvalidArgumentException('Inavlid or empty attribute key. Ensure the key is present and of the correct data type ' . $value);
        }
        switch ($key) {
            case 'status' :
            case 'orderby' :
            case 'table_id' :
            case 'before' :
            case 'after' :
                if (!is_string($value)) {
                    throw new BaseInvalidArgumentException('Invalid argument type ' . $value . ' should be a string');
                }
                break;
            case 'show_table_thead' :
            case 'show_table_tfoot' :
                if (!is_bool($value)) {
                    throw new BaseInvalidArgumentException('Invalid argument type ' . $value . ' should be a boolean');
                }
                break;
            case 'table_class' :
                if (!is_array($value)) {
                    throw new BaseInvalidArgumentException('Invalid argument type ' . $value . ' should be a array');
                }
                break;
        }
        $this->attr[$key] = $value;
    }
}