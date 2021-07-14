<?php

namespace App\DataTables\Admin;

use App\Models\Applicant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApplicationsDataTable extends DataTable
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
            ->eloquent($query->with(['disabilityType', 'applicationStatus']))
            ->addColumn('action', 'admin.applications.actions')
            ->addColumn('disability_type', function($row){
                return $row->disabilityType ? $row->disabilityType->type : '';
            })
            ->addColumn('application_status', function($row){
                return $row->applicationStatus ? $row->applicationStatus->title : '';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Applicant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Applicant $model)
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
            ->setTableId('applications-table')
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
            Column::make('cnic')->title('CNIC'),
            Column::make('name')->title('Applicant Name'),
            Column::make('phone_no')->title('Phone / Mobile'),
            Column::make('gender')->title('Gender'),
            Column::make('disability_type')->title('Type of disability'),
            Column::make('nature_of_disability')->title('Nature of disability'),
            Column::make('cause_of_disability')->title('Cause of disability'),
            Column::make('application_status')->title('Status'),
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
        return 'Applications_' . date('YmdHis');
    }
}
