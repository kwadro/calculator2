<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Product;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());
        $grid->header(function ($query) {
            return 'custom header';
        });


        $grid->column('id', __('Id'))->sortable();;
        $grid->column('name', __('Name'))->sortable()->filter('like');;
        $grid->column('price', __('Price'))->sortable();;
        $grid->category(__('Category'))->display(function ($category) {
            return ($category ? Category::find($category)->title : null);
        });
        //$grid->column('url', __('Description'));
        $grid->column('image', __('Image'))->image('',75,75);
        //$grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function ($filter) {
            $filter->between('created_at', 'Created Time')->datetime();
            //$filter->expand();
        });
        $grid->footer(function ($query) {
            return 'custom footer';
        });
        $grid->model()->orderBy('id', 'desc');
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('category', __('Category'));
        $show->field('url', __('Url'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->decimal('price', __('Price'));
        $form->select('category', __("Category"))->options(Category::all()->pluck('title', 'id'));
        $form->text('url', __('Url'));
        $form->textarea('description', __('Description'));
        $form->image('image', __('Image'));

        return $form;
    }
}
