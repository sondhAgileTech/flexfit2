<?php

namespace App\Admin\Controllers;

use App\Contract;
use App\Http\Controllers\Controller;
use App\Library\TokenGenerator;
use App\Product;
use App\ContractProduct;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NotiChangeTimeContractController extends Controller
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
        $grid->model()->where('status_changed_time_maintain','=', 'pending')->orderBy('created_at', 'asc');
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->contract_code('Mã Hợp Đồng');
        $grid->name_customer('Tên Khách Hàng');
        $grid->phone('Số Điện Thoại');
        $grid->email('Email');
        $grid->changed_time_maintain('Thời gian muốn thay đổi')->display(function($date){
            return date('d/m/Y', strtotime($date));
        });
        $grid->status_changed_time_maintain('Trạng thái')->display(function($status){
            if($status == 'pending') {
                return "Chờ duyệt";
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
        $show = new Show(Contract::findOrFail($id));

        $show->contract_code('Mã Hợp Đồng');
        $show->name_customer('Tên Khách Hàng');
        $show->construction_items('Hạng Mục');
        $show->phone('Số Điện Thoại');
        $show->address('Địa Chỉ');
        $show->email('Email');
        $show->status_mainten('Trạng Thái')->using([true => 'Bảo hành', false => 'Bảo Trì']);
        $show->finish_date('Ngày Hoàn Thành');
        $show->language('Ngôn Ngữ');
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
                    if($data) {
                        $html .= '<tr>
                          <th scope="row">'.$i.'</th>
                          <td>'.$data->name.'</td>
                          <td>'.$data->provider.'</td>
                          <td>'.date('d/m/Y', strtotime($this->finish_date.' + 3 months')).'</td>
                          <td>'.date('d/m/Y', strtotime($this->finish_date.' + 6 months')).'</td>
                          <td>'.date('d/m/Y', strtotime($this->finish_date.' + 12 months')).'</td>
                          <td>'.(($data->status_maitain_product)?'Bảo Trì':'Không Bảo Trì').'</td>
                        </tr>';
                        $i++;
                    }
                }
                $html .= '</tbody></table>';
                return $html;
            }
        })->unescape();

        $show->id('QR Code')->as(function ($id) {
            $data = Contract::where('id',$id)->first();
            if($data)
            {
                $token = base64_encode(TokenGenerator::encrypt($data->id.'<>'.$data->contract_code.'<>'.$data->email, env('APP_KEY'), 256));
                $url = env('APP_URL').'/hop-dong/'.$data->contract_code;
                $html = QrCode::size(400)->generate(env('APP_URL').'/'.$token);
                $html .= '<table class="table">';
                $html .= '<tr><td><strong>Đường Dẫn</strong></td><td> <a href="'.$url.'" target="_blank">'.$url.'</a></td></tr>';
                $html .= '<tr><td><strong>Token</strong></td><td> '.$token.'</td></tr>';
                $html .= '<tr><td><strong>Đường Dẫn Kèm Token</strong></td><td> <a href="'.env('APP_URL').'/'.$token.'" target="_blank">'.env('APP_URL').'/'.$token.'</a></td></tr>';
                $html .= '</table>';
                return $html;
            }
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
        $form = new Form(new Contract);

        $status = ['pending'=>'Chờ duyệt', 'accept'=> 'Chập nhận thay đổi'];
        $form->select('status_changed_time_maintain', 'Trạng thái')->options($status);
        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();
    
            // disable `View` checkbox
            $footer->disableViewCheck();
        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
        
        });

        $form->saved(function (Form $form) {
            if($form->model()->status_changed_time_maintain == 'accept') {

                ContractProduct::where('contract_id', '=' , $form->model()->id)->update([
                    'guarantee_one' => Carbon::parse($form->model()->changed_time_maintain)->addMonth(3),
                    'guarantee_two' => Carbon::parse($form->model()->changed_time_maintain)->addMonth(6),
                    'guarantee_three' => Carbon::parse($form->model()->changed_time_maintain)->addMonth(12),
                ]);
                Contract::where('id', '=' , $form->model()->id)->update(['finish_date' => $form->model()->changed_time_maintain ]);
            }        
        });

        return $form;
    }
}