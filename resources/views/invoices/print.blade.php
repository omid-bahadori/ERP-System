<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پرینت فاکتور</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" type="text/css" />
    <style>
        @media print {
            @page {
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                direction: rtl;
                font-family: 'Vazir', Tahoma, sans-serif;
            }
            .invoice-container {
                width: 210mm;
                padding: 15mm;
                box-sizing: border-box;
                margin: 0 auto;
            }
            .title {
                text-align: center;
                font-size: 32px;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .info-row {
                display: flex;
                justify-content: space-between;
                font-size: 12px;
                margin-bottom: 5px;
            }
            hr {
                margin: 10px 0;
                border: 1px solid #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                table-layout: fixed;
                word-wrap: break-word;
                direction: rtl;
            }
            th, td {
                border: 1px solid #333;
                padding: 6px;
                text-align: right;
                font-size: 12px;
            }
            th {
                background-color: #f2f2f2;
            }
            .customer-info {
                margin-top: 10px;
                font-size: 14px;
            }
            .customer-info p {
                margin: 2px 0;
            }
        }

        body {
            font-family: 'Vazir', Tahoma, sans-serif;
            direction: rtl;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="title">پخش پروتئین کسری</div>

    <div class="info-row">
        <div>تاریخ: {{ \App\Helpers\DateHelper::toJalali($invoice->invoice_date) }}</div>
        <div>شماره فاکتور: {{ $invoice->invoice_number }}</div>
    </div>
    <div class="info-row">
        <div>تلفن: ۰۹۳۵۵۸۲۱۹۱۸</div>
        <div>آدرس: تهران، پاکدشت، شهرک انقلاب، نبش گلستان ۲</div>
    </div>

    <hr>

    <div class="customer-info">
        <p>فاکتور فروش برای: <strong>{{ $invoice->customer->name }}</strong></p>
        @if($invoice->customer->mobile)
            <p>شماره تلفن مشتری: {{ $invoice->customer->mobile }}</p>
        @endif
    </div>

    <table>
        <thead>
        <tr>
            <th>ردیف</th>
            <th>محصول</th>
            <th>تعداد</th>
            <th>قیمت واحد</th>
            <th>تخفیف</th>
            <th>جمع</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoice->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ number_format($item->quantity) }} {{ $item->product->unit ?? '' }}</td>
                <td>{{ number_format($item->unit_price) }} تومان</td>
                <td>{{ number_format($item->discount) }} تومان</td>
                <td>{{ number_format($item->total) }} تومان</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">جمع کل:</td>
            <td colspan="2" class="fw-bold">{{ number_format($invoice->subtotal) }} تومان</td>
        </tr>
        @if($invoice->discount > 0)
            <tr>
                <td colspan="4" class="text-end fw-bold">تخفیف:</td>
                <td colspan="2" class="fw-bold text-danger">- {{ number_format($invoice->discount) }} تومان</td>
            </tr>
        @endif
        <tr>
            <td colspan="4" class="text-end fw-bold fs-5">مبلغ قابل پرداخت:</td>
            <td colspan="2" class="fw-bold fs-5">{{ number_format($invoice->total) }} تومان</td>
        </tr>
        </tfoot>
    </table>
</div>

<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>