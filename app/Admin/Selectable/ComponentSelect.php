<?php

namespace App\Admin\Selectable;

use App\Models\Component;
use OpenAdmin\Admin\Grid\Filter;
use OpenAdmin\Admin\Grid\Selectable;

class ComponentSelect extends Selectable
{
    public $model = Component::class;
    public static $display_field = "product_id";

    public function make()
    {
        $this->column('id');
        $this->column('product_id');
        $this->column('qty');
        $this->column('measure_id');
        $this->column('created_at');
        $this->filter(function (Filter $filter) {
            $filter->like('product_id');
        });
    }
}
