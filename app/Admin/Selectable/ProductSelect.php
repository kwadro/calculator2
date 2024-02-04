<?php

namespace App\Admin\Selectable;

use App\Models\Product;
use OpenAdmin\Admin\Grid\Selectable;
use OpenAdmin\Admin\Grid\Filter;
class ProductSelect extends Selectable
{
    public $model = Product::class;
    public static $display_field = "name";

    public function make()
    {
        $this->column('id');
        $this->column('name');
        $this->column('created_at');
        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
