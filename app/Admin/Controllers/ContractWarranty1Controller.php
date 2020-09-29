<?php

namespace App\Admin\Controllers;

use App\Contract;
use App\ContractProduct;
use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;

class ContractWarranty1Controller extends Controller
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
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->model()->where(DB::raw('DATE_ADD(finish_date, INTERVAL 3 MONTH)'), '>', Carbon::now())->orderBy('finish_date', 'asc');
        $grid->contract_code('Mã hợp đồng');
        $grid->name_customer('Tên khách hàng');
        $grid->finish_date('Trạng thái bảo hành')->display(function ($date) {
            $countdown = Carbon::now()->diffInDays(Carbon::parse($date)->addMonth(3), false);
            $time_maintain_1 = date('d/m/Y', strtotime($date.' + 3 months'));
            return "<div class='alert-success text-center'>".(($countdown>=0)?$countdown."ngày nữa - ".$time_maintain_1."":"")."</div>";
        });
        $grid->column('Xem chi tiết')->display(function () {
            return '<a href="/admin/contracts_warranty_1/'.$this->id.'">Xem Các sản phẩm</a>';
        });
        $grid->filter(function ($filter) {
            $filter->between('finish_date', 'Tìm kiếm theo ngày')->datetime();
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

        $show->contract_code('Mã Hợp Đồng');
        $show->name_customer('Tên Khách Hàng');
        $show->construction_items('Hạng Mục');
        $show->phone('Số Điện Thoại');
        $show->address('Địa Chỉ');
        $show->email('Email');
        $show->status_mainten('Trạng Thái')->using([true => 'Bảo hành', false => 'Bảo Trì']);
        $show->finish_date('Ngày Hoàn Thành');
        $show->products('Sản Phẩm')->as(function ($products) {
            if(is_array($products))
            {
                $html = '<table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">STT</th>
                                  <th scope="col">Tên Sản Phẩm</th>
                                  <th scope="col">Nhà Cung Cấp</th>
                                  <th scope="col">Bảo hành lần 1</th>
                                  <th scope="col">Bảo hành lần 2</th>
                                  <th scope="col">Bảo hành lần 3</th>
                                  <th scope="col">Trạng Thái</th>
                                </tr>
                              </thead>
                        <tbody>';
                $i = 1;
                foreach ($products as $item) {
                    $data = Product::where('id',(int)$item)->first();
                    $countdown = Carbon::now()->diffInDays(Carbon::parse($this->finish_date)->addMonth(3), false);
                    $date1 = $countdown >0 ? '<span style="color:red;">'.date('d/m/Y', strtotime($this->finish_date.' + 3 months')).'</span>' : '<span style="text-decoration: line-through;">'.date('d/m/Y', strtotime($this->finish_date.' + 3 months')).'</span>';
                    if($data) {
                        $html .= '<tr>
                          <th scope="row">'.$i.'</th>
                          <td>'.$data->name.'</td>
                          <td>'.$data->provider.'</td>
                          <td>'. $date1.'</td>
                          <td>'.date('d/m/Y', strtotime($this->finish_date.' + 6 months')).'</td>
                          <td>'.date('d/m/Y', strtotime($this->finish_date.' + 12 months')).'</td>
                          <td>'.(($data->status_maitain_product)?'Bảo hành':'Bảo Trì').'</td>
                        </tr>';
                        $i++;
                    }
                }
                $html .= '</tbody></table>';
                return $html;
            }
        })->unescape();

        return $show;
    }
}
