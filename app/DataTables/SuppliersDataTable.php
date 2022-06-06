<?php

namespace App\DataTables;

use App\Models\Supplier;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SuppliersDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.suppliers.btn')
            ->addColumn('supplier_id', function ($q) {
                return $q->name;
            })
            ->addColumn('phone', function ($q) {
                return $q->phone ?? '';
            })
            ->addColumn('debt', function ($q) {
                return number_format($q->storage_invoices_sum_remaining,2);
            })
            ->rawColumns(['action']);
    }



    public function query()
    {
        return Supplier::withSum('storageInvoices','remaining')->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('suppliers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
               // Button::make('export'),
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
            Column::make('supplier_id')->orderable(false)->title('اسم المورد')->addClass('text-center'),
            Column::make('phone')->orderable(true)->title('الجوال')->addClass('text-center'),
            Column::make('debt')->orderable(true)->title('المديونية')->addClass('text-center'),

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
        return 'Suppliers_' . date('YmdHis');
    }
}
