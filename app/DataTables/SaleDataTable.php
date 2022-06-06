<?php

namespace App\DataTables;

use App\Models\Sale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SaleDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.sales.btn')
            ->addColumn('code', function ($q) {
                return $q->code;
            })
            ->addColumn('created_by', function ($q) {
                return $q->createdBy->name;
            })
            ->addColumn('client_id', function ($q) {
                return $q->client->name ?? 'عميل نقدى';
            })
            ->addColumn('date', function ($q) {
                return $q->date->toDateString();
            })
            ->addColumn('total', function ($q) {
                return number_format($q->total,2);
            })
            ->addColumn('status', function ($q) {
                return __($q->status);
            })
            ->rawColumns(['action']);
    }



    public function query()
    {
        $invoices = Sale::query()->with(['client', 'items','createdBy'])->latest();

        $invoices->when(request()->has('client_id'), function ($q) {
            $q->where('client_id', \request('client_id'));
        });
        $invoices->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('date', [\request('from'), \request('to')]);
        });

        return $invoices;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('sales-table')
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
            Column::make('created_by')->orderable(false)->title('اسم الموظف')->addClass('text-center'),
            Column::make('client_id')->orderable(false)->title('اسم العميل')->addClass('text-center'),
            Column::make('date')->orderable(true)->title('التاريخ')->addClass('text-center'),
            Column::make('total')->orderable(true)->title('الاجمالى')->addClass('text-center'),
            Column::make('status')->orderable(true)->title('الحالة')->addClass('text-center'),

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
        return 'Sales_' . date('YmdHis');
    }
}
