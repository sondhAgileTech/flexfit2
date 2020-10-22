<?php

namespace App\Admin\Controllers;

use App\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductController extends Controller
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
        $grid = new Grid(new Product);

        $grid->id('Id');
        $grid->name('Tên Sản Phẩm');
        $grid->provider('Nhà Cung Cấp');
        $grid->status_maitain_product('Trạng Thái')->using([true => 'Bảo hành', false => 'Bảo trì']);

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
        $show = new Show(Product::findOrFail($id));
        $show->id('Id');
        $show->name('Tên Sản Phẩm');
        $show->provider('Nhà Cung Cấp');
        $show->status_maitain_product('Trạng Thái')->using([true => 'Bảo Hành', false => 'Không Bảo Hành']);
    
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);
        $form->text('name', 'Tên Sản Phẩm')->rules('required', [
            'required' => 'Xin vui lòng nhập tên sản phẩm.'
        ]);
        $form->text('provider', 'Nhà Cung Cấp');
        $form->select('status_maitain_product', 'Trạng Thái')->options([true => 'Bảo Hành', false => 'Không Bảo Hành'])->default(true);

        return $form;
    }
}
