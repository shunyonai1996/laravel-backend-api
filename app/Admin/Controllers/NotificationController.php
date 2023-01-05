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
        $grid->column('start_date', __('掲載開始日'));
        $grid->column('end_date', __('掲載終了日'));
        $grid->column('image', __('画像'));
        $grid->column('already_read', __('既読管理'));
        $grid->column('hide_next_time', __('次回非表示チェックボックス'));
        $grid->column('jump_link', __('詳細ページリンク'));
        $grid->column('notify_priority', __('表示優先度（１が高い）'));
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
        $show->field('start_date', __('掲載開始日'));
        $show->field('end_date', __('掲載終了日'));
        $show->field('image', __('画像'));
        $show->field('already_read', __('既読管理'));
        $show->field('hide_next_time', __('次回非表示チェックボックス'));
        $show->field('jump_link', __('詳細ページリンク'));
        $show->field('notify_priority', __('表示優先度（１が高い）'));
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

        $form->datetime('start_date', __('掲載開始日'))->default(date('Y-m-d'));
        $form->datetime('end_date', __('掲載終了日'))->default(date('Y-m-d'));
        $form->image('image', __('画像'))->uniqueName();
        $form->url('jump_link', __('詳細ページリンク'));
        $form->switch('hide_next_time', __('次回非表示チェックボックス')); 
        $form->switch('already_read', __('既読機能の付与'));
        $form->number('notify_priority', __('表示優先度(１が高い)'));

        return $form;
    }
}
