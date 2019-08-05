<?php

namespace App\DataTables;

use App\Models\rol;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class rolDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'rols.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\rol $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rol $model)
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
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->addAction(['width' => '120px', 'printable' => false])
        ->parameters([
            'dom'       => 'Bfrtip',
            'stateSave' => true,
            'order'     => [[0, 'desc']],
            'buttons'   => [
                ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
            ],
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
            ['id', 'title' => 'ID', 'data' => 'id'],
            ['id', 'title' => 'Nombre', 'data' => 'name'],
            ['id', 'title' => 'Activo?', 'data' => 'is_active', 'width' => '40px', 'render' => 'function(){
                if(this["is_active"] == 0){
                    return "<span style=\'color:Tomato;\'><i style=\'text-align: center;\' class=\'fas fa-times-circle\'></i></span>";
                    }else{
                     return "<span style=\'color:Dodgerblue;\'><i style=\'text-align: center;\' class=\'fas fa-check-circle\'></i></span>"
                 }
             }']
         ];
     }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'rolsdatatable_' . time();
    }
}
