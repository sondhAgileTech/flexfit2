<?php

namespace App\Admin\Controllers;

use App\MailContract;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MailContractController extends Controller
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
        $grid = new Grid(new MailContract);

        $grid->id('Id');
        $grid->email('Email');
        $grid->name_customer('Tên Khách Hàng');
        $grid->sdt_customer('Số điện thoại Khách Hàng');
        $grid->email('Email');
        $grid->status('Trạng thái')->display(function($status) {
            if($status == 1) {
                return "Chưa gửi";
            } else {
                return "Đã gửi";
            }

        });
        $grid->contract_code('Mã hợp đồng');

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
        $show = new Show(MailContract::findOrFail($id));

        $show->id('Id');
        $show->email('Email');
        $show->name_customer('Tên khách hàng');
        $show->sdt_customer('Số điện thoại');
        $show->email('Email');
        $show->status('Trạng thái');
        $show->contract_code('Mã hợp đồng');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MailContract);

        $form->email('email', 'Email')->default('NULL');
        $language = ['1'=>'Chưa gửi', '2'=> 'Đã gửi'];
        $form->select('status', 'Trạng thái mail')->options($language);
        $form->text('contract_code', 'Mã hợp đồng');
        $form->text('sdt_customer', 'Số điện thoại');
        $form->text('name_customer', 'Tên khách hàng');

        return $form;
    }
}
