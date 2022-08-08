<?php

namespace App\Http\Livewire\Order;

use App\Models\Cart;
use App\Models\Inventory;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class QuickOrder extends Component
{
    public function updateCart($form_data)
    {
        $quick_add_cart = explode("\n", $form_data['products']);

        $ids = [];
        $qty = [];
        $last_part_number = '';

        $product_errors = [];
        $valid_product = true;

        foreach ($quick_add_cart as $line => $val) {

            $val = str_replace(' ', '', $val);

            if ($val) {

                if (strlen($val) > 4) {

                    $id = str_replace('@', '', $val);

                    $product = Inventory::where('part_number', $id)->first();

                    $last_part_number = $id;

                    if (!$product) {
                        $valid_product = false;
                        $product_errors['invalid_product_sku'][] = $id;
                        continue;
                    }
                    $valid_product = true;
                    $ids[] = $product->inventory_id;

                } else {
                    if($valid_product) {
                        if (!is_numeric($val) || (int)$val <= 0) {
                            $product_errors['invalid_product_quantity'][] = $last_part_number;
                            unset($ids[count($ids) - 1]);
                            continue;
                        }

                        $qty[] = $val;
                    }
                }
            }

        }

        if (!count($ids) || !count($qty)) {
            $this->emit('quickOrderError', ['msg' => 'No Item Found.']);
            return;
        }

        $cart_model = new Cart();

        foreach ($ids as $index => $inventory_id) {
            if (isset($qty[$index]) && $inventory_id){
                $cart_model->addToCart($inventory_id, $qty[$index]);
            }
        }

        Session::push('quick_order_errors' , $product_errors);

        $this->emit('quickOrderSuccess');

    }

    public function render()
    {
        return view('livewire.order.quick-order');
    }
}
