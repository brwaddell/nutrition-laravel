<?php

namespace App\DataTables;


use App\Patient;
use Laravolt\Avatar\Facade as Avatar;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientDatatable extends DataTable
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
            ->addColumn('image', function ($query) {
                if (isset($query->image)) {
                    return '<img src="' . asset(path_patient_image() . $query->image) . '" height="70" width="90" alt="No Image"/>';
                } else {
                    return '<img src="' . Avatar::create($query->name)->toBase64() . '" height="70" width="90" alt="No Image"/>';
                }
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->diffForHumans(); // human readable format
            })->rawColumns(['image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\PatientDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patient $model)
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
        ->setTableId('patients-table')->addTableClass('table-striped')->autoWidth()
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
           // Button::make('create')->text('Add user')->addClass('btn-primary')->text('<i class="fas fa-plus"></i> Add user '),
            Button::make('colvis')->text('Show/Hide')->addClass('btn-info')->text('<i class="fas fa-eye"></i> Show/hide '),
            Button::make('copy')->addClass('btn-success')->text('<i class="far fa-copy"></i> Copy '),
            Button::make('export')->addClass('btn-warning'),
            Button::make('print')->addClass('btn-primary'),
            // Button::make('reset')->addClass('btn-info'),
            // Button::make('reload')->addClass('btn-default')->text('<i class="fas fa-fw fa-sync"></i> Reload')
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
            //Column::make('id'),
            Column::make('image')->orderable(false)->searchable(false)->printable(true),
            Column::make('first_name'),
            Column::make('email'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Patient_' . date('YmdHis');
    }
}
