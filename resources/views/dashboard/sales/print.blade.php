<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فاتورة</title>
    <style>
        * {
            direction: rtl;
        }

        .toPrint {
            /* border: 1px solid red; */
            width: 7cm;
            margin: auto;
            padding: 5px;
            box-sizing: border-box;
        }

        .toPrint .upper-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
        }

        .toPrint .upper-info > p {
            margin: 0;
            font-size: 12px;
            text-align: center;
            width: 100%;
        }

        .toPrint .upper-info .details {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .toPrint .upper-info .details p {
            margin: 0;
            font-size: 12px;
            line-height: 15px;
        }

        .toPrint table {
            margin: 0 auto;
        }

        .toPrint table th {
            font-size: 10px;
            text-align: center;
        }

        .toPrint table td {
            font-size: 10px;
            text-align: center;
        }

        .toPrint .bill-summary {
            padding: 0 20px;
        }

        .toPrint .bill-summary .details {
            display: flex;
            justify-content: space-between;
        }

        .toPrint .bill-summary .details p {
            margin: 0;
            font-size: 12px;
            line-height: 15px;
        }

        .toPrint.copyright {
            text-align: center;
            font-size: 11px;
            margin-top: 0;
        }

        @media print {
            .toPrint {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>


<div style="width: 100%">
    <div id="" class="toPrint hide">
        <div>
            {!! getsetting('invoice_top') !!}
        </div>
        <div class="upper-info">
            <p>فاتورة رقم {{$sale->code}}</p>
            <div class="details">
                <p>اسم العميل</p>
                <p>{{$sale->client->name ?? 'عميل نقدى'}} </p>
            </div>
            <div class="details">
                <p>حالة الدفع</p>
                <p>{{ __($sale->status) }}</p>
            </div>
            <div class="details">
                <p>تاريخ الفاتورة</p>
                <p> {{$sale->date->toDateString()}} </p>
            </div>
            <!-- <div class="details">
              <p>البائع</p>
              <p>.....</p>
            </div> -->
        </div>
        <hr/>
        <table>
            <tr>
                <th>م</th>
                <th>الصنف</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>الطبخ</th>
                <th>سعر الطبخ</th>
                <th>الاجمالي</th>
            </tr>
            <!-- loop over products -->
            @foreach($sale->items->load(['product','cooking']) as $index => $item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$item->product->name}}</td>
                    <td>{{number_format($item->product_price,2)}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->cooking->name ?? 'لا يوجد'}}</td>
                    <td>{{number_format($item->cooking_price,2) }}</td>
                    <td>{{number_format(($item->product_price * $item->quantity) + $item->cooking_price ,2) }}</td>
                </tr>
            @endforeach
        </table>
        <hr/>
        <div class="bill-summary">
            <div class="details">
                <p>الاجمالي</p>
                <p> {{$itemsPrice}}</p>
            </div>
            <div class="details">
                <p>ضريبة القيمة المضافة 14%</p>
                <p>{{$sale->tax}}</p>
            </div>
            <div class="details">
                <p>اجمالي الفاتورة</p>
                <p>{{number_format($sale->total,2)}}</p>
            </div>
            <div class="details">
                <p>المدفوع نقدي</p>
                <p>{{number_format($sale->received,2)}}</p>
            </div>
            <div class="details">
                <p>المدفوع من النقاط</p>
                <p>{{ $sale->is_points == 1 ? $sale->points_paid : 0 }}</p>
            </div>
            <div class="details">
                <p>المتبقي</p>
                <p>
                    @if($sale->is_points == 1)
                        {{$sale->status == 'paid' ? 0 : number_format($sale->remaining-$sale->points_paid,2) }}
                    @else
                        {{$sale->status == 'paid' ? 0 : number_format($sale->remaining,2) }}
                    @endif
                </p>
            </div>
        </div>

        <div class="">
            {!! getsetting('invoice_bottom') !!}
        </div>

        <div style="text-align: center;">
            {{QrCode::size(100)->generate(route('printInvoice',$sale->uuid))}}
        </div>
        <p style="text-align: center;">Powered by Panorama Al-Qassim</p>
    </div>
</div>
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
 <script>
    $(document).ready(function () {
        if($(window).width() > 425)
        {
            window.print();
        }
    });
</script>
</body>
</html>
