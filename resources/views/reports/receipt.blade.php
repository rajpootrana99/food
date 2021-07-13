<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Bill</title>

    <style>
        hr.style5 {
            background-color: #fff;
            border-top: 2px dashed #8c8b8b;

        }
        td{
            padding:5px;
            text-align:left;
        }
        .mytable td{
            border:1px solid black;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn{
            display:flex;
            justify-content: end;
            align-items: flex-end;
        }
    </style>
</head>
<body>

    <div class="conatiner1" style="width: 20%">

        <h1 class="text-center" style="font-size:12px;">Fast Food</h1>
        <h2 class="text-center" style="font-size:10px;">+92 313 5263526</h2>
        <h3 class="text-center" style="font-size:8px;">Pir Khurshhed Colony, Gulgasht, Multan</h3>
        <hr class="style5">
        <table>
            <tbody>
            <tr>
                <td style="font-weight:bold;font-size:10px;">Date</td>
                <td id="paidfor" style="font-size:10px;">{{ $order->order_date }}</td>
                <td class="" style="font-weight:bold;font-size:10px;">Table # </td>
                <td id="date" style="font-size:10px;">{{ $order->table }}</td>

            </tr>
            <tr>
                <td style="font-weight:bold;font-size:10px;">Bill No.</td>
                <td id="billno" style="font-size:10px;">{{ $order->id }}</td>

            </tr>
            </tbody>
        </table>
        <hr class="style5" >
        <table class="mytable" style="width:100%">
            <?php $total = 0; ?>
            @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->qty }}</td>
                    <td>{{ $product->sale_price*$product->pivot->qty }}</td>
                </tr>
                <?php $total += $product->sale_price*$product->pivot->qty ?>
            @endforeach
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td>{{ $total }}</td>
                </tr>
        </table>
        <br>
        <br>
        <table>
            <tbody>
            <tr>
                <td style="font-weight:bold;font-size:10px;">Prepared By</td>
                <td id="preparedby" style="font-size:10px;">Admin</td>
            </tr>
            </tbody>
        </table>
        <div class="btn">


        </div>

    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
