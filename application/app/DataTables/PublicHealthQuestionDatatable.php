<?php

namespace App\DataTables;

use App\PublicHealthForm;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PublicHealthQuestionDatatable extends DataTable
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
            ->addIndexColumn()

            ->editColumn('created_at', function ($request) {
                return $request->created_at->diffForHumans(); // human readable format
            })
            ->addColumn(
                'action',
                '<a class="btn btn-info" href="{{route("publichealthquestion.create")}}"><i class="ik ik-edit"></i></a>
                <a class="btn btn-danger" onclick="return deleteConfirmation()" href="{{route("user.delete", $id)}}"><i class="ik ik-trash-2"></i></a> '
            )->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\PublicHealthQuestionDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PublicHealthForm $model)
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
            ->setTableId('users-table')->addTableClass('table-striped')->autoWidth()
            ->addIndex()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->serverSide(true)
            ->dom('lBfrtip')
            ->orderBy(1)
            ->language([
                'processing' => '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            ])
            ->buttons(
                Button::make('colvis')->text('Show/Hide')->addClass('btn-info')->text('<i class="fas fa-eye"></i> Show/hide '),
                Button::make('copy')->addClass('btn-success')->text('<i class="far fa-copy"></i> Copy '),
                Button::make('export')->addClass('btn-warning'),
                Button::make('print')->addClass('btn-primary'),
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
            Column::make('No')->orderable(false)->searchable(false),
            Column::make('name'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('table-actions'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PublicHealthQuestion_' . date('YmdHis');
    }
}
