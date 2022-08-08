<?php

namespace App\Http\Livewire\Cart\Add;

use Livewire\Component;

class AddToCartMultiple extends Component
{
    protected $listeners = ['updateQuantityOnMultiple' => 'updateQuantity'];

    public $add_to_cart_wire_id = [];
    public $quantity = 0;

    public function updateQuantity($wire_id, $quantity,$inventory_id)
    {
        $data_found = false;

        $this->quantity = 0;

        foreach ($this->add_to_cart_wire_id as $index => $item) {

            $item_quantity = $item['quantity'];

            if ($item['wire_id'] == $wire_id) {

                $this->add_to_cart_wire_id[$index]['quantity'] = $quantity;

                $item_quantity = $quantity;

                $data_found = true;
            }

            $this->quantity += $item_quantity;

        }
        if (!$data_found) {

            $this->add_to_cart_wire_id[] = [
                'wire_id' => $wire_id,
                'quantity' => $quantity,
                'inventory_id' => $inventory_id
            ];

            $this->quantity += $quantity;
        }

    }

    public function render()
    {
        return view('livewire.cart.add.add-to-cart-multiple');
    }
}
