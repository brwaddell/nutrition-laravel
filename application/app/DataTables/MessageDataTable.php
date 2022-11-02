<?php

namespace App\DataTables;

use App\Message;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class MessageDataTable extends DataTable
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
        ->addColumn('user', function($request) {
            return $request->user->name;
        })
        ->addColumn(
            'action',
            '<a class="btn btn-warning text-white" type="button" data-toggle="modal" data-target="#exampleModalCenter{{$id}}">
            <i class="fas fa-eye"></i>
        </a>
             '
        )->rawColumns(['description', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Message $model)
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
                    ->setTableId('message-table')->addTableClass('table-striped')->autoWidth()
                    ->addIndex()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->serverSide(true)
                    ->dom('lBfrtip')
                    ->orderBy(1)
                    ->language([
                        'processing' => '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('subject'),
            Column::make('attachment'),
            Column::make('user'),
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
        return 'Message_' . date('YmdHis');
    }
}
