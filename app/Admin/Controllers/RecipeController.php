<?php

namespace App\Admin\Controllers;

use App\Models\Measure;
use App\Models\Product;
use App\Models\Recipeauthor;
use App\Models\Recipetype;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Recipe;

class RecipeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Recipe';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Recipe());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'))->image('', 100, 100);
        $grid->type(__('Type'))->display(function ($type) {
            return ($type ? Recipetype::find($type)->title : null);
        });

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
        $show = new Show(Recipe::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
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
        $form = new Form(new Recipe());
        $form->tab('Basic info', function ($form) {
            $form->select('author', __("Author"))->options(Recipeauthor::all()->pluck('title', 'id'));
            $form->select('type', __("Type"))->options(Recipetype::all()->pluck('title', 'id'));
            $form->text('name', __('Name'));
            $form->textarea('description', __('Description'));
            $form->image('image', __('Image'));
        })->tab('Serving setting', function ($form) {
            $form->decimal('weight', __('Weight'));
            $form->number('count_serving', __('Serving count'));
            $form->number('cook_time', __('Time Cooking (min)'));
        })->tab('Products', function ($form) {
                $form->hasMany('components', 'Products', function (Form\NestedForm $form) {
                    $form->select('product_id', __("Product id"))->options(Product::all()->pluck('name', 'id'));
                    $form->decimal('qty', __('Qty'));
                    $form->select('measure_id', __("Measure"))->options(Measure::all()->pluck('title', 'id'));
                    $form->text('description', __('Description'));
                });
            });
            return $form;
    }
}
