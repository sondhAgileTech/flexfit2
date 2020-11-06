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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Admin\Extensions\Tools\ImportButton;
use App\Admin\Actions\Member\ImportAction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Member\ImportMember;

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

        $grid->contract_code('Mã Hợp Đồng');
        $grid->name_customer('Tên Khách Hàng');
        $grid->construction_items('Hạng Mục');
        $grid->phone('Số Điện Thoại');
        $grid->address('Địa Chỉ');
        $grid->email('Email');
        $grid->status_mainten('Trạng Thái')->display(function($status) {
            if($status == 1) {
                return "Bảo hành";
            } else {
                return "Bảo trì";
            }
        });
        $grid->finish_date('Ngày Hoàn Thành')->display(function($date){
            return date('d/m/Y', strtotime($date));
        });
        $grid->language('Ngôn Ngữ');
        
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('contract_code', 'Tìm kiếm Mã hợp đồng');
            $filter->like('name_customer', 'Tìm kiếm Tên khách hàng');
            $filter->like('phone', 'Tìm kiếm Số điện thoại');
        });

        $grid->tools(function ($tools) {
            $tools->append(new ImportButton());
        });

         return $grid;
    }

    //import excel
    protected function import(Content $content, Request $request)               
    {      
        
        try{
            // $request ...
            $file = $request-> file('file');
            Excel::import(new ImportMember, $file);
        
        }catch (\Exception $e){

        }                                  
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
                          <td>'.(($data->status_maitain_product)?'Bảo Hành':'Không Bảo Trì').'</td>
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
                $qrcode = base64_encode(QrCode::format('png')
                ->merge('http://baohanh.flexfit.vn/images/logo-flextfit.jpg', 0.2, true)
                ->size(400)->errorCorrection('H')
                ->generate(env('APP_URL').'/'.$token));
                $url = env('APP_URL').'/hop-dong/'.$data->contract_code;
                $html = '<img src="data:image/png;base64, '.$qrcode.'">';
                $html .= '<a href="/api/download/'.$data->contract_code.'" target="_blank">Click vào đây để download file bảo hành</button>';
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

        $form->text('contract_code', 'Mã Hợp Đồng')->rules('required', [
            'required' => 'Xin vui lòng nhập mã hợp đồng.'
        ]);
        $form->text('name_customer', 'Tên Khách Hàng')->rules('required', [
            'required' => 'Xin vui lòng nhập họ và tên khách hàng.'
        ]);
        $form->text('construction_items', 'Hạng Mục')->rules('required', [
            'required' => 'Xin vui lòng nhập hạng mục.'
        ]);
        $form->text('phone', 'Số Điện Thoại')->rules('required|regex:/^\d+$/|max:12', [
            'required' => 'Xin vui lòng nhập số điện thoại.',
            'regex' => 'Số điện thoại phải là số.',
            'min'   => 'Số điện không quá 12 ký tự.'
        ]);
        $form->text('address', 'Địa Chỉ')->rules('required', [
            'required' => 'Xin vui lòng nhập địa chỉ.'
        ]);
        $form->email('email', 'Email')->rules('required', [
            'required' => 'Xin vui lòng nhập địa chỉ email.'
        ]);
        $form->select('status_mainten', 'Trạng Thái')->options([true => 'Bảo hành', false => 'Bảo Trì'])->default(true);
        $form->datetime('finish_date', 'Ngày Hoàn Thành')->default(date('Y-m-d H:i:s'))->rules('required', [
            'required' => 'Xin vui lòng nhập Ngày hoàn thành.'
        ]);
        $language = ['en'=>'English', 'vi'=> 'Việt nam'];
        $form->select('language', 'Ngôn Ngữ')->options($language);
        $form->multipleSelect('products',__('Sản Phẩm'))->options(function ($id) {
            $data = Product::find($id);
            if($data)
            {
                $result = [];
                foreach ($data as $item)
                {
                    $result[$item->id] = $item->name;
                }
                return $result;
            }

        })->rules('required', [
            'required' => 'Xin vui lòng chọn sản phẩm.'
        ])->ajax('/'.config('admin.route.prefix').'/api/product');

        $form->file('file_upload','Upload file')->name(function ($file) {
            return 'File_bao_hanh.'.$file->guessExtension();
        });

        // $form->file('file_upload','Upload file')->move($dir, $name);
        // $form->hasMany('product_list', 'Danh Sách Sản Phẩm', function (Form\NestedForm $form) {
        //     $form->select('product_id','Sản Phẩm')->options(Product::all()->pluck('name','id'));
        //     $form->datetime('selected_at', 'Ngày bảo hành')->default(date('Y-m-d H:i:s'));
        // });

        return $form;
    }
}