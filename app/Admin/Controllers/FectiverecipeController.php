<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Fectiverecipe;

class FectiverecipeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fective Recipe List';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fectiverecipe());

        $grid->column('id', __('Id'));
        $grid->column('qty', __('Qty'));
        $grid->column('festive_id', __('Festive id'));
        $grid->column('recipe_id', __('Recipe id'));
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
        $show = new Show(Fectiverecipe::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('qty', __('Qty'));
        $show->field('festive_id', __('Festive id'));
        $show->field('recipe_id', __('Recipe id'));
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
        $form = new Form(new Fectiverecipe());

        $form->text('qty', __('Qty'));
        $form->text('festive_id', __('Festive id'));
        $form->text('recipe_id', __('Recipe id'));

        return $form;
    }
}
