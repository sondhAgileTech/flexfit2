<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class ImportDetailProductsOfContract extends AbstractTool
{

    /**
     * Set up script for import button.
     */
    protected function setUpScripts()
    {
        $script = <<<SCRIPT
function handleFileSelectProduct(evt) {
    var file = evt.target.files; // FileList object
    var fileName = file[0].name;

    $('#input-import').hide();
    $('#confirm-import').show();
    $('#confirm-import .text-import').text(fileName);
}

$('#file-import').on('change', handleFileSelectProduct);

$('#confirm-import').on('click', function() {

    var formData = new FormData();
    if ($("input[name='csvProductOfContract']").val()!== '') {
        formData.append( "file", $("input[name='csvProductOfContract']").prop("files")[0] );
    }
    formData.append("_token", LA.token);

    $.ajax({
        method: 'POST',
        url: 'contract/csv/import/product',
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
            $.pjax.reload('#pjax-container');
            toastr.success('Uploading Success');
        }
    });
});
SCRIPT;
        Admin::script($script);
    }

    /**
     * Render Import button.
     *
     * @return string
     */
    public function render()
    {

        $this->setUpScripts();

        $import = 'Nhập Thông Tin Bảo Hành Chi Tiết';

        return <<<EOT

            <div class="pull-right" style="margin-right: 10px">
            <label id="input-import">
            <span class="btn btn-sm btn-twitter">
            <span><i class="fa fa-upload"></i> {$import}</span>
            <input type="file" id="file-import" name="csvProductOfContract" style="display:none">
            </span>
            </label>
            <span id="confirm-import" class="btn btn-sm btn-twitter" style="display:none">
            <span><i class="fa fa-upload"></i> <span class="text-import"></span></span>
            </span>
            </div>
EOT;

    }
}