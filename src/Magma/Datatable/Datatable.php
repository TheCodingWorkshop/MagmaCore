<?php

declare(strict_types=1);

namespace Magma\Datatable;

use Magma\Base\Exception\BaseUnexpectedValueException;

class Datatable extends AbstractDatatable
{

    protected string $element = '';

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    public function create(string $dataColumnString, array $dataRepository = [], array $sortController = []) : self
    {
        $this->dataColumnObject = new $dataColumnString();
        if (!$this->dataColumnObject instanceof DatatableColumnInterface) {
            throw new BaseUnexpectedValueException($dataColumnString . ' is not a valid data column object.');
        }
        $this->dataColumns = $this->dataColumnObject->columns();
        $this->sortController = $sortController;
        $this->getRepositoryParts($dataRepository);
        return $this;

    }

    private function getRepositoryParts(array $dataRepository) : void
    {
        list($this->dataOptions, $this->currentPage, $this->totalPages, $this->totalRecords, $this->direction, $this->sortDirection, $this->tdClass, $this->tableColumn, $this->tableOrder) = $dataRepository;
    }

    public function table() : ?string
    {
        extract($this->attr);

        $this->element .= $before;
        if (is_array($this->dataColumns) && count($this->dataColumns) > 0) {
            if (is_array($this->dataOptions) && $this->dataOptions !=null) {
                $this->element .= '<table id="' . (isset($table_id) ? $table_id : '') . '" class="'. implode(' ', $table_class) .'">';
                    $this->element .= ($show_table_thead) ? $this->tableGridElements($status) : '';
                    $this->element .= '<tbody>';
                        foreach ($this->dataOptions as $row) {
                            $this->element .= '<tr>';
                                foreach ($this->dataColumns as $column) {
                                    if (isset($column['show_column']) && $column['show_column'] != false) {
                                        $this->element .= '<td class="' . $column['class'] . '">';
                                            if (is_callable($column['formatter'])) {
                                                $this->element .= call_user_func_array($column['formatter'], [$row]);
                                            } else {
                                                $this->element .= (isset($row[$column['db_row']]) ? $row[$column['db_row']] : '');
                                            }
                                        $this->element .= '</td>';
                                    }
                                }
                            $this->element .= '</tr>';
                        }
                    $this->element .= '</tbody>';
                    $this->element .= ($show_table_tfoot) ? $this->tableGridElements($status, true) : '';
                $this->element .= '</table>';
            }
        }

        return $element;
        
    }

    private function tableGridElements(string $status, bool $inFoot = false) : string
    {
        $element = sprintf('<%s>', ($inFoot) ? 'tfoot' : 'thead');
            $element .= '<tr>';
                foreach ($this->dataColumns as $column) {
                    if (isset($column['show_column']) && $column['show_column'] != false) {
                        $element .= '<th>';
                        $element .= $this->tableSorting($column, $status);
                        $element .= '</th>';
                    }
                }
            $element .= '</tr>';
        $element = sprintf('</%s>', ($inFoot) ? 'tfoot' : 'thead');

        return $element;
    }

    private function tableSorting(array $column, string $status) : string
    {
        $element = '';
        if (isset($column['sortable']) && $column['sortable'] != false) {
            $element .= '<a class="uk-link-reset" href="' . ($status) ? '?status=' . $status . '&column=' . $column['db_row'] . '&order=' . $this->sortDirection . '' : '&column=' . $column['db_row'] . '&order=' . $this->sortDirection . '' . '">';
            $element .= $column['dt_row'];
            $element .= '<i class="fas fa-sort' . ($this->tableColumn == $column['db_row'] ? '-' . $this->direction : '') . '"></i>';
            $element .= '</a>';
        } else {
            $element .= $column['dt_row'];
        }
        return $element;
    }

    public function pagination() : ?string
    {return '';}


}