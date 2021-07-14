<?php

namespace App\DataTables\Admin;

use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActivityLogDataTable extends DataTable
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
            ->eloquent($query->with(['causer']))
            ->addColumn('action', 'admin.activity-log.actions')
            ->addColumn('causer_name', function($row){
                return $row->causer ? $row->causer->name : '';
            })
            ->addColumn('when', function($row){
                $when = \Carbon\Carbon::make($row->created_at);
                return $when->diffForHumans();
            })
            ->rawColumns(['action']);       
    }

    /**
     * Get query source of dataTable.
     *
     * @param Spatie\Activitylog\Models\Activity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Activity $model)
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
            ->setTableId('activity-log-table')
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
            Column::make('id')->title('Activity Id'),
            Column::make('causer_name')->title('User'),
            Column::make('description')->title('Action'),
            Column::make('subject_type')->title('Model'),
            Column::make('when')->title('When'),
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
        return 'ActivityLog_' . date('YmdHis');
    }
}
