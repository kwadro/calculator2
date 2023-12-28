<?php

namespace App\Admin\Controllers;


use App\Models\Recipe;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Festive;

class FestiveController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Festive List';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Festive());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('count_people', __('Count people'));
        $grid->column('date', __('Date'));
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
        $show = new Show(Festive::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('count_people', __('Count people'));
        $show->field('date', __('Date'));
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
        $form = new Form(new Festive());
        $form->tab('Basic info', function ($form) {
            $form->text('name', __('Name'));
            $form->text('description', __('Description'));
            $form->number('count_people', __('Count peoples'));
            $form->date('date', __('Date'))->default(date('Y-m-d'));
        })->tab('Recipes', function ($form) {
            $form->hasMany('recipes', 'Recipes', function (Form\NestedForm $form) {
                $form->number('qty', __('Qty'));
                $form->select('recipe_id', __("Recipe"))
                    ->options(Recipe::all()->pluck('name', 'id'));
            });
        });

        return $form;
    }
}
