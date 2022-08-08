<html>

<head>

    <title>{{ $page_title }} | {{ str_replace(' ','',$app_settings['application_name']) }}</title>

    <meta name="keywords" content="{{ $app_settings['keywords'] }}"/>
    <meta name="description" content="{{ $app_settings['description'] }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($app_settings['fav_icon']) }}">

    <link rel="preload" href="{{ asset('web_assets/bulk_order/vendor/fontawesome-free/webfonts/fa-regular-400.html') }}"
          as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('web_assets/bulk_order/vendor/fontawesome-free/webfonts/fa-solid-900.html') }}"
          as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('web_assets/bulk_order/vendor/fontawesome-free/webfonts/fa-brands-400.html') }}"
          as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('web_assets/bulk_order/fonts/wolmart-png09e.woff') }}" as="font" type="font/woff"
          crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('web_assets/bulk_order/vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('web_assets/bulk_order/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/bulk_order/vendor/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('web_assets/bulk_order/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/bulk_order/css/demo8.min.css') }}">

    <script src="{{ asset('web_assets/bulk_order/vendor/perfect-scroll-bar/perfect-scroll-bar.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('web_assets/bulk_order/vendor/sweetalert2/sweetalert2.css') }}">

    <livewire:styles/>

</head>
<body>
<main id="bulk-order" class="left-active">

    <div>

        <livewire:order.bulk-order-products/>

        <livewire:order.bulk-order-cart/>


    </div>

</main>
<script src="{{ asset('web_assets/vendor/jquery/jquery.min.js') }}"></script>

<livewire:scripts/>

<script type="text/javascript">

    var htmlRendered = true;

    window.addEventListener('addItemInCart', (data) => {

        data = data.detail;

        $('.cart-item-' + data.id + '').remove();

        let html = '<li class="simple cart-item-' + data.id + '" style=""><div class="list-item cart-item"><div class="list-row"><div class="qty"><div class="product-qty-form mt-2"><div class="input-group"><input class="quantity form-control" name="quantity-' + data.id + '" value="' + data.quantity + '" type="number" min="0" max="100000"> <button type="button" class="w-icon-plus" onclick="incrementQuantityFromJavascript($(this))"></button><button type="button" class=" w-icon-minus" onclick="decrementQuantityFromJavascript($(this))"></button></div> </div> </div><div class="bo-title"><strong data-name="title">' + data.inventory.description + '</strong></div><div class="price">' + data.inventory.price + '</div><div class="total">' + parseFloat(data.inventory.float_price * data.quantity).toFixed(2) + '</div> <div class="action"><a onclick="removeProductFromCart($(this),' + data.id + ')" data-action="remove" href="javascript:;"><i class="fa fa-times"></i></a></div></div></div> </li>'

        $('#cart-products-list').prepend(html);

        if ($('#cart-products-list .no-product-found').length){

            $('.no-product-found').remove()
        }

        $(".cart-list").animate({scrollTop: 0}, "fast");

        $('.cart-item-' + data.id).css('background', 'azure');

        setTimeout(function () {

            $('.cart-item-' + data.id).css('background', '');

        }, 1000)
    });

    window.livewire.on('inventoryLoaded', () => {
        htmlRendered = true;
    });

    window.addEventListener('contentChanged', (data) => {

        $(".cart-list").animate({scrollTop: 0}, "fast");

        $('.cart-item-' + data.detail.id).css('background', 'azure');

        setTimeout(function () {

            $('.cart-item-' + data.detail.id).css('background', '');

        }, 1000)
    })

    $("#inventory-list").scroll(function () {

        let div = document.getElementById('inventory-list');

        if ((div.scrollHeight - div.clientHeight) == div.scrollTop) {

            if (htmlRendered) {

                $('.products-footer').css('display', '')

                window.livewire.emit('load-more-products');
            }

            htmlRendered = false;
        }
    });

    function incrementQuantityFromJavascript(elem) {

        let inputElm = elem.siblings('input');

        inputElm.val(parseInt(inputElm.val()) + 1)
    }

    function decrementQuantityFromJavascript(elem) {

        let inputElm = elem.siblings('input');

        let value = parseInt(inputElm.val());

        inputElm.val(value <= 1 ? 1 : value - 1)
    }

    function clearCart(elem) {

        if (confirm('Do you want to remove the cart items!')) {

            elem.addClass('load-more-overlay loading');

            window.livewire.emit('clearBulkCart');
        }
    }

    function removeProduct(elem, item_id) {

        $(elem).addClass('load-more-overlay loading');

        $('.cart-item-' + item_id).css('background', '#ffdbdb');

    }

    function removeProductFromCart(elem, item_id) {

        $(elem).addClass('load-more-overlay loading');

        $('.cart-item-' + item_id).css('background', '#ffdbdb');

        let lw_component = window.livewire.find($('.cart-item-' + item_id).parent().parent().parent().parent().attr('wire:id'));

        lw_component.call('removeProductFromCart',item_id)

    }
</script>

</body>

</html>
