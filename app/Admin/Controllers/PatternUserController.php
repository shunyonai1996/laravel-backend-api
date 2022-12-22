<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\CsvImport;
use App\Models\PatternUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;

class PatternUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PatternUser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PatternUser());

        $grid->column('id', __('Id'));
        $grid->column('pattern_id', __('pattern id'))->rules('unique');
        $grid->column('user_id', __('user id'))->rules('unique');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->tools(function ($tools) {
            $tools->append(new CsvImport());
        });

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
        $show = new Show(PatternUser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pattern_id', __('Pattern id'));
        $show->field('user_id', __('User id'));
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
        $form = new Form(new PatternUser());
        $grid = new Grid(new PatternUser());

        $grid->tools(function ($tools) {
            $tools->append(new CsvImport());
        });
        $form->number('pattern_id', __('pattern id'));
        $form->text('user_id', __('user id'));


        return $form;
    }

    public function csvImport(Request $request)
    {
        
        $file = $request->file('file');
        $config = new LexerConfig();
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $rows = array();

        // 列数の厳密なチェックを行わない
        $interpreter->unstrict();

        // インポートする値を$rowに代入
        $interpreter->addObserver(function (array $row) use (&$rows) {
            $rows[] = $row;
        });

        // CSVデータをパース
        $lexer->parse($file, $interpreter);
        foreach ($rows as $key => $value) {
            // データの作成
            PatternUser::create([
                'pattern_id' => $value[0],
                'user_id' => $value[1],
            ]);
        }

        return response()->json(
            [
                'data' => '成功'
            ],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
