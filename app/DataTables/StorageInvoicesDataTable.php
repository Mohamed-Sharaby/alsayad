<?php

namespace App\DataTables;

use App\Models\StorageInvoice;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StorageInvoicesDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.storage-invoices.btn')
            ->addColumn('code', function ($q) {
                return $q->code;
            })
            ->addColumn('supplier_id', function ($q) {
                return $q->supplier->name ?? '';
            })
            ->addColumn('date', function ($q) {
                return $q->date->toDateString();
            })
            ->addColumn('is_finished', function ($q) {
                return $q->status;
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
        $invoices = StorageInvoice::query()->in()->whereNotNull('supplier_id')->with(['supplier', 'inventory'])->latest();
        $invoices->when(\request('supplier_id'), function ($q) {
            $q->where('supplier_id', \request('supplier_id'));
        });
        $invoices->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('date', [\request('from'), \request('to')]);
        });
        return $invoices;
       // return StorageInvoice::in()->with(['supplier', 'inventory'])->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('storageinvoices-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
             //   Button::make('export'),
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
            Column::make('supplier_id')->orderable(false)->title('اسم المورد')->addClass('text-center'),
            Column::make('date')->orderable(true)->title('التاريخ')->addClass('text-center'),
            Column::make('is_finished')->orderable(true)->title('الحالة')->addClass('text-center'),

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
        return 'StorageInvoices_' . date('YmdHis');
    }
}
