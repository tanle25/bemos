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
            <h1 class="text-center">Ca??m ??n ba??n ??a?? ??????t ha??ng</h1>
                <h3 class="text-center">ma?? ????n ha??ng cu??a ba??n la??: {{$data->order_code}}</h6>
                <h3 class="mobile-title">Th??ng tin kha??ch ha??ng</h3>
                <div class="content">
                    <div class="col-left">
                        <div class="p-1">
                            <span>Ho?? va?? t??n: {{Auth::user()->last_name.' '. Auth::user()->first_name}}</span>
                        </div>
                        <div  class="p-1">
                            <span>S???? ??i????n thoa??i: {{$data->phone}}</span>
                        </div>
                    </div>
                    <div class="col-right">
                        <div  class="p-1">
                            @if ($data->payment_method ==1)
                            <span>Ph????ng th????c thanh toa??n: Thanh to??n qua Internet Banking</span>
                                @else
                            <span>Ph????ng th????c thanh toa??n: Thanh to??n khi nh????n ha??ng</span>

                            @endif
                        </div>
                        <div  class="p-1">
                            <span>{{$data->address}}</span>
                        </div>
                    </div>
                </div>
                <h3 class="mobile-title">Th??ng tin ????n ha??ng</h3>
                <table style="width:100%">
                    <tr>
                        <th></th>
                      <th>T??n sa??n ph????m</th>
                      <th>Gia??</th>
                      <th>S???? l??????ng</th>
                      <th>Tha??nh ti????n</th>
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
                        <td><img src="http://simbaviet.com/bemos/public/storage/photos/???nh%20S???n%20Ph???m/ht32.jpg" alt=""></td>
                        <td>gh???? pho??ng ch????</td>
                        <td>19.000.000</td>
                          <td>5</td>
                          <td>5</td>
                    </tr> --}}
                  </table>
                  <div class="footer-content">
                    <div class="float-right">
                        <div class="space-botom"> <i>Ti????n ha??ng:</i> </div>
                        <div class="space-botom"> <i>Phi?? v????n chuy????n: </i> </div>
                        <div class="total space-botom"> <b>T????ng c????ng:</b> </div>
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
            <h2>C??ng ty bemos</h2>
            <div><i>Showroom: 234 ???????ng Nguy???n V??n Gi??p, C???u Di???n, Nam T??? Li??m, H?? N???i</i></div>
            <div><i>Nha?? ma??y: L?? A2.10- K??T Thanh H?? B, Cienco 5, C??? Kh??, Thanh Oai, H?? N???i</i></div>
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
