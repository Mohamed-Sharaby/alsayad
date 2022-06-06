<?php

namespace App\DataTables;

use App\Models\Product;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MaterialsDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.materials.btn')
            ->addColumn('name', function ($q) {
                return $q->name;
            })
            ->addColumn('type', function ($q) {
                return __($q->type) ;
            })
            ->addColumn('unit_id', function ($q) {
                return optional($q->unit)->name;
            })
            ->addColumn('buying_price', function ($q) {
                return number_format($q->buying_price,2);
            })
            ->addColumn('quantity', function ($q) {
              //  return $q->start_quantity;
                return $q->quantity;
            })
            ->rawColumns(['action']);
    }



    public function query()
    {
        return Product::materials()->with(['unit', 'category','storage_quantity'])->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('materials-table')
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
            Column::make('id')->orderable(true)->title('#')->addClass('text-center'),
            Column::make('name')->orderable(false)->title('الاسم')->addClass('text-center'),
            Column::make('type')->orderable(true)->title('النوع')->addClass('text-center'),
            Column::make('unit_id')->orderable(true)->title('الوحدة')->addClass('text-center'),
            Column::make('buying_price')->orderable(true)->title('السعر')->addClass('text-center'),
            Column::make('quantity')->orderable(true)->title('الكمية')->addClass('text-center'),

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
        return 'Materials_' . date('YmdHis');
    }
}
