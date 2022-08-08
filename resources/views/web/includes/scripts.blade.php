<script src="{{ asset('web_assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/parallax/parallax.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/skrollr/skrollr.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('web_assets/vendor/zoom/jquery.zoom.js') }}"></script>
<!--<script src="{{ asset('web_assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>-->
<script type="text/javascript"
        src="{{ asset('web_assets/vendor/perfect-scroll-bar/perfect-scroll-bar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('web_assets/vendor/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('web_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('web_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web_assets/js/sweetalert.js') }}"></script>
<script type="text/javascript">

    var base_url = '{{ url('/') }}'

    $('.perfect-scroll-bar').perfectScrollbar();

</script>
<!-- Main JS -->
<script src="{{ asset('web_assets/js/main.min.js') }}"></script>

<livewire:scripts/>

<script type="text/javascript">


    var lazyloadImages = document.querySelectorAll("img.lazy");
    var lazyloadThrottleTimeout;

    function lazyload() {
        if (lazyloadThrottleTimeout) {
            clearTimeout(lazyloadThrottleTimeout);
        }

        lazyloadThrottleTimeout = setTimeout(function () {
            var scrollTop = window.pageYOffset;
            lazyloadImages.forEach(function (img) {
                if (img.offsetTop < (window.innerHeight + scrollTop)) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                }
            });
            if (lazyloadImages.length == 0) {
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
                window.removeEventListener("images-incoming", lazyload);
            }
        }, 20);

    }

    document.addEventListener("DOMContentLoaded", function () {
        document.addEventListener("scroll", lazyload);
        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("images-incoming", lazyload);
    });

    $(function () {

        $(document).mouseup(function (e) {
            var container = $("#search-form");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('.search-bar-html').attr('style', 'display: none !important');
            }
        });

    })

    function addToRecentlyViewed(inventory_id) {

        let user_logged_in = '{{ auth()->guard(config('constants.WEB_GUARD_NAME'))->check() }}'

        if (!user_logged_in) {
            return;
        }

        let url = '{{ route(config('constants.WEB_PREFIX').'recently_viewed',['inventory_id' => ':id']) }}';

        url = url.replace(':id', inventory_id);

        $.post(url, {_token: '{{ csrf_token() }}'}).done(function (data) {

        }).fail(function (error) {

        })
    }

    function addToCartFromJavascript(elem,view_order = false) {

        if (view_order){

            let inputElm = elem.parent().find('input');

            if(parseInt(inputElm.val()) < 1){
                return;
            }
        }

        elem.addClass('load-more-overlay loading')

        let lw_component = window.livewire.find(elem.parent().parent().attr('wire:id'));

        lw_component.call('addToCart')
    }

    function incrementQuantityFromJavascript(elem, emitLiveWire = true, list = false) {

        let inputElm = elem.siblings('input');

        inputElm.val(parseInt(inputElm.val()) + 1)

        if (emitLiveWire) {

            if (list) {

                let lw_component = window.livewire.find(elem.parent().parent().parent().attr('wire:id'));

                lw_component.call('incrementQuantity')

            } else {

                let lw_component = window.livewire.find(elem.parent().parent().parent().parent().attr('wire:id'));

                lw_component.call('incrementQuantity')
            }

        }
    }

    function changeQuantityFromJavascript(elem, list = false) {

        if (list) {

            let lw_component = window.livewire.find(elem.parent().parent().parent().attr('wire:id'));

            lw_component.call('changeQuantity', elem.val())

        } else {

            let lw_component = window.livewire.find(elem.parent().parent().parent().parent().attr('wire:id'));

            lw_component.call('changeQuantity', elem.val())
        }
    }

    function decrementQuantityFromJavascript(elem, emitLiveWire = true, list = false) {

        let inputElm = elem.siblings('input');

        let value = parseInt(inputElm.val());

        inputElm.val(value <= 1 ? 0 : value - 1)

        if (emitLiveWire) {

            if (list) {

                let lw_component = window.livewire.find(elem.parent().parent().parent().attr('wire:id'));

                lw_component.call('decrementQuantity')

            } else {

                let lw_component = window.livewire.find(elem.parent().parent().parent().parent().attr('wire:id'));

                lw_component.call('decrementQuantity')
            }

        }
    }

    function addToCartAll(array) {

        array = JSON.parse(array);

        for (let i in array) {

            if (array[i].quantity) {

                $("[data-list-inventory-id=" + array[i].inventory_id + "]").addClass('load-more-overlay loading')

                let lw_component = window.livewire.find(array[i].wire_id);

                lw_component.call('addToCart')
            }

        }
    }

</script>

<script type="text/javascript">

    var htmlRendered = true;

    window.addEventListener('addItemInCart', (data) => {

        data = data.detail;

        $('.cart-item-' + data.id + '').remove();

        let html = '<li class="simple cart-item-' + data.id + '" style=""><div class="list-item cart-item"><div class="list-row"><div class="qty"><div class="product-qty-form mt-2"><div class="input-group"><input class="quantity form-control" name="quantity-' + data.id + '" value="' + data.quantity + '" type="number" min="0" max="100000"> <button type="button" class="w-icon-plus" onclick="incrementQuantityFromJavascriptBulkOrder($(this))"></button><button type="button" class=" w-icon-minus" onclick="decrementQuantityFromJavascriptBulkOrder($(this))"></button></div> </div> </div><div class="bo-title"><strong data-name="title">' + data.inventory.description + '</strong></div><div class="price">' + data.inventory.price + '</div><div class="total">' + parseFloat(data.inventory.float_price * data.quantity).toFixed(2) + '</div> <div class="action"><a onclick="removeProductFromCartBulkOrder($(this),' + data.id + ')" data-action="remove" href="javascript:;"><i class="fa fa-times"></i></a></div></div></div> </li>'

        $('#cart-products-list').prepend(html);

        if ($('#cart-products-list .no-product-found').length) {

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

        if (Math.ceil((div.scrollHeight - div.clientHeight)) == Math.ceil(div.scrollTop)) {

            if (htmlRendered) {

                $('.products-footer').css('display', '')

                window.livewire.emit('load-more-products');
            }

            htmlRendered = false;
        }
    });

    window.addEventListener('searchItemsFound', () => {

        $('#search-dropdown').unbind('scroll');

        console.log('HERE');

        $("#search-dropdown").scroll(function () {

            let div = document.getElementById('search-dropdown');

            console.log(div.scrollHeight, div.clientHeight, div.scrollTop)

            if (Math.ceil((div.scrollHeight - div.clientHeight)) == Math.ceil(div.scrollTop)) {

                $('.load-more-search').css('display', 'block')

                window.livewire.emit('load-more-products-for-search');

            }
        });

    });

    function incrementQuantityFromJavascriptBulkOrder(elem) {

        let inputElm = elem.siblings('input');

        inputElm.val(parseInt(inputElm.val()) + 1)
    }

    function decrementQuantityFromJavascriptBulkOrder(elem) {

        let inputElm = elem.siblings('input');

        let value = parseInt(inputElm.val());

        inputElm.val(value <= 1 ? 1 : value - 1)
    }

    function clearCartBulkOrder(elem) {

        if (confirm('Do you want to remove the cart items!')) {

            elem.addClass('load-more-overlay loading');

            window.livewire.emit('clearBulkCart');
        }
    }

    function removeProductBulkOrder(elem, item_id) {

        $(elem).addClass('load-more-overlay loading');

        $('.cart-item-' + item_id).css('background', '#ffdbdb');

    }

    function removeProductFromCartBulkOrder(elem, item_id) {

        $(elem).addClass('load-more-overlay loading');

        $('.cart-item-' + item_id).css('background', '#ffdbdb');

        let lw_component = window.livewire.find($('.cart-item-' + item_id).parent().parent().parent().parent().attr('wire:id'));

        lw_component.call('removeProductFromCart', item_id)

    }
</script>

@stack('extra-scripts')
