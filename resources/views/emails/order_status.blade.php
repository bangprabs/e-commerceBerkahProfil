<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css') }}">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

    </style>
    <style type="text/css">

    :root {
        --card-line-height: 1.2em;
        --card-padding: 1em;
        --card-radius: 0.5em;
        --color-green: #f3a73c;
        --color-gray: #e2ebf6;
        --color-dark-gray: #c4d1e1;
        --radio-border-width: 2px;
        --radio-size: 1.5em;
        }

        .grid {
        display: grid;
        grid-gap: var(--card-padding);
        margin: 0 auto;
        max-width: 60em;
        padding: 0;
        }
        @media (min-width: 42em) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
        }

        .card {
        background-color: #fff;
        border-radius: 10px;
        position: relative;
        margin-top: 20px;
        }
        .card:hover {
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
        }

        .radio {
        font-size: inherit;
        margin: 0;
        position: absolute;
        right: calc(var(--card-padding) + var(--radio-border-width));
        top: calc(var(--card-padding) + var(--radio-border-width));
        }

        @supports (-webkit-appearance: none) or (-moz-appearance: none) {
        .radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff;
            border: var(--radio-border-width) solid var(--color-gray);
            border-radius: 50%;
            padding: 0px;
            cursor: pointer;
            height: var(--radio-size);
            outline: none;
            transition: background 0.2s ease-out, border-color 0.2s ease-out;
            width: var(--radio-size);
        }
        .radio::after {
            border: var(--radio-border-width) solid #fff;
            border-top: 0;
            border-left: 0;
            content: "";
            display: block;
            height: 0.75rem;
            left: 25%;
            position: absolute;
            top: 50%;
            transform: rotate(45deg) translate(-50%, -50%);
            width: 0.375rem;
        }
        .radio:checked {
            background: var(--color-green);
            border-color: var(--color-green);
        }

        .card:hover .radio {
            border-color: var(--color-dark-gray);
        }
        .card:hover .radio:checked {
            border-color: var(--color-green);
        }
        }
        .plan-details {
        border: var(--radio-border-width) solid var(--color-gray);
        border-top-left-radius: var(--card-radius);
        border-top-right-radius: var(--card-radius);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        padding: var(--card-padding);
        transition: border-color 0.2s ease-out;
        }

        .card:hover .plan-details {
        border-color: var(--color-dark-gray);
        }

        .radio:checked ~ .plan-details {
        border-color: var(--color-green);
        }

        .radio:focus ~ .plan-details {
        box-shadow: 0 0 0 2px var(--color-dark-gray);
        }

        .radio:disabled ~ .plan-details {
        color: var(--color-dark-gray);
        cursor: default;
        }

        .radio:disabled ~ .plan-details .plan-type {
        color: var(--color-dark-gray);
        }

        .card:hover .radio:disabled ~ .plan-details {
        border-color: var(--color-gray);
        box-shadow: none;
        }

        .card:hover .radio:disabled {
        border-color: var(--color-gray);
        }

        .plan-type {
        color: var(--color-green);
        font-size: 1.5rem;
        font-weight: bold;
        line-height: 1em;
        }

        .plan-cost {
        font-size: 2.5rem;
        font-weight: bold;
        padding: 0.5rem 0;
        }

        .slash {
        font-weight: normal;
        }

        .plan-cycle {
        font-size: 2rem;
        font-variant: none;
        border-bottom: none;
        cursor: inherit;
        text-decoration: none;
        }

        .hidden-visually {
        border: 0;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        white-space: nowrap;
        width: 1px;
        }</style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We're thrilled to have you here! Get ready to dive into your new account. </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#FFA73B" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Halo, {{$orderDetails['name']}}</h1> <img src="{{ url('https://i.ibb.co/W3dj4kR/log-admin.png') }}" style="display: block; border: 0px; width: 60%;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0; text-align: justify">Terima kasih telah membeli produk kami, Pesanan anda statusnya di perbarui menjadi : </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 0px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <b>Status Pemesanan</b> : {{$order_status}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Nomor Order</b> : #{{$order_id}}
                                                </td>
                                            </tr>
                                            @if (!empty($courier_name) && !empty($tracking_number))
                                            <tr>
                                                <td>
                                                    Produk Dikirim Oleh <strong>{{$courier_name}}</strong> dengan Nomor Pengiriman <strong>{{$tracking_number}}</strong>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>
                                                    <table style="width: 100%;" cellpadding="5" cellspacing="5" style="border">
                                                        <tr bgcolor="" style="background-color: #f3a73c !important; border-radius: 10px; color: #fff; text-align: center">
                                                            <td>Nama Produk</td>
                                                            <td>Kode Produk</td>
                                                            <td>Ukuran Produk</td>
                                                            <td>Warna Produk</td>
                                                            <td>Jumlah Produk</td>
                                                            <td>Harga Produk</td>
                                                        </tr>
                                                        @foreach ($orderDetails['orders_products'] as $order)
                                                        <tr bgcolor="#fff" style="">
                                                                <td>{{$order['product_name']}}</td>
                                                                <td>{{$order['product_code']}}</td>
                                                                <td>{{$order['product_size']}}</td>
                                                                <td>{{$order['product_color']}}</td>
                                                                <td>{{$order['product_qty']}}</td>
                                                                <td>@currency($order['product_price'])</td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="5" align="right">Biaya Pengiriman</td>
                                                            <td>@currency($orderDetails['shipping_charges']) </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" align="right">Kupon Diskon</td>
                                                            <td>@currency($orderDetails['coupon_amount']) </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" align="right">Total Keseluruhan</td>
                                                            <td>@currency($orderDetails['grand_total'])</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <span><b>Penerima</b> : {{$orderDetails['name']}}</span><br>
                                                        <span><b>Nomor Telepon</b> : {{$orderDetails['mobile']}}</span><br>
                                                        <span><b>Alamat</b> : {{$orderDetails['address']}}, {{$orderDetails['city']}}, {{$orderDetails['state']}}, {{$orderDetails['country']}}</span>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Apabila ada kesalahan mohon, Hubungi Kontak Kami Dibawah</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">berkahprofil@gmail.com</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Salam,<br>Berkah Profil Commerce</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">
                    <tr>
                        <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Butuh Bantuan Lebih ?</h2>
                            <p style="margin: 0;"><a href="#" target="_blank" style="color: #FFA73B;">Kami siap menemukan jalan keluar</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                            <p style="margin: 0;">Jika email ini mengganggu, jangan ragu untuk <a href="#" target="_blank" style="color: #111111; font-weight: 700;">Berhenti berlangganan</a>.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
    <script src="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
