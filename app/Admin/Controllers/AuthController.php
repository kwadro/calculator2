<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\Hash;
use OpenAdmin\Admin\Controllers\AuthController as BaseAuthController;
use OpenAdmin\Admin\Form;

class AuthController extends BaseAuthController
{
    protected function settingForm()
    {
        $class = config('admin.database.users_model');
        $form = new Form(new $class());
        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.name'))->rules('required');
        $form->image('avatar','Avatar');
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->setAction(admin_url('auth/setting'));
        $form->ignore(['password_confirmation']);
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });
        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });
        return $form;
    }
}
