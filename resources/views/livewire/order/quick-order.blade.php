<form wire:submit.prevent="updateCart(Object.fromEntries(new FormData($event.target)))">
    <div class="form-group">
                    <textarea placeholder="@00000000000
10
@111111111
2" class="form-control" name="products" id="products"
                              rows="15" required></textarea>

    </div>
    <br>
    <div class="list-actions cart-actions">
        <div>

            <button onclick="$('#products').val('')" type="button" class="btn btn-primary float-left">
                Clear Form
            </button>


            <button wire:loading.class="load-more-overlay loading" type="submit" class="btn btn-success float-right"
                    data-action="checkout">
                Add All Products
            </button>

        </div>
    </div>
</form>
