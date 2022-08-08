<div id="m_-5251047833556751164wrapper" dir="ltr" style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody>
        <tr>
            <td align="center" valign="top">
                <div id="m_-5251047833556751164template_header_image"></div>
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                       id="m_-5251047833556751164template_container"
                       style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
                    <tbody>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   id="m_-5251047833556751164template_header"
                                   style="background-color:#004b8b;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
                                <tbody>
                                <tr>
                                    <td id="m_-5251047833556751164header_wrapper"
                                        style="padding:36px 48px;display:block">
                                        <h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff;background-color:inherit">{{ $application_name }}</h1>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="600"
                                   id="m_-5251047833556751164template_body">
                                <tbody>
                                <tr>
                                    <td valign="top" id="m_-5251047833556751164body_content"
                                        style="background-color:#ffffff">
                                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                            <tbody>
                                            <tr>
                                                <td valign="top" style="padding:48px 48px 32px">
                                                    <div id="m_-5251047833556751164body_content_inner"
                                                         style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                                        <p style="margin:0 0 16px">{{ $admin_email ? 'You’ve received the following order from '. $store_name : 'Your Order has been successfully placed.' }}</p>
                                                        <h2 style="color:#004b8b;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
                                                            <a href="{{ $redirect_url }}"
                                                               style="font-weight:normal;text-decoration:underline;color:#004b8b"
                                                               target="_blank"
                                                               data-saferedirecturl="https://www.google.com/url?q={{ $redirect_url }}&amp;source=gmail&amp;ust=1645526407135000&amp;usg=AOvVaw1wxJFMPaZ_Wl7P3qfCVxm5">[Order
                                                                #{{ $order->id }}
                                                                ]</a> [Status : {{ $order->status }}] [Type : {{ $order->order_type }}]
                                                            ({{ date('M d, Y',strtotime($order->created_at)) }})</h2>
                                                        <div style="margin-bottom:40px">
                                                            <table cellspacing="0" cellpadding="6" border="1"
                                                                   style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Product
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Quantity
                                                                    </th>
                                                                    <th scope="col"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Price
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($order->products()->get() as $product)
                                                                    <tr>
                                                                        <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                                                                            {{ $product->inventory->description }}
                                                                            (#{{ $product->inventory->part_number }})
                                                                        </td>
                                                                        <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            {{ $product->quantity }}
                                                                        </td>
                                                                        <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            <span><span>$</span>{{ $product->price * $product->quantity }}</span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th scope="row" colspan="2"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">
                                                                        Subtotal:
                                                                    </th>
                                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">
                                                                        <span><span>$</span>{{ $order->getTotalAmount() }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" colspan="2"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Payment method:
                                                                    </th>
                                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Cash on delivery
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" colspan="2"
                                                                        style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        Total:
                                                                    </th>
                                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                                                                        <span><span>$</span>{{ $order->getTotalAmount() }}</span>
                                                                    </td>
                                                                </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        @if(count($store_address))
                                                            <table id="m_-5251047833556751164addresses" cellspacing="0"
                                                                   cellpadding="0" border="0"
                                                                   style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">
                                                                <tbody>
                                                                <tr>
                                                                    <td valign="top" width="50%"
                                                                        style="text-align:left;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;border:0;padding:0">
                                                                        <h2 style="color:#004b8b;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
                                                                            Billing address</h2>
                                                                        <address
                                                                            style="padding:12px;color:#636363;border:1px solid #e5e5e5">
                                                                            {{ (string)$store_address['address1'] }}
                                                                            <br>
                                                                            {{ (string)$store_address['address2'] }}
                                                                            <br>
                                                                            {{ (string)$store_address['city'] }}
                                                                            <br>
                                                                            {{ (string)$store_address['country'] }}
                                                                            , {{ (string)$store_address['state'] }} {{ (string)$store_address['postal'] }}
                                                                            <br>
                                                                            <a
                                                                                href="tel:{{ (string)$store_address['phone1'] }}"
                                                                                style="color:#004b8b;font-weight:normal;text-decoration:underline"
                                                                                target="_blank">{{ (string)$store_address['phone1'] }}</a><br><a
                                                                                href="tel:{{ (string)$store_address['phone2'] }}"
                                                                                style="color:#004b8b;font-weight:normal;text-decoration:underline"
                                                                                target="_blank">{{ (string)$store_address['phone2'] }}</a>
                                                                            <br><a
                                                                                href="mailto:{{ (string)$store_address['email'] }}"
                                                                                target="_blank">{{ (string)$store_address['email'] }}</a>
                                                                        </address>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                        <p style="margin:0 0 16px">{{ $admin_email ? 'Congratulations on the sale' : 'Congratulations on the order' }}
                                                            .</p>
                                                    </div>
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
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="10" cellspacing="0" width="600"
                       id="m_-5251047833556751164template_footer">
                    <tbody>
                    <tr>
                        <td valign="top" style="padding:0;border-radius:6px">
                            <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                <tbody>
                                <tr>
                                    <td colspan="2" valign="middle" id="m_-5251047833556751164credit"
                                        style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">
                                        <p style="margin:0 0 16px">Powered by {{ $application_name }}</p>
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
</div>
