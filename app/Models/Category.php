<?php

namespace App\Models;

use App\Libraries\WindWard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'type_name', 'parent', 'category_number', 'active'];

    protected $appends = ['type_listing_name', 'created'];

    public function insertChildCategoryDataFromApi()
    {
        $wind_ward_api = new WindWard();

        try {

            $response = $wind_ward_api->getDataRequest('get-child-categories');

            if (!isset($response->result)) {

                ApplicationSetting::sendErrorResponseToAdminEmails('get-child-categories -----> Response is invalid. Response : ' . json_encode($response));
            }

            $response = $response->result[0];

            if ($response->Response == 'Success') {

                $categories = $response->Results;

                foreach ($categories as $category) {

                    $this->updateOrCreate(
                        ['category_number' => $category->Number],
                        [
                            'name' => $category->CatName,
                            'type' => $category->CatType,
                            'type_name' => $category->CatTypeName
                        ]);
                }

                CronLog::create([
                    'module_type' => 'category'
                ]);

                $this->insertParentCategoryDataFromApi();
            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'child-category',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function insertParentCategoryDataFromApi()
    {
        $wind_ward_api = new WindWard();

        try {

            $response = $wind_ward_api->getDataRequest('get-parent-categories');

            $response = $response->result[0];

            if ($response->Response == 'Success') {

                $categories = $response->Results;

                foreach ($categories as $category) {

                    $parent = $this->updateOrCreate(
                        ['category_number' => $category->Number],
                        ['name' => $category->MainName]
                    );

                    $child_category_start = (int)$category->CatStart;

                    $child_category_end = (int)$category->CatEnd;

                    while ($child_category_start <= $child_category_end) {

                        $this->where('category_number', $child_category_start)->update(['parent' => $parent->id]);

                        $child_category_start++;
                    }
                }

                CronLog::create([
                    'module_type' => 'category'
                ]);

                $this->whereNotNull('type_name')->whereNull('parent')->delete();
            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'parent-category',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getCreatedAttribute($value)
    {
        return date('m/d/y H:i:s', strtotime($this->created_at));
    }

    public function inventoryCount($category, $is_parent = false)
    {
        $categories_id_to_ignore_status_and_in_stock = [139];

        $ignore_status_and_in_stock = false;

        $query = new Inventory();

        $category_id = $category->id;

        $category_number = $category->category_number;

        $category_parent = $category->parent;

        if ($is_parent) {

            if (in_array($category_id, $categories_id_to_ignore_status_and_in_stock)) {

                $ignore_status_and_in_stock = true;

            }

            $child_categories = $this->where('parent', $category_id)->where('active', 1)->pluck('category_number');

            $query = $query->whereIn('sub_category', $child_categories);

        } else {

            if (in_array($category_parent, $categories_id_to_ignore_status_and_in_stock)) {
                $ignore_status_and_in_stock = true;
            }

            $query = $query->where('sub_category', $category_number);
        }

        if (!$ignore_status_and_in_stock) {
            $query = $query->where('in_stock', '>', 0)->where('status', 'publish');
        }

        return $query->count();

    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'sub_category', 'category_number');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function getTypeListingNameAttribute()
    {
        return $this->type_name ? $this->type_name : '-';
    }

    public function getTypeNameAttribute($value)
    {
        return $value ? $value : '';
    }

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Name',
                'data' => 'name'
            ],
            [
                'title' => 'Type',
                'data' => 'type_listing_name',
                'searchable' => 'false'
            ],
            [
                'title' => 'Show',
                'data' => 'show',
                'searchable' => 'false'
            ],
            [
                'title' => 'Created At',
                'data' => 'created',
                'searchable' => 'false'
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
        return $this->query();
    }
}
