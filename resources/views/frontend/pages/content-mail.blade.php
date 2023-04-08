<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="container">
        <h3 class="text-center">Hóa đơn mua hàng tại HinShop</h3>
        <h5>Họ tên: {{$name}}</h5>
        <h5>Email: {{$email}}</h5>
        <h5>Số điện thoại: {{$phone}}</h5>
        <h5>Địa chỉ: {{$address}}</h5>
        Số sản phẩm đã mua:
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
            <tr>
                <th scope="row">{{$item->name}}</th>
                <td>{{$item->qty}}</td>
                <td>{{number_format($item->price)}}</td>
                <td>{{ number_format($item->price*$item->qty) }} đ</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <h3>Tổng tiền: {{$total}} đ</h3>
        <h5>Cảm ơn quý khách đã tin tưởng Leoo Shop. Chúc quý khách có một ngày tốt lành !</h5>
    </div>
</body>
</html>
