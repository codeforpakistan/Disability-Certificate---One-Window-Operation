<?php

namespace App\DataTables\Admin;

use App\Models\DisabilityType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DisabilityTypesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'admin.disability-types.actions')
            ->addColumn('eligible_for_special_cnic', function($row){
                if($row->eligible_for_scnic == 1) {
                    return '<span class="badge bg-green">Yes</span>';
                } else {
                    return '<span class="badge bg-red">No</span>';
                }
            })
            ->rawColumns(['action', 'eligible_for_special_cnic']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DisabilityType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DisabilityType $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                // Button::make('export'),
                Button::make('print'),
                // Button::make('reset')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('Id'),
            Column::make('type')->title('Disability'),
            Column::make('eligible_for_special_cnic')->title('Eligible for Special CNIC'),
            Column::computed('action')->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(90),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DisabilityTypes_' . date('YmdHis');
    }
}
