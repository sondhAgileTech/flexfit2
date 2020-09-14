<?php

namespace App\Admin\Controllers;

use App\Product;
use App\Contract;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListContractMaintainController extends Controller
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
        $grid = new Grid(new Contract);
        $grid->disableActions();
        $grid->model()->where(DB::raw('DATE_ADD(finish_date, INTERVAL 3 MONTH)'), '>', Carbon::now())->orderBy('finish_date', 'asc');
        $grid->contract_code('Contract code');
        $grid->products('Name customer')->display(function($products) {
            $html = null;
            foreach ($products as $item) {
                $data = Product::where('id',(int)$item)->first();
                if($data) {
                    $html .= $data->name. '<br>';
                }
            }
            return $html;
        });

        $grid->finish_date('Trạng Thái Bảo Trì')->display(function ($date) {
            $countdown_1 = Carbon::now()->diffInDays(Carbon::parse($date)->addMonth(3), false);
            $html = "<div class='alert-success text-center'>".(($countdown_1>=0)?$countdown_1." ngày nữa":"Đã Hết Hạn")."</div>";
            return $html;
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
        $show = new Show(Contract::findOrFail($id));

        $show->id('Id');
        $show->contract_code('Contract code');
        $show->name_customer('Name customer');
        $show->construction_items('Construction items');
        $show->phone('Phone');
        $show->address('Address');
        $show->email('Email');
        $show->status_mainten('Status mainten');
        $show->finish_date('Finish date');
        $show->language('Language');
        $show->products('Products');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Contract);

        $form->text('contract_code', 'Contract code');
        $form->text('name_customer', 'Name customer');
        $form->text('construction_items', 'Construction items');
        $form->mobile('phone', 'Phone');
        $form->text('address', 'Address');
        $form->email('email', 'Email');
        $form->switch('status_mainten', 'Status mainten');
        $form->datetime('finish_date', 'Finish date')->default(date('Y-m-d H:i:s'));
        $form->text('language', 'Language');
        $form->textarea('products', 'Products')->default(NULL);

        return $form;
    }
}
