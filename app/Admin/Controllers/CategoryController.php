<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Controllers\HasResourceActions;

use OpenAdmin\Admin\Facades\Admin;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Show;

class CategoryController extends AdminController
{
    use HasResourceActions;
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Categories');
            $content->body(Category::tree());
        });
    }
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('Title'));
        $show->field('parent_id', __('Parent Id'));
        $show->field('order', __('Order'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('title', __('Title'));
        $form->select('parent_id', __("Category"))->options(Category::selectOptions());
        $form->number('order', __('Order'));

        return $form;
    }
}
