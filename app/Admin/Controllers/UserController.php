<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('custom.users'));
            $content->description(trans('custom.list'));

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加用户');
//            $content->description('普通用户');


            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {
//            $grid->model()->orderBy('id', 'DESC');
            $grid->model()->take(1);

            $grid->id('ID')->sortable();
            $grid->name(trans('custom.name'));
            $grid->email(trans('custom.email'));

            $grid->created_at(trans('custom.created_at'));
            $grid->updated_at(trans('custom.updated_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

//            $form->display('id', 'ID');
            $form->text('name', trans('custom.username'))->rules('required');
            $form->text('email', trans('custom.email'))->rules('required');
            $form->password('password', '密码')->rules('required|confirmed');
            $form->password('password_confirmation', '确认密码')->rules('required');
            $form->ignore(['password_confirmation']);

//            $form->display('created_at', 'Created At');
//            $form->display('updated_at', 'Updated At');
        });
    }
}
