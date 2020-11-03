<?php

namespace App\Admin\Controllers;

use App\Notification;
use App\Product;
use App\ContractProduct;
use App\Contract;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class NotificationController extends Controller
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
        $grid = new Grid(new Notification);
        
        $grid->model()->where('status','=', 'pending')->orderBy('created_at', 'asc');
        $grid->column('contract_code', 'Mã hợp đồng')->display(function ($id) {
            $data = Contract::where('id',(int)$id)->first();
            if($data) {
                return $data->contract_code;
            }
        });
        $grid->column('product_id', 'Sản phẩm')->display(function ($id) {
            $data = Product::where('id',(int)$id)->first();
            if($data) {
                return $data->name;
            }
        });
        $grid->changed_date_maintain('Thời gian muốn thay đổi')->display(function($date){
            return date('d/m/Y', strtotime($date));
        });
        $grid->column('status', 'Trạng thái')->display(function ($status) {
            if($status == 'pending') {
                return 'Chờ duyệt';
            }
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
        $show = new Show(Notification::findOrFail($id));
        $show->id('Id');
        $show->contract_code('Mã Hợp đồng');
        $show->changed_date_maintain('Thời gian muốn thay đổi');
        $show->status('Trạng thái');
        $show->contract_code('Sản phẩm')->as(function ($id) {
            $products = ContractProduct::where('contract_id', (int)$id)->get();
            $contract_code = Contract::where('id', (int)$id)->first();
            $html = '<table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">STT</th>
                                  <th scope="col">Mã hợp đồng</th>
                                  <th scope="col">Tên Sản Phẩm</th>
                                  <th scope="col">Nhà Cung Cấp</th>
                                  <th scope="col">Lịch kiểm tra định kỳ lần 1</th>
                                  <th scope="col">Lịch kiểm tra định kỳ lần 2</th>
                                  <th scope="col">Lịch kiểm tra định kỳ lần 3</th>
                                  <th scope="col">Trạng Thái</th>
                                </tr>
                              </thead>
                        <tbody>';
            $i = 1;
            foreach ($products as $item) {
                $data = Product::where('id',(int)$item->product_id)->first();
                if($data) {
                    $html .= '<tr>
                            <th scope="row">'.$i.'</th>
                            <td>'.$contract_code->contract_code.'</td>
                            <td>'.$data->name.'</td>
                            <td>'.$data->provider.'</td>
                            <th scope="row">'.date('d/m/Y', strtotime($item->selected_at.' + 3 months')).'</th>
                            <td>'.date('d/m/Y', strtotime($item->selected_at.' + 6 months')).'</td>
                            <td>'.date('d/m/Y', strtotime($item->selected_at.' + 12 months')).'</td>
                            <td>'.(($data->status_maitain_product)?'Bảo Trì':'Không Bảo Trì').'</td>
                        </tr>';
                    $i++;
                }
            }
            $html .= '</tbody></table><hr>';

            return $html;
        })->unescape();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Notification);

        $form->text('contract_code', 'Mã hợp đồng');
        $form->text('product_id', 'Mã sản phẩm');
        $form->datetime('changed_date_maintain', 'Thời gian thay đổi')->default(date('Y-m-d H:i:s'));
        $noti = ['pending'=>'Chờ duyệt', 'accept' => 'Chấp nhận Thay đổi'];
        $form->select('status', 'Trạng thái')->options($noti);

        return $form;
    }
}
