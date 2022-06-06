<?php

namespace App\DataTables;

use App\Models\Inventory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InventoriesDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.inventories.btn')
            ->addColumn('code', function ($q) {
                return $q->code;
            })
            ->addColumn('created_by', function ($q) {
                return $q->createdBy->name;
            })
            ->addColumn('date', function ($q) {
                return $q->date->toDateString();
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StorageInvoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Inventory::with('createdBy')->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('inventories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
              //  Button::make('export'),
                Button::make('print'),
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
           // Column::make('id')->orderable(true)->title('#')->addClass('text-center'),
            Column::make('code')->orderable(true)->title('رقم الجرد')->addClass('text-center'),
            Column::make('created_by')->orderable(true)->title('القائم بالجرد')->addClass('text-center'),
            Column::make('date')->orderable(true)->title('التاريخ')->addClass('text-center'),

            Column::computed('action')
                ->title('العمليات')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inventory_' . date('YmdHis');
    }
}
