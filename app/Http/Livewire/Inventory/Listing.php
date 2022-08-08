<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Inventory;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $limit = 80;

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->inventory_model = new Inventory();

        $this->limit = Session::get('home_list_limit',80);
    }

    public function getQueryString()
    {
        return [];
    }

    public function updatedLimit($value)
    {
        Session::put('home_list_limit',$value);
    }

    public function updating($name)
    {
        $changePaginationToOne = [
            'search',
        ];

        if(in_array($name,$changePaginationToOne)) {
            $this->gotoPage(1);
        }
    }

    public function paginationView()
    {
        return 'livewire.inventory.pagination';
    }

    public function render()
    {
        $this->dispatchBrowserEvent('images-incoming');

        return view('livewire.inventory.home.listing', [
            'inventories' => $this->inventory_model->getPublishedInventories($this->limit, [], true ,$this->page),
        ]);
    }
}
