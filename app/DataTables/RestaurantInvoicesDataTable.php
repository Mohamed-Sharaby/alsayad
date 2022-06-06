<?php

namespace App\DataTables;

use App\Models\StorageInvoice;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RestaurantInvoicesDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.restaurant-invoices.btn')
            ->addColumn('code', function ($q) {
                return $q->code;
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
        return StorageInvoice::out()->with('inventory')->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('restaurantinvoices-table')
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
            Column::make('code')->orderable(false)->title('رقم الفاتورة')->addClass('text-center'),
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
        return 'RestaurantInvoices_' . date('YmdHis');
    }
}
