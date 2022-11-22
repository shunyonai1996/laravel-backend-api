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
        $grid->column('end_date', __('End date'));
        $grid->column('start_date', __('Start date'));
        $grid->column('image', __('Image'));
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
        $show->field('start_date', __('Start date'));
        $show->field('end_date', __('End date'));
        $show->field('image', __('Image'));
        $show->field('already_read', __('Already read'));
        $show->field('hide_next_time', __('Hide next time'));
        $show->field('jump_link', __('Jump link'));
        $show->field('notify_priority', __('Notify priority'));
        $show->field('group_id', __('Group id'));
        $show->field('collection_id', __('Collection id'));
        $show->field('read_id', __('Read id'));
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

        $form->datetime('start_date', __('掲載開始日'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end_date', __('掲載終了日'))->default(date('Y-m-d H:i:s'));
        $form->image('image', __('画像'));
        $form->url('jump_link', __('リンク'));
        $form->number('collection_id', __('公開グループ'));

        return $form;
    }
}
