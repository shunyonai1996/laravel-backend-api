<?php

namespace App\Admin\Controllers;

use App\Models\Notification;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NotificationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Notification';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Notification());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('discription', __('Discription'));
        $grid->column('end_date', __('End date'));
        $grid->column('start_date', __('Start date'));
        $grid->column('image', __('Image'));
        $grid->column('toggle_view', __('Toggle view'));
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
        $show = new Show(Notification::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('discription', __('Discription'));
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
        $show->field('image', __('Image'));
        $show->field('toggle_view', __('Toggle view'));
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
        $form = new Form(new Notification());

        $form->text('title', __('Title'));
        $form->textarea('discription', __('Discription'));
        $form->datetime('start_date', __('Start date'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end_date', __('End date'))->default(date('Y-m-d H:i:s'));
        $form->image('image', __('Image'));
        $form->switch('toggle_view', __('Toggle view'));

        return $form;
    }
}
