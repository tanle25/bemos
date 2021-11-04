<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .logo{
            text-align: center;
        }
        .logo img{
            padding: 30px;
        }
        .wrapper{
            padding: 0px 20px 20px 20px;
            margin: 0 auto;
            width: 900px;
            background-color: #E7E9EB;
            min-height: 900px;
        }
        .text-center{
            text-align: center;
        }
        .content{
            display: flex;
            justify-content: space-between;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
        td img{
            height: 100px;
        }
        .main-content {
            padding: 30px;
            background-color: #fff;
        }
        .p-1{
            padding: 10px;
        }
        .footer-content{
            display: flex;
        }
        .float-right{
            padding-right: 15px;
            text-align: right;
            width: 85%;
        }
        .space-botom{
            padding: 5px 0;
        }
        .total {
            font-size: 24px;
            color: #149a13;
            }
        .footer img,svg{
            padding: 10px;
            color: #7a7979;
            width: 30px;
            height: 30px;
        }
        .footer a{
            text-decoration: none;
        }
        .footer{
            margin: 20px 0;
            text-align: center;
        }
        .footer h4,h5{
            margin: 10px auto;
        }
        .social-icon{
            padding: 25px;
        }
        .social-icon .facebook:hover svg {
            border-radius: 50%;
            background-color: blue;
            opacity: .75;
            color: #fff;
        }
        .social-icon .google:hover svg {
            border-radius: 50%;
            background-color: #fff;
            opacity: .75;
            color: crimson;
        }
        .social-icon .skype:hover svg {
            border-radius: 50%;
            background-color: #fff;
            opacity: .75;
            color: #305bd3;
        }
        .social-icon .youtube:hover svg {
            border-radius: 50%;
            background-color: #fff;
            opacity: .75;
            color: crimson;
        }
        @media screen and (max-width: 576px) {
            .wrapper{
                width: 100%;
            }
            .mobile-title{
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
            <div class="logo" style="text-align: center">
                <img src="https://bemos.vn/images/thumbs/0001910_Bemos-logo-225.png" alt="" style="padding: 30px">
            </div>
        <div class="main-content">
            <h1 class="text-center">Cảm ơn bạn đã đặt hàng</h1>
                <h3 class="text-center">mã đơn hàng của bạn là: {{$data->order_code}}</h6>
                <h3 class="mobile-title">Thông tin khách hàng</h3>
                <div class="content">
                    <div class="col-left">
                        <div class="p-1">
                            <span>Họ và tên: {{Auth::user()->last_name.' '. Auth::user()->first_name}}</span>
                        </div>
                        <div  class="p-1">
                            <span>Số điện thoại: {{$data->phone}}</span>
                        </div>
                    </div>
                    <div class="col-right">
                        <div  class="p-1">
                            @if ($data->payment_method ==1)
                            <span>Phương thức thanh toán: Thanh toán qua Internet Banking</span>
                                @else
                            <span>Phương thức thanh toán: Thanh toán khi nhận hàng</span>

                            @endif
                        </div>
                        <div  class="p-1">
                            <span>{{$data->address}}</span>
                        </div>
                    </div>
                </div>
                <h3 class="mobile-title">Thông tin đơn hàng</h3>
                <table style="width:100%">
                    <tr>
                        <th></th>
                      <th>Tên sản phẩm</th>
                      <th>Giá</th>
                      <th>Số lượng</th>
                      <th>Thành tiền</th>
                    </tr>
                    @foreach ($data->cart as $cart )
                    <tr>
                        <td><img src="{{$cart->options['avatar']}}" alt=""></td>
                        <td>{{$cart->name}}</td>
                        <td>{{number_format($cart->price)}}</td>
                          <td>{{$cart->qty}}</td>
                          <td>{{number_format($cart->price * $cart->qty)}}</td>
                      </tr>
                    @endforeach

                    {{-- <tr>
                        <td><img src="http://simbaviet.com/bemos/public/storage/photos/Ảnh%20Sản%20Phẩm/ht32.jpg" alt=""></td>
                        <td>ghế phòng chờ</td>
                        <td>19.000.000</td>
                          <td>5</td>
                          <td>5</td>
                    </tr> --}}
                  </table>
                  <div class="footer-content">
                    <div class="float-right">
                        <div class="space-botom"> <i>Tiền hàng:</i> </div>
                        <div class="space-botom"> <i>Phí vận chuyển: </i> </div>
                        <div class="total space-botom"> <b>Tổng cộng:</b> </div>
                    </div>
                      <div>
                          @php
                              $total = intval($data->shipping) + intval( Str::remove(',',$data->cart_total));
                          @endphp
                        <div class="space-botom"> <i><b>{{$data->cart_total}}&#x20AB;</b> </i> </div>
                        <div class="space-botom"> <i> <b>{{number_format($data->shipping)}}&#x20AB;</b> </i> </div>
                        <div class="total space-botom"> <b>{{number_format($total)}}&#x20AB;</b> </div>
                      </div>

                  </div>

        </div>
        <div class="footer">
            <h2>Công ty bemos</h2>
            <div><i>Showroom: 234 đường Nguyễn Văn Giáp, Cầu Diễn, Nam Từ Liêm, Hà Nội</i></div>
            <div><i>Nhà máy: Lô A2.10- KĐT Thanh Hà B, Cienco 5, Cự Khê, Thanh Oai, Hà Nội</i></div>
            <div class="social-icon">
                <a class="p-1 facebook" href=""> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Facebook_icon_%28black%29.svg/1200px-Facebook_icon_%28black%29.svg.png" alt=""></a>
                <a class="p-1 google" href=""> <img src="https://uxwing.com/wp-content/themes/uxwing/download/10-brands-and-social-media/google.png" alt=""> </a>
                <a class="p-1 skype" href=""> <img src="https://image.flaticon.com/icons/png/512/0/112.png" alt=""> </a>
                <a class="p-1 youtube" href=""> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/YouTube_play_buttom_dark_icon_%282013-2017%29.svg/1200px-YouTube_play_buttom_dark_icon_%282013-2017%29.svg.png" alt=""> </a>
            </div>

        </div>

    </div>
</body>
</html>
