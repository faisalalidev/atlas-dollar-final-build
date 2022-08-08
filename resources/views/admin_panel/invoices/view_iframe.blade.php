<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Email Receipt</title>


</head>
<body>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Order confirmation </title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,900);
    body { margin: 0; padding: 0; background: #fff; }
    div, p, a, li, td { -webkit-text-size-adjust: none; }
    .ReadMsgBody { width: 100%; background-color: #ffffff; }
    .ExternalClass { width: 100%; background-color: #ffffff; }
    body { width: 100%; height: 100%; background-color: #fff; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
    html { width: 100%; }
    p { padding: 0 !important; margin-top: 0 !important; margin-right: 0 !important; margin-bottom: 0 !important; margin-left: 0 !important; }
    .visibleMobile { display: none; }
    .hiddenMobile { display: block; }

    @media only screen and (max-width: 1000px) {
        body { width: auto !important; }
        table[class=fullTable] { width: 96% !important; clear: both; }
        table[class=fullPadding] { width: 85% !important; clear: both; }
        table[class=col] { width: 45% !important; }
        .erase { display: none; }
    }

    @media only screen and (max-width: 420px) {
        table[class=fullTable] { width: 100% !important; clear: both; }
        table[class=fullPadding] { width: 85% !important; clear: both; }
        table[class=col] { width: 100% !important; clear: both; }
        table[class=col] td { text-align: left !important; }
        .erase { display: none; font-size: 0; max-height: 0; line-height: 0; padding: 0; }
        .visibleMobile { display: block !important; }
        .hiddenMobile { display: none !important; }
    }
</style>


<!-- Header -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tr class="hiddenMobile">
                    <td height="40"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>

                <tr>
                    <td>
                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                                        <tbody>
                                        <tr>
                                            <td align="left"> <img src="{{ asset($app_settings['logo']) }}" height="60" alt="logo" border="0" /></td>
                                        </tr>
                                        <tr class="hiddenMobile">
                                            <td height="40"></td>
                                        </tr>
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; color: #5b5b5b; font-family: 'Arial', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                                <strong style="font-size: 19px;color: #000000;">ATLAS DIAMOND, INC.</strong>
                                                <br><strong style="color: #000000;">10550 W. SAM HOUSTON PARKWAY S.HOUSTON, TX 77099</strong><br><br>
                                                PH: 281-564-8900&nbsp;&nbsp;&nbsp;FAX: 281-564-8710
                                                <br>sales@atlasdiamond.biz
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                        <tbody>
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td height="5" width="100"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="font-size: 30px;font-weight: bold; font-family: 'Arial', sans-serif; line-height: 1; vertical-align: top; text-align: right;">
                                                Invoice
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr class="hiddenMobile">
                                            <td height="50"></td>
                                        </tr>
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Invoice No
                                            </td>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;font-weight:bold;" width="80">
                                                {{ $data->invoice_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Date
                                            </td>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; font-weight:bold;">
                                                {{ date('M d, Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Reg ID
                                            </td>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; font-weight:bold;">
                                                {{ $data->invoice_customer }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Net Terms
                                            </td>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; font-weight:bold;">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Date Ordered
                                            </td>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; font-weight:bold;">
                                                {{ date('M d, Y',strtotime($data->created_at)) }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- /Header -->
<!-- Information -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
    <tbody>
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                <tr class="hiddenMobile">
                    <td height="40"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>
                <tr>
                    <td>
                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <td height="1" style="background: #e3e3e3;" colspan="4"></td>
                            </tr>
                            <tr class="hiddenMobile">
                                <td height="40"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="30"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="33.33%" border="0" cellpadding="0" cellspacing="0" align="left" class="col">

                                        <tbody>
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Arial', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                <strong>SHIP TO</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; padding-right:15px; display:inline-block;">
                                                <strong style="color: #000000;">{{ $data->billedTo[0]->address ? $data->billedTo[0]->address : '' }} ({{ $data->billedTo[0]->name }}) </strong><br>
                                                {{ $data->billedTo[0]->city ?  $data->billedTo[0]->city.',' : '' }}
                                                {{ $data->billedTo[0]->postal_zip_code ? $data->billedTo[0]->postal_zip_code.',' : '' }}
                                                {{ $data->billedTo[0]->state ? $data->billedTo[0]->state.',' : '' }} {{ $data->billedTo[0]->country ? $data->billedTo[0]->country : '' }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <table width="33.33%" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                                        <tbody style="padding-right:15px;">
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Arial', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                <strong>BILL TO</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 14px; font-family: 'Arial', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; padding-right:15px; display:inline-block;">
                                                <strong style="color: #000000;">{{ $data->billedTo[0]->address ? $data->billedTo[0]->address : '' }} ({{ $data->billedTo[0]->name }}) </strong><br>
                                                {{ $data->billedTo[0]->city ?  $data->billedTo[0]->city.',' : '' }}
                                                {{ $data->billedTo[0]->postal_zip_code ? $data->billedTo[0]->postal_zip_code.',' : '' }}
                                                {{ $data->billedTo[0]->state ? $data->billedTo[0]->state.',' : '' }} {{ $data->billedTo[0]->country ? $data->billedTo[0]->country : '' }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Information -->
<!-- Order Details -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
    <tbody>
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                <tr class="hiddenMobile">
                    <td height="60"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="40"></td>
                </tr>
                <tr>
                    <td>
                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    LINE
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    ITEM
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" width="30%" align="left">
                                    DESCRIPTION
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    CS. PACK
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    PIECE PRICE
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    LIST PRICE
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    ORDERED
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    SHIPPED
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    PIECES
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 5px 7px 0px;" align="left">
                                    TOTAL LIST
                                </th>
                                <th style="font-size: 12px; font-family: 'Arial', sans-serif; color: #1e2b33; font-weight: bold; line-height: 1; vertical-align: top; padding: 0 0 7px;" align="right">
                                    TOTAL
                                </th>
                            </tr>
                            <tr>
                                <td height="1" style="background: #bebebe;" colspan="11"></td>
                            </tr>
                            <tr>
                                <td height="10" colspan="11"></td>
                            </tr>
                            @foreach($data->products as $line => $product)
                            <tr>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $line + 1 }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $product->inventory->part_number }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $product->description }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $product->inventory->in_stock }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $product->inventory->price }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">${{ $product->price }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $product->ordered }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ $product->ordered }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">0</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;padding-right: 8px;">{{ addCurrencyToPrice((double)$product->price * (int)$product->ordered) }}</td>
                                <td style="font-size: 15px; font-family: 'Arial', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align: right;">{{ addCurrencyToPrice((double)$product->price * (int)$product->ordered) }}</td>
                            </tr>
                            <tr>
                                <td height="1" colspan="11" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Order Details -->
<!-- Total -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
    <tbody>
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                    <td>
                        <!-- Table Total -->
                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="40%" border="0" cellpadding="0" cellspacing="0" align="right" class="fullPadding">
                                        <tbody>
                                        <tr>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 26px; vertical-align: top; text-align:right; ">
                                                Gross
                                            </td>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #000; line-height: 26px; vertical-align: top; text-align:right; white-space:nowrap;font-weight: bold;" width="80">
                                                {{ addCurrencyToPrice($data->invoice_sub_total) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 26px; vertical-align: top; text-align:right; ">
                                                Tax Collected
                                            </td>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #000; line-height: 26px; vertical-align: top; text-align:right; white-space:nowrap;font-weight: bold;" width="80">
                                                {{ addCurrencyToPrice($data->invoice_tax_total) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 26px; vertical-align: top; text-align:right; ">
                                                Net Payment Due
                                            </td>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #000; line-height: 26px; vertical-align: top; text-align:right; white-space:nowrap;font-weight: bold;" width="80">
                                                {{ $data->total_amount }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="40%" border="0" cellpadding="0" cellspacing="0" align="left" class="fullPadding">
                                        <tbody>
                                        <tr>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 26px; vertical-align: top; text-align:right; ">
                                                Total Pieces
                                            </td>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #000; line-height: 26px; vertical-align: top; text-align:right; white-space:nowrap;font-weight:bold;" width="80">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #646a6e; line-height: 26px; vertical-align: top; text-align:right; ">
                                                Quantity
                                            </td>
                                            <td style="font-size: 16px; font-family: 'Arial', sans-serif; color: #000; line-height: 26px; vertical-align: top; text-align:right; font-weight:bold;">
                                                {{ $data->totalQuantity() }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- /Table Total -->
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Total -->

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">

    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tr>
                    <td>
                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr class="hiddenMobile">
                                <td height="40"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="30"></td>
                            </tr>
                            <tr>
                                <td height="1" style="background: #e3e3e3;" colspan="4"></td>
                            </tr>
                            <tr class="hiddenMobile">
                                <td height="40"></td>
                            </tr>
                            <tr class="visibleMobile">
                                <td height="30"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 18px; color: #000000; font-family: 'Arial', sans-serif; line-height: 18px; vertical-align: top; text-align: left;font-weight:bold;padding-bottom: 10px;">
                                    Make all checks payable to ATLAS DIAMOND, INC.
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 18px; color: #5b5b5b; font-family: 'Arial', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                    Thank you for your business!
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="spacer">
                    <td height="50"></td>
                </tr>

            </table>
        </td>
    </tr>
</table>
<!-- partial -->

</body>
</html>
