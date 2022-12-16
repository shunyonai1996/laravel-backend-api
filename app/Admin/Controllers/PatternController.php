<?php

namespace App\Admin\Controllers;

use App\Models\Pattern;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PatternController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pattern';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pattern());

        $grid->column('id', __('Id'));
        $grid->column('notification_id', __('Notification id'));
        $grid->column('pattern_name', __('Pattern name'));
        $grid->column('individual', __('Individual'));
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
        $show = new Show(Pattern::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('notification_id', __('Notification id'));
        $show->field('pattern_name', __('Pattern name'));
        $show->field('individual', __('Individual'));
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
        $form = new Form(new Pattern());

        $form->number('notification_id', __('POPUPのid'));
        $form->text('pattern_name', __('グループ名'));
        $form->switch('individual', __('個人宛通知の場合はtrue'));

        return $form;
    }
}
