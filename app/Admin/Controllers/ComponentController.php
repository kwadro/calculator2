<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Measure;
use App\Models\Product;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Component;

class ComponentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Component';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Component());

        $grid->column('id', __('Id'));
        $grid->product_id(__('Product'))->display(function ($product_id) {
            return ($product_id ? Product::find($product_id)->name : null);
        });
        $grid->column('product_id', __('Product id'));
        $grid->column('gty', __('Gty'));
        $grid->column('measure_id', __('Measure id'));
        $grid->column('measure_qty', __('Measure qty'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Component::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('gty', __('Gty'));
        $show->field('measure_id', __('Measure id'));
        $show->field('measure_qty', __('Measure qty'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Component());
        $form->int('recipe_id', __("Recipe Id"));
        $form->select('product_id', __("Product id"))->options(Product::all()->pluck('name', 'id'));
        $form->decimal('qty', __('Qty'));
        $form->select('measure_id', __("Measure"))->options(Measure::all()->pluck('title', 'id'));
        $form->text('description', __('Description'));
        return $form;
    }
}
