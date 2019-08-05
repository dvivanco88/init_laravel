<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {

        return $model->newQuery()->leftJoin('enterprises', 'users.enterprise_id', '=', 'enterprises.id')
        ->leftJoin('rols', 'users.rol_id', '=', 'rols.id')
        ->select('users.*','enterprises.name as enterprise_name', 'rols.name as rol_name');
        
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
        ->addAction(['width' => '80px', 'title' => 'Acción'])                    
        ->parameters([
            $this->getBuilderParameters(),
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
            ['id', 'title' => 'Imagen', 'data' => 'image', 'render' => 'function(){
                if(this["image"] == "no_photo"){
                    return "<img src=\'../../images/no_photo.jpg\' style=\'width: 40px; height: 40px;\' class=\'user-image img-circle img-responsive\' alt=\'User Image\'>";
                    }else{
                     return "<img src=\'../../uploads/users/"+ this["id"] + "/" + this["image"] + "\' style=\'width: 40px; height: 40px;\' class=\'user-image img-circle img-responsive\' alt=\'User Image\'>"
                 }
             }'],
             ['id', 'title' => 'Nombre', 'data' => 'name'],
             ['id', 'title' => 'Rol', 'data' => 'rol_name', 'name' => 'rols.name', 'render' => 'function(){
                console.log(this["rol_name"]);
                if(this["rol_name"] == "Admin"){
                    return "<span class=\'badge btn-primary\'>" + this["rol_name"] + "</span>";
                    }else{
                        if(this["rol_name"] == "" || this["rol_name"] == null){
                            return "<span class=\'badge btn-danger\'>Sin asignar</span>";        
                            }else{
                                return "<span class=\'badge btn-info\'>" + this["rol_name"] + "</span>";      
                            }

                        }
                    }'],
                    ['id', 'title' => 'Email', 'data' => 'email'],
                    ['id', 'title' => 'Empresa', 'data' => 'enterprise_name', 'name' => 'enterprises.name'],
                    ['id', 'title' => 'Creado', 'data' => 'created_at'],
                    ['id', 'title' => 'Actualizado', 'data' => 'updated_at'],
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
        return 'Users_' . date('YmdHis');
    }
}
