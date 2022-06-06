<?php

namespace App\DataTables;

use App\Models\Client;
use App\Models\Product;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.clients.btn')
            ->addColumn('name', function ($q) {
                return $q->name;
            })
            ->addColumn('phone', function ($q) {
                return $q->phone;
            })
            ->addColumn('points', function ($q) {
                return $q->points;
            })
            ->addColumn('debt', function ($q) {
                return number_format($q->sales_sum_remaining, 2);
            })
            ->rawColumns(['action']);
    }


    public function query()
    {
        return Client::with('sales')->withSum('sales', 'remaining')->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('clients-table')
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
            Column::make('id')->orderable(true)->title('#')->addClass('text-center'),
            Column::make('name')->orderable(false)->title('الاسم')->addClass('text-center'),
            Column::make('phone')->orderable(true)->title('الجوال')->addClass('text-center'),
            Column::make('points')->orderable(true)->title('عدد النقاط')->addClass('text-center'),
            Column::make('debt')->orderable(true)->title('مديونية العميل')->addClass('text-center'),


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
        return 'Clients_' . date('YmdHis');
    }
}
