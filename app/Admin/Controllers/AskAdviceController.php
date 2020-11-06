<?php

namespace App\Admin\Controllers;

use App\AskAdvice;
use App\Contract;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AskAdviceController extends Controller
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
        $grid = new Grid(new AskAdvice);

        $grid->id('Id');
        $grid->name('Tên người nhận');
        $grid->phone('Số điện thoại');
        $grid->email('Email');
        $grid->contract_code('Mã hợp đồng');
        $grid->column( 'Họ và tên khách hàng')->display(function () {
            $data = Contract::where('contract_code',$this->contract_code)->first();
            if($data) {
                return $data->name_customer;
            }
        });

		
		$grid->column( 'Loại hình công trình')->display(function () {
            if($this->type_of_project == 1) {
                return 'Nhà mặt đất';
            } elseif($this->type_of_project == 2) {
				return 'Chung cư';
			} elseif($this->type_of_project == 3) {
				return 'Văn phòng';
			} else {
				return 'Không xác định';
			}
        });
		
		$grid->floor_area('Diện tích sàn (m2)');
		$grid->construction_address('Địa chỉ công trình');
		$grid->phone_received('Số điện thoại liên hệ');
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
        $show = new Show(AskAdvice::findOrFail($id));

        $show->id('Id');
        $show->name('Tên người nhận');
        $show->phone('Số điện thoại - Email');
        $show->Email('Email');
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
        $form = new Form(new AskAdvice);

        $form->text('name', 'Tên người nhận');
        $form->mobile('phone', 'Số điện thoại');
        $form->email('email', 'Email');
        $form->text('contract_code', 'Mã hợp đồng');

        return $form;
    }
}