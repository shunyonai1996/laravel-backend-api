<?php

namespace App\Admin\Extensions\Tools;
 
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;

class CsvImport extends AbstractTool
{
    /**
     * Set up script for import button.
     */
    protected function script()
    {
        return <<< SCRIPT

        $('.csv-import').click(function() {
            let select = document.getElementById('files');
            select.click();
            select.addEventListener('change',function() {
                let fd = new FormData();
                fd.append( "file", $("input[name='pattern']").prop("files")[0] );
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : "POST",
                    url : "/admin/pattern_user/import",
                    data : fd,
                    processData : false,
                    contentType : false,
                    success: function (response) {
                        $.pjax.reload("#pjax-container");
                        toastr.success('Upload Successful');
                    },
                    error: function (response) {
                        $.pjax.reload("#pjax-container");
                        toastr.error('Upload Failed(Validation error!!!)');
                    },
                });
            });
        });

        SCRIPT;
    }
     
    /**
     * Render Import button.
     *
     * @return string
     */
    public function render()
    {
            Admin::script($this->script());

            return view('csv_upload');
    }
}