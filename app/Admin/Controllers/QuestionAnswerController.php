<?php

namespace App\Admin\Controllers;

use App\QuestionAnswer;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class QuestionAnswerController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QuestionAnswer);

        $grid->id('Id');
        $grid->question('Câu hỏi');
        $grid->answer('Câu trả lời');
        $grid->language('Ngôn ngữ');

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
        $show = new Show(QuestionAnswer::findOrFail($id));

        $show->id('Id');
        $show->question('Câu hỏi');
        $show->answer('Câu trả lời');
        $show->language('Ngôn ngữ');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QuestionAnswer);

        $form->text('question', 'Câu hỏi');
        $form->text('answer', 'Câu trả lời');
        $language = ['en'=>'English', 'vi'=> 'Việt nam'];
        $form->select('language', 'Ngôn Ngữ')->options($language);

        return $form;
    }
}
