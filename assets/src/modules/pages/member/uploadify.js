define(function(require){

    require('module/uploadify/jquery.uploadify');

    return {
        _config:null,
        initialize:function(params){
            this._config = params;

            var config = {
                  'formData'     : {
                  "token" : params.formData.token,
                  "uid" : params.formData.uid,
                  "upname" : params.formData.type,
                  "type" : params.formData.type
                  },
                  'auto':true,
                  'debug':false,
                  'multi': false,
                  'removeTimeout' : 0,
                  'fileSizeLimit' : '1536KB',
                  'fileTypeDesc' : '上传文件',
                  'fileTypeExts' : '*.gif;*.jpg;*.jpeg;*.png;',
                  'buttonImage' : params.buttonImage,
                  'height':22,
                  'width':61,
                  'swf': params.swf,
                  'uploader' : params.uploader,
                  'file_post_name' : params.file_post_name,
                  'onUploadSuccess' : params.callback
            };
            if(params.formData.upname)
                config['formData']['upname'] = params.formData.upname;

            $('#'+config.file_post_name).uploadify(config);
        }
    }
});