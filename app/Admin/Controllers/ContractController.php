<?php

namespace App\Admin\Controllers;

use App\Contract;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ContractController extends Controller
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

        $grid->id('Id');
        $grid->contract_code('Contract code');
        $grid->name_customer('Name customer');
        $grid->construction_items('Construction items');
        $grid->phone('Phone');
        $grid->address('Address');
        $grid->email('Email');
        $grid->status_mainten('Status mainten');
        $grid->finish_date('Finish date');
        $grid->language('Language');

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

        return $form;
    }
}
