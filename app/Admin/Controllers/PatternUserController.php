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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
        $form->number('user_id', __('user id'));


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
            $rows[] = $row + array('2' => date('Y-m-d H:i:s', strtotime('+9hour')), '3' => date('Y-m-d H:i:s', strtotime('+9hour')));
        });


        // CSVデータをパース
        $lexer->parse($file, $interpreter);
        $data = array();

        // CSVのデータを配列化
        foreach ($rows as $key => $value) {
            $arr = array();
            
            foreach ($value as $k => $v){
                switch($k) {
                    
                    case 0;
                    $arr['pattern_id'] = $v;
                    break;
                    
                    case 1;
                    $arr['user_id'] = $v;
                    break;
                    
                    case 2;
                    $arr['created_at'] = $v;
                    break;

                    case 3;
                    $arr['updated_at'] = $v;
                    break;

                    default;
                    break;
                }
            }

            // バリデーション処理
            $validator = Validator::make($arr, [
                'pattern_id' => 'required',
                'user_id' => 'required',
            ]);
            
            if($validator->fails()) {
                $validator->errors()->add('line', $key);
                return redirect('/admin/patten_user')->withErrors($validator)->withInput();
            }

            $data[] = $arr;
            
        }
        
        Log::debug($data);

        PatternUser::query()->delete();
        PatternUser::insert($data);

        return redirect('/admin/pattern_user')->with('save_message', 'CSV取込完了');
    }
}
