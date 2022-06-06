<?php

namespace App\DataTables;

use App\Models\Product;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->addColumn('action', 'dashboard.products.btn')
            ->addColumn('name', function ($q) {
                return $q->name;
            })
            ->addColumn('category_id', function ($q) {
                return $q->category->name ?? '';
            })
            ->addColumn('type', function ($q) {
                return __($q->type) ;
            })
            ->addColumn('made_in_order', function ($q) {
                return $q->type == 'made' ? ($q->made_in_order == 0 ? 'انشاء مخزون':'مع البيع') :'--';
            })

            ->rawColumns(['action']);
    }



    public function query()
    {
        return Product::isProduct()->with(['unit', 'category','productFactory','storage_quantity','restaurant_quantity'])->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('products-table')
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
            Column::make('id')->orderable(true)->title('#')->addClass('text-center'),
            Column::make('name')->orderable(false)->title('الاسم')->addClass('text-center'),
            Column::make('category_id')->orderable(true)->title('القسم')->addClass('text-center'),
            Column::make('type')->orderable(true)->title('النوع')->addClass('text-center'),
            Column::make('made_in_order')->orderable(true)->title('طريقة التصنيع')->addClass('text-center'),

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
        return 'Products_' . date('YmdHis');
    }
}
