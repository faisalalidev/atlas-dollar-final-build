<?php

namespace App\Models;

use App\Libraries\WindWard;
use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory , Rememberable;

    protected $fillable = ['inventory_id', 'sub_category', 'part_number', 'item_number', 'supplier_part_number', 'vendor_id',
        'description', 'description2', 'whole_sale', 'extra', 'freight', 'duty', 'landed', 'unit_of_measure', 'measurement1', 'measurement2',
        'size1', 'size2', 'size3', 'marked_deleted', 'e_commerce', 'kit_type', 'weight', 'in_stock', 'start_sale_date', 'end_sale_date',
        'inventory_selling_comment', 'inventory_invoice_comment', 'inventory_web_comment', 'sta', 'alt_supply', 'status', 'product_price', 'pack_size',
        'back_order', 'wind_ward_updated_at'];

    protected $appends = ['display_image', 'display_thumbnail_image' , 'price', 'float_price', 'stock'];

    public function insertDataFromApi($inventory_id = '', $page_number = 1, $page_size = 100)
    {
        $wind_ward_api = new WindWard();

        try {

            $params = $inventory_id ? '/' . $inventory_id : '/0';

            $response = $wind_ward_api->getDataRequest('get-inventories', $params);

            if (!isset($response->Inventory) && !isset($response->result)) {

                ApplicationSetting::sendErrorResponseToAdminEmails('get-inventories -----> Response is invalid. Response : ' . json_encode($response));
            }

            $inventories = [];

            if (isset($response->result)) {

                $inventories = isset($response->result[0]->Inventory) ? $response->result[0]->Inventory : [];

            } elseif (isset($response->Inventory)) {

                $inventories = $response->Inventory;
            }

            $inventory_form_group_one_model = new InventoryFreeFormGroupOne();

            $inventory_form_group_two_model = new InventoryFreeFormGroupTwo();

            $inventory_price_model = new InventoryPrice();

            $inventory_barcode_model = new InventoryBarcode();

            foreach ($inventories as $inventory) {

                if ($inventory->PartNumber == 'DEFAULT') {

                    continue;
                }

                if (!$inventory->Description) {

                    continue;
                }

                $back_order = 0;

                if ((int)$inventory->InStock) {

                    $back_order = 1;
                }

                if (!(int)$inventory->InStock && strtoupper($inventory->InventoryWebComment) == 'DROPSHIP') {
                    $back_order = 1;
                }


                $data = [
                    'sub_category' => $inventory->SubCategory,
                    'part_number' => $inventory->PartNumber,
                    'back_order' => $back_order,
                    'item_number' => $inventory->ItemNumber,
                    'supplier_part_number' => $inventory->SupplierPartNumber,
                    'vendor_id' => $inventory->VendorId,
                    'description' => $inventory->Description,
                    'description2' => $inventory->Description2,
                    'whole_sale' => $inventory->Wholesale,
                    'extra' => $inventory->Extra,
                    'freight' => $inventory->Freight,
                    'duty' => $inventory->Duty,
                    'landed' => $inventory->Landed,
                    'unit_of_measure' => $inventory->UnitOfMeasure,
                    'measurement1' => $inventory->Measurement1,
                    'measurement2' => $inventory->Measurement2,
                    'size1' => $inventory->Size1,
                    'size2' => $inventory->Size2,
                    'size3' => $inventory->Size3,
                    'marked_deleted' => $inventory->MarkedDeleted,
                    'e_commerce' => $inventory->eCommerce,
                    'kit_type' => $inventory->KitType,
                    'weight' => $inventory->Weight,
                    'in_stock' => $inventory->InStock,
                    'start_sale_date' => $inventory->StartSaleDate,
                    'end_sale_date' => $inventory->EndSaleDate,
                    'inventory_selling_comment' => $inventory->InventorySellingComment,
                    'inventory_invoice_comment' => $inventory->InventoryInvoiceComment,
                    'inventory_web_comment' => $inventory->InventoryWebComment,
                    'sta' => json_encode($inventory->STA),
                    'alt_supply' => json_encode($inventory->AltSupply),
                    'product_price' => $inventory->Prices[0] ? $inventory->Prices[0]->Regular : 0
                ];

                if (strtoupper($inventory->InventoryWebComment) == 'OUT' && !(int)$inventory->InStock) {
                    $data['status'] = 'draft';
                } else {

                    if (isset($inventory->MarkedDeleted) && $inventory->MarkedDeleted) {

                        $data['status'] = 'draft';
                    } else {

                        $data['status'] = 'publish';

                    }
                }

                $this->updateOrCreate(
                    ['inventory_id' => $inventory->InventoryId],
                    $data
                );

                $inventory_form_group_one_model->createFormGroups($inventory->InventoryFreeFormGroup1, $inventory->InventoryId);

                $inventory_form_group_two_model->createFormGroups($inventory->InventoryFreeFormGroup1, $inventory->InventoryId);

                $inventory_price_model->createInventoryPrices($inventory->Prices, $inventory->InventoryId);

                $inventory_barcode_model->createInventoryBarcodes($inventory->Barcodes, $inventory->InventoryId);

                $get_parts_response = $wind_ward_api->postDataRequest('get-parts', '', ['Fields' => ["PartUnique", "PackSize", "LastUpdate"], 'Filters' => [['Field' => 'PartUnique', 'Operator' => '=', 'Value' => $inventory->InventoryId]]]);

                if ($get_parts_response->result) {

                    $get_parts_response = $get_parts_response->result[0];

                    if ($get_parts_response->Response == 'Success') {

                        $pack_size = $get_parts_response->Results[0]->PackSize;

                        $this->where('inventory_id', $inventory->InventoryId)->update(['pack_size' => (float)$pack_size, 'wind_ward_updated_at' => $get_parts_response->Results[0]->LastUpdate]);
                    }
                }
            }

            if (!$inventory_id) {

                CronLog::create([
                    'module_type' => 'inventory',
                    'page_number' => $page_number,
                    'page_size' => count($inventories),
                    'cron_completed' => empty($inventories),
                ]);

            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'inventory',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function detectChangesFromApi()
    {
        $wind_ward_api = new WindWard();

        try {
            $cron_log = CronLog::where('module_type', 'inventory-changes')->orderBy('created_at', 'DESC')->first();

            if ($cron_log) {

                $date = date('c', strtotime($cron_log->created_at));

            } else {

                $date = date('c', strtotime(date('Y-m-d') . ' -1 day'));
            }

            $response = $wind_ward_api->postDataRequest('get-inventory_changes', '', ['FileNumber' => 7, 'EffectiveDate' => $date]);

            if (!isset($response->result)) {

                ApplicationSetting::sendErrorResponseToAdminEmails('get-inventory_changes -----> Response is invalid. Response : ' . json_encode($response));
            }

            $response = $response->result[0];

            if ($response->Response == 'Success') {

                $changes = $response->Results;

                CronLog::create([
                    'module_type' => 'inventory-changes',
                    'page_size' => count($changes),
                ]);

                foreach ($changes as $change) {

                    $this->insertDataFromApi($change->RecordID);
                }
            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'inventory-changes',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function images()
    {
        return $this->hasMany(InventoryImage::class, 'inventory_id', 'inventory_id');
    }

    public function prices()
    {
        return $this->hasMany(InventoryPrice::class, 'inventory_id', 'inventory_id');
    }

    public function barCodes()
    {
        return $this->hasMany(InventoryBarcode::class, 'inventory_id', 'inventory_id');
    }

    public function inventoryFreeFormGroupOne()
    {
        return $this->hasMany(InventoryFreeFormGroupOne::class, 'inventory_id', 'inventory_id');
    }

    public function inventoryFreeFormGroupTwo()
    {
        return $this->hasMany(InventoryFreeFormGroupTwo::class, 'inventory_id', 'inventory_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'sub_category', 'category_number');
    }

    public function getDisplayThumbnailImageAttribute()
    {
        $images = $this->images;

        if (!empty($images->toArray())) {

            return 'files/thumb-' . $images[0]->image;

        } else {

            return 'admin_assets/img/default-product-image.png';
        }
    }

    public function getDisplayImageAttribute()
    {
        $images = $this->images;

        if (!empty($images->toArray())) {

            return 'files/' . $images[0]->image;
        } else {

            return 'admin_assets/img/default-product-image.png';
        }
    }

    public function getPriceAttribute()
    {
        $prices = $this->prices;

        if (!empty($prices->toArray())) {

            return '$' . number_format($prices[0]->regular / ($this->pack_size ? $this->pack_size : 1), 2, '.', '');
        } else {

            return '$0';
        }

    }

    public function getFloatPriceAttribute()
    {
        $prices = $this->prices;

        if (!empty($prices->toArray())) {

            return number_format((double)$prices[0]->regular / ($this->pack_size ? $this->pack_size : 1), 2, '.', '');
        } else {

            return 0;
        }
    }

    public function getInventories($search_value, $pagination = 18)
    {
        $query = $this;

        if ($search_value) {

            $query = $query->where(function ($q) use ($search_value) {

                $q->where('inventory_id', 'LIKE', '%' . $search_value . '%')
                    ->orWhere('description', 'LIKE', '%' . $search_value . '%')
                    ->orWhere('description2', 'LIKE', '%' . $search_value . '%')
                    ->orWhere('status', 'LIKE', '%' . $search_value . '%')
                    ->orWhereHas('category', function ($query) use ($search_value) {
                        $query->where('name', 'LIKE', '%' . $search_value . '%');
                    });
            });
        }

        return $query->paginate($pagination);
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function getStockAttribute()
    {
        return $this->in_stock > 0 ? 'In Stock' : 'Out Of Stock';
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Image',
                'data' => 'display_image',
            ],
            [
                'title' => 'Name',
                'data' => 'description',
                'visible' => false
            ],
            [
                'title' => 'SKU',
                'data' => 'part_number',
                'visible' => false
            ],
            [
                'title' => 'Stock',
                'data' => 'stock_view',
                'searchable' => 'false'
            ],
            [
                'title' => 'Category',
                'data' => 'category.name'
            ],
            [
                'title' => 'Status',
                'data' => 'status_view'
            ],
            [
                'title' => 'Status',
                'data' => 'status',
                'visible' => false
            ],
            [
                'title' => 'Price',
                'data' => 'price',
                'searchable' => 'false'
            ],
            [
                'title' => 'Date',
                'data' => 'created_at_view'
            ],
            [
                'title' => 'Created At',
                'data' => 'created_at',
                'visible' => false
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function ajaxListing()
    {
        $request = app('request');

        $query = $this->query();

        if (isset($request->sub_category)) {

            $query = $query->where('sub_category', $request->sub_category);
        }

        if (isset($request->status)) {

            $query = $query->where('status', $request->status);
        }

        if (isset($request->stock)) {

            $stock = $request->stock;

            if ($stock == 'in_stock') {

                $query = $query->where('in_stock', '>', 0);

            } else {

                $query = $query->where('in_stock', '<=', 0);
            }

        }

        return $query->with('category');
    }

    public function getPublishedInventories($paginate = 25, $filters = [], $with_pagination = true, $current_page = 1)
    {
        $query = $this->with(['category', 'images', 'prices']);

        $ignore_status_and_in_stock = false;

        $categories_id_to_ignore_status_and_in_stock = [139];

        if (isset($filters['search'])) {

            $ignore_status_and_in_stock = true;

            $query = $query->where('description', 'like', '%' . $filters['search'] . '%')
                ->orWhere('inventory_id', 'LIKE', $filters['search'])
                ->orWhere('part_number', 'LIKE', $filters['search']);
        }

        if (isset($filters['category_id'])) {

            if ($filters['parent_category']) {

                if (in_array($filters['category_id'], $categories_id_to_ignore_status_and_in_stock)) {

                    $ignore_status_and_in_stock = true;

                }

                $category_ids = Category::where('parent', $filters['category_id'])->where('active', 1)->pluck('category_number');

                $query = $query->whereIn('sub_category', $category_ids);

            } else {

                $category_detail = Category::find($filters['category_id']);

                if (in_array($category_detail->parent, $categories_id_to_ignore_status_and_in_stock)) {
                    $ignore_status_and_in_stock = true;
                }

                $query = $query->where('sub_category', $category_detail->category_number);
            }

        }

        if (!$ignore_status_and_in_stock) {
            $query = $query->where('in_stock', '>', 0)->where('status', 'publish');
        }

        if (isset($filters['sort_by'])) {

            $sort = explode(' ', $filters['sort_by']);

            $query = $query->orderBy($sort[0], $sort[1]);

        } else {

            $query = $query->orderBy('wind_ward_updated_at', 'DESC');
        }

        if ($with_pagination) {

            $data = $query->remember(now()->addHours(3))->paginate($paginate);

        } else {

            $data = $query->remember(now()->addHours(3))->limit($paginate)->get();
        }

        return $data;
    }
}
