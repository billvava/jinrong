var formValidator = function(options){
  this.config=$.extend({
        isIcon:true,
        errIcoCls:'icoErr16',
        succIcoCls:'icoCor16',
        nomalIcoCls:'icoPro16',
        errFontCls:'',
        okHide:false
    }, options || {});
    this.els = null;
    this.els=null;
    this.okhide=this.config.okHide;
}

formValidator.prototype ={
    cerror:function(self){
        if ($('#'+self.attr('name')+'-error').length > 0)
        {
            self = $('#'+self.attr('name')+'-error');
        }
        else{
            self = self.nextAll('em');
            if (!self || self.length==0)self = self.end().parent().nextAll('em').first();
        }
        return self;
    },
    tip:function(self, style,msg){
        self = this.cerror(self);
        var ymsg = self.attr('data-msg');
        if (!ymsg)
        {
            ymsg = self.text();
            self.attr('data-msg', ymsg);
        }
        self.show();
        if (msg)
        {
            ymsg = msg;
        }
        else
        {
            if (style == this.config.succIcoCls)ymsg='';
        }
        this.config.isIcon && ( ymsg  = '<i class="'+style+'"></i>'+ymsg);
        this.config.errFontCls && style == this.config.errIcoCls && self.addClass(this.config.errFontCls);
        this.config.errFontCls && style != this.config.errIcoCls && self.removeClass(this.config.errFontCls);
        self.html(ymsg);
    },
    errtip:function(self,msg,def){
        if (def === true)
            msg = languages[msg] || '';
        else
            msg = languages[msg] || msg;
        this.tip(self, this.config.errIcoCls, msg);
        return false;
    },
    hidetip:function(self){
        this.cerror(self).hide();
    },
    setels:function(id){
        this.els = document.getElementById(id).elements;
    },
    init:function(id){
        var $this  = this
            els = document.getElementById(id).elements,
            $this.els = els;
        if ($this.els)
        for(var i=0, max=els.length; i < max; i++)
        {
            var  el = els[i],
                self =$( el );
            if (el.type == 'file')
            {
               self.change(function(e){
                   $this.valid($(this));
               });
            }else{
                self.blur(function(e){
                    if (!$(this).attr('data-rule')) {
                        $this.hidetip($(this));
                        return;
                    }
                    if ($(this).attr('name').substring(0,1)==='S')
                    {
                        $(this).val($(this).val().replace(/#/g,'').replace(/\|/g,''));
                    }
                    var flag = $this.valid($(this), true);
                    if (flag && $(this).attr('name') == 'amount_interval_min')
                    {
                        var omax = $(this).nextAll('input');
                        if (!omax.val())omax.val($(this).val());
                    }
                }).focus(function(){
                    $this.tip($(this), 'icoPro16');
                })
           }
        }
        $this.placeholder();
    },
    placeholder:function()
    {
        try{
            if (window.qrh_Config && (window.qrh_Config.page=='publish'))
            {
                var $this = this,val=$this.els['cat_id'].value,fields;
                switch(val.substring(0,val.length-32))
                {
                    default:
                    return;
                }
                if (fields) {
                    for (var k in fields) {
                        $($this.els[k]).each(function(){
                            var _this = $(this);
                            if (typeof fields[k] == 'string') {
                                var holder = fields[k];
                            } else {
                                var holder = fields[k]['holder'];
                                if (fields[k]['tip']) {
                                    _this.parent().append('<div style="color:#dc5c5c">'+fields[k]['tip']+'</div>');
                                }
                                if (fields[k]['err_info']) {
                                    _this.nextAll('em').html('<i class="icoPro16"></i>'+fields[k]['err_info']+'</em>');
                                }
                                if (fields[k]['rule']) {
                                    _this.attr('data-rule',fields[k]['rule']);
                                }
                                if (fields[k]['maxlength']) {
                                    _this.attr('maxlength',fields[k]['maxlength']);
                                }
                                if (fields[k]['lenerr']) {
                                    _this.attr('min_length_err',fields[k]['lenerr']).attr('max_length_err',fields[k]['lenerr']);
                                }
                            }
                            _this.attr('holder',holder);
                            _this.focus(function(){
                                if (holder == _this.val())_this.val('');
                            }).blur(function(){
                                if (!_this.val())_this.val(holder);
                            });
                            if (!_this.val())_this.val(holder);
                        })
                    }
                }
            }
        }catch (e){}
    },
    valid:function(self, is_merge){
        if (!self.is(":visible"))return;
        var $this  = this,
            merge = '',
            _val = '';
        switch(self.attr('type'))
        {
            case 'select-one':
            case 'select':
            case 'raido':
            case 'hidden':
            case 'text':
            case 'password':
            case 'textarea':
            case 'file':
                if (is_merge)
                {
                    merge = self.attr('data-merge');
                    if(merge)
                    {
                        merge = merge.split(',');
                        for(var i=0;i<merge.length;i++)
                        {
                           if ( ! $this.valid(  $($this.els[merge[i]]), false  ) ) return false;
                        }
                    }
                }
                _val = self.val();
                if(self.attr('tip') && self.attr('tip')==_val)_val='';
                break;
            case 'checkbox':
                _val = $('input[name='+self.attr('name').replace('[','\\[').replace(']','\\]')+']').map(function(){
                    if ($(this).attr('checked') == true)return $(this).val();
                }).get().join(',');
                break;
            default:
                return true;
                break;
        }
        _val = $.trim(_val);
        if (_val && _val == self.attr('holder')) _val = '';
        var $rules = self.attr('data-rule');
        if (!$rules)return true;
        var _rules = $rules.split('|');
        if (_rules[0] == 'required' && !_val)
        {
            $this.errtip(self);
            return false;
        }
        if (!_val) {
            $this.hidetip(self);
            return true;
        }
        var _ajaxcheck = false;
        for(var i=0;i<_rules.length;i++)
        {
            var _rule = _rules[i];
            if (_rule == 'required')continue;
            var _pos   = _rule.indexOf('[');
            var _type  = _rule.substring(0,_pos);
            var _dval  = _rule.substring(_pos+1, _rule.length-1) || '';
            switch(_type)
            {
                case 'regexp':
                    if (_dval && !(new RegExp(eval("regexEnum." + _dval), 'i').test(_val)))
                        return $this.errtip(self, _dval+'_error', true);
                break;
                case 'F':
                    if (_dval)eval('var _fs ='+_dval+'("'+_val+'")');
                    if (_dval && !_fs)
                        return $this.errtip(self, _dval+'_error', true);
                break;
                case 'matches':
                    if (_dval && $this.els[_dval].value != _val)
                        return $this.errtip(self, _dval+'_matches', true);
                break;
                case 'min_length':
                    var _len = parseFloat(_dval);
                    if (_val.length < _len) {
                       return $this.errtip(self, self.attr('min_length_err') || '该值长度必须大于 '+_len+' 个字符');
                    }
                break;
                case 'max_length':
                    var _len = parseFloat(_dval);
                    if (_val.length > _len)
                       return $this.errtip(self, self.attr('max_length_err') || '该值长度必须小于 '+_len+' 个字符');
                break;
                case 'min_clength':
                    var _len = parseFloat(_dval);
                    if (dataLength(_val) < _len) {
                       return $this.errtip(self, self.attr('min_length_err') || '该值长度必须大于 '+_len+' 个字符');
                    }
                break;
                case 'max_clength':
                    var _len = parseFloat(_dval);
                    if (dataLength(_val) > _len)
                       return $this.errtip(self, self.attr('max_length_err') || '该值长度必须小于 '+_len+' 个字符');
                break;
                case 'greater':
                    if (_dval == 'min_max')
                    {
                        var _name = self.attr('name');
                        _name   = _name.substr(0,_name.length-4);
                        var _min = parseFloat($this.els[_name+'_min'].value);
                        var _max = parseFloat($this.els[_name+'_max'].value);
                        //暂时额外处理一下
                        try{
                            switch(_name)
                            {
                                case 'amount_interval':
                                _min *= parseInt($this.els[_name+'_min_unit'].value);
                                _max *= parseInt($this.els[_name+'_max_unit'].value);
                                if(_min && _max && new String(parseInt(_max)).length - new String(parseInt(_min)).length >2)
                                    return $this.errtip(self, '金额区间超出2个数量级，请重新填写');

                                if ($this.els['amount'])$this.valid($($this.els['amount']), false);
                                break;
                            }
                        }catch (e){}
                        if (_name &&  _min> _max)
                          return $this.errtip(self, '起始值必须小于结束值');
                    }
                    else if (parseInt(_dval) != _dval)
                    {
                        try{
                            var o = $($this.els[_dval]);
                            var _dval = parseFloat(o.val())*parseInt($this.els[_dval+'_unit'].value);
                            var _name = self.attr('name');
                            var _max  =  parseFloat($this.els[_name].value)*parseInt($this.els[_name+'_unit'].value);
                            if (_name && $this.els[_name].value.length>0 && _max < _dval && self.attr('iname') && o.attr('iname'))
                               return $this.errtip(self, self.attr('iname')+'不能小于'+o.attr('iname'));
                        }catch (e){}
                    }
                    else
                    {
                        var _dval = parseInt(_dval);
                        var _name = self.attr('name');
                        var _max  =  parseFloat($this.els[_name].value);
                        if (_name && $this.els[_name].value.length>0 && _max <= _dval)
                           return $this.errtip(self, '该值必须大于'+(_dval < 0 ? '等于'+(_dval+1) : _dval));
                    }
                break;
                case 'valmin':
                    var _min = parseFloat(_dval);
                        _val = parseFloat(_val);
                    if (_val < _min)
                    {
                        var msg = '该值必须大于'+_min;
                        var re = new RegExp("valmin\\[(\\d+)\\]\\|valmax\\[(\\d+)\\]", "i" );
                        var a = re.exec( $rules );
                        if (a !==null)
                            msg = '该值的取值范围为'+a[1]+'-'+a[2]+'之间';
                        return $this.errtip(self, msg);
                    }
                break;
                case 'valmax':
                    var _max = parseFloat(_dval);
                        _val = parseFloat(_val);
                    if (_val > _max)
                    {
                        var msg = '该值必须小于'+_max;
                        var re = new RegExp("valmin\\[(\\d+)\\]\\|valmax\\[(\\d+)\\]", "i" );
                        var a = re.exec( $rules );
                        if (a !==null)
                            var msg = '该值的取值范围为'+a[1]+'-'+a[2]+'之间';
                        return $this.errtip(self, msg);
                    }
                break;
            }

            switch(self.attr('name'))
            {
                case 'xmrz_revenue':
                case 'xmrz_asset':
                var _vv = parseFloat($this.els['xmrz_revenue'].value) * parseInt($this.els['xmrz_revenue_unit'].value);
                if(_vv > 0 && _vv <10  && $this.els['xmrz_revenue'].value == $this.els['xmrz_asset'].value) {
                    return $this.errtip(self, '请重新填写营业额和净资产');
                }
                break;
                case 'last_year_revenue':
                case 'net_asset':
                var _vv = parseFloat($this.els['last_year_revenue'].value) * parseInt($this.els['last_year_revenue_unit'].value);
                if(_vv > 0 && _vv <10  && $this.els['last_year_revenue'].value == $this.els['net_asset'].value) {
                    return $this.errtip(self, '请重新填写营业额和净资产');
                }
                break;
                case 'transfer_price':
                case 'xmzc_assass':
                var _sa = parseFloat($this.els['transfer_price'].value)*parseInt($this.els['transfer_price_unit'].value);
                var _sb = parseFloat($this.els['xmzc_assass'].value)*parseInt($this.els['xmzc_assass_unit'].value);
                if(_sa > 0 && _sb > 0  && _sa > _sb)
                {
                    $this.tip(self, $this.config.nomalIcoCls, '转让价格一般低于资产估价');
                    _ajaxcheck = true;
                }
                break;
            }

        }
       if (_ajaxcheck==false)$this.okhide == true ? $this.hidetip(self) : $this.tip(self, 'icoCor16');
       return true;
    },
    isValid:function(id,callback){
        var $this  = this;
        if (id)$this.els = document.getElementById(id).elements;
        var callback = callback || function(){};
        var error = false;
        if($this.els)
        for(var i=0, max=$this.els.length; i < max; i++)
        {
            if ( $this.valid( $($this.els[i]), true ) == false )error = true;
        }
        if (error == false) callback();
        return error;
    },
    errors:function(error_messages){
        var $this  = this;
        for(var name in error_messages){
            if (!$this.els[name])continue;
           $this.tip($(this.els[name]), $this.config.errIcoCls, error_messages[name]);
        }
    }
}

var regexEnum =
{
    intege:"^-?[1-9]\\d*$",                 //整数
    intege1:"^[1-9]\\d*$",                  //正整数
    intege2:"^-[1-9]\\d*$",                 //负整数
    num:"^([+-]?)\\d*\\.?\\d+$",            //数字
    num1:"^[1-9]\\d*|0$",                   //正数（正整数 + 0）
    num2:"^-[1-9]\\d*|0$",                  //负数（负整数 + 0）
    num3:"^[0-9]\\d*$",                 //数字
    decmal:"^([+-]?)\\d*\\.\\d+$",          //浮点数
    decmal1:"^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$", //正浮点数
    decmal2:"^-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)$",//负浮点数
    decmal3:"^-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0)$", //浮点数
    decmal4:"^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*|0?.0+|0$",//非负浮点数（正浮点数 + 0）
    decmal5:"^(-([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*))|0?.0+|0$",//非正浮点数（负浮点数 + 0）

    email:"^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$", //邮件
    color:"^[a-fA-F0-9]{6}$",               //颜色
    url:"^http[s]?:\\/\\/([\\w-]+\\.)+[\\w-]+([\\w-./?%&=]*)?$",    //url
    chinese:"^[\\u4E00-\\u9FA5\\uF900-\\uFA2D]+$",//仅中文
    ascii:"^[\\x00-\\xFF]+$",               //仅ACSII字符
    zipcode:"^\\d{6}$",                     //邮编
    mobile:"^1(3[0-9]|4[0-9]|5[0-9]|7[0|1|3|6|7]|8[0-9])\\d{8}$",               //手机
    ip4:"^(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)$",  //ip地址
    notempty:"^\\S+$",                      //非空
    picture:"(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$",   //图片
    rar:"(.*)\\.(rar|zip|7zip|tgz)$",                               //压缩文件
    date:"^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$",                 //日期
    qq:"^[1-9]*[1-9][0-9]*$",               //QQ号码
    tel:"^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?$",   //电话号码的函数(包括验证国内区号,国际区号,分机号)
    username:"^\\w+$",                      //用来用户注册。匹配由数字、26个英文字母或者下划线组成的字符串
    letter:"^[A-Za-z]+$",                   //字母
    letter_u:"^[A-Z]+$",                    //大写字母
    letter_l:"^[a-z]+$",                    //小写字母
    //idcard:"^[1-9]([0-9]{14}|[0-9]{17})$",    //身份证
    idcard:"(^\\d{15}$)|(^\\d{18}$)|(^\\d{17}(\\d|X|x))$",  //身份证
    passwd:"^[0-9|a-z|A-Z]{6,20}$",
    passwd2:"^[0-9|a-z|A-Z|!\\+=\\<\\>\\/@#\\$%^&\\*~\\(\\)_:;\\?\\.,]{6,20}$",
    ps_username:"^[\\u4E00-\\u9FA5\\uF900-\\uFA2D|a-zA-Z]+$" //中文、字母、数字 _
}

var languages ={
'mobile_error':'请输入正确的手机号码',
'chinese_error':'只允许输入中文',
'passwd_error':'请输入6-20位字符组成的密码',
'newpwd_matches':'确认新密码输入不一致',
'email_error':'请输入正确的邮箱地址',
'ps_username_error':'请输入您的真实姓名',
'password_error':'请输入6-20位字符组成的密码',
'password_matches':'确认密码输入不一致',
'mobile_code':'请输入您收到的手机验证码',
'mobile_code_ok':'验证码已发送，若未收到，请先到拦截信息中查找，仍未发现请联系客服',
'mobile_code_ok2':'验证码已发送，若未收到，请先到拦截信息中查找，如无法收到验证码请点击<a href="javascript:;" onclick="MobileVoice();" class="red" style="text-decoration:underline;">语音播报验证码</a>',
'mobile_btn':'免费获取验证码',
'codetime':'[s]秒后重新发送',
'codetime2':'验证码已发送，请在<font color="red">{$s}</font>秒后重新获取，若未收到，请在拦截信息中查找或直接<a href="http://chat.53kf.com/webCompany.php?arg=qrh&style=1" target="_blank"><span style="text-decoration: underline;color:red;">联系客服</span></a>',
'neterror':'网络异常，请重试！',
'isIdCard_error':'身份证号码错误！'
}



;(function($) {
    //全局下拉菜单
    $.fn.hoverClass=function(b){
        var a=this;
        a.each(function(c){
            a.eq(c).hover(function(){
                $(this).addClass(b)
            },function(){
                $(this).removeClass(b)
            })
        });
        return a
    };

    //top排行
    $.fn.Sonny = function(option, callback){
        if(typeof option == "function"){
            callback = option;
            option = {};
        };
        var s = $.extend({delay:50,index:0}, option || {});
        var _this = this;
        var timer = null;
        $.each(this, function(n){
            $(this).bind("mouseover", function(){
                if(timer != null)
                    clearTimeout(timer);
                var obj = $(this);
                timer = setTimeout(function(){
                    _this.eq(s.index).removeClass(s.current);
                    s.index = n;
                    _this.eq(s.index).addClass(s.current);
                    if(callback){
                        callback(obj);
                    }
                }, s.delay);
            });
        });
    };

    //全局选项卡
    $.fn.Tabs = function(options){
        return this.each(function(){
            // 处理参数
            options = $.extend({
                event : 'mouseover',
                timeout : 0,
                auto : 0,
                callback : null,
                switchBtn : false
            }, options);
            var self = $(this),
                tabBox = self.children('.tabBox').children( 'div' ),
                menu = self.children('.tabMenu'),
                items = menu.find('li'),
                timer;
            var tabHandle = function(elem){
                    elem.siblings('li')
                        .removeClass('current')
                        .end()
                        .addClass('current');

                    tabBox.siblings('div')
                        .addClass('hide')
                        .end()
                        .eq( elem.index())
                        .removeClass('hide');
                },
                delay = function( elem, time ){
                    time ? setTimeout(function(){ tabHandle( elem ); }, time) : tabHandle( elem );
                },
                start = function(){
                    if( !options.auto ) return;
                    timer = setInterval( autoRun, options.auto );
                },
                autoRun = function( isPrev ){
                    var current = menu.find( 'li.current' ),
                        firstItem = items.eq(0),
                        lastItem = items.eq(items.length - 1),
                        len = items.length,
                        index = current.index(),
                        item, i;
                    if(isPrev){
                        index -= 1;
                        item = index === -1 ? lastItem : current.prev( 'li' );
                    }else{
                        index += 1;
                        item = index === len ? firstItem : current.next( 'li' );
                    }
                    i = index === len ? 0 : index;
                    current.removeClass('current');
                    item.addClass('current');

                    tabBox.siblings('div')
                        .addClass('hide')
                        .end()
                        .eq(i)
                        .removeClass('hide');
                    if( options.callback ){
                        options.callback.call(self);
                    }
                };
            items.bind(options.event,function(){
                delay($(this),options.timeout);
                if( options.callback ){
                    options.callback.call(self);
                }
            });
            if(options.auto){
                start();
                self.hover(function(){
                    clearInterval(timer);
                    timer = undefined;
                },function(){
                    start();
                });
            }
            if( options.switchBtn ){
                self.append( '<a href="#prev" class="tab_prev">previous</a><a href="#next" class="tab_next">next</a>' );
                var prevBtn = $( '.tab_prev', self ),
                    nextBtn = $( '.tab_next', self );
                prevBtn.click(function( e ){
                    autoRun( true );
                    e.preventDefault();
                });
                nextBtn.click(function( e ){
                    autoRun();
                    e.preventDefault();
                });
            }

        });
    };
    $.formValidator={
        els:null,
        okhide:false,
        tip:function(self, style,msg){
                        if ($('#'+self.attr('name')+'-error').length > 0){
                                self = $('#'+self.attr('name')+'-error');
                            }else{
            self = self.nextAll('em');}
            if (!self || self.length==0)self = self.end().parent().nextAll('em');
            var ymsg = self.attr('data-msg');
            if (!ymsg){
                ymsg = self.text();
                self.attr('data-msg', ymsg);
            }
            self.show();
            if (msg)
            {
                self.html('<i class="'+style+'"></i>'+msg);
            }else{
                if (style == 'icoCor16')ymsg='';
                self.html('<i class="'+style+'"></i>'+ymsg);
            }
        },
        hidetip:function(self){
            self = self.nextAll('em');
            if (!self || self.length==0)self = self.end().parent().nextAll('em');
            self.hide();
        },
        setels:function(id){
            this.els = document.getElementById(id).elements;
        },
        init:function(id){
            var $this  = this
                els = document.getElementById(id).elements,
                $this.els = els;
            if ($this.els)
            for(var i=0, max=els.length; i < max; i++){
                var  el = els[i],
                    self =$( el );
                if (!self.attr('data-rule'))continue;
                if (el.type == 'file'){
                   self.change(function(e){
                       $this.valid($(this));
                   });
               }else{
                  self.blur(function(e){
                       $this.valid($(this),true);
                   }).focus(function(){
                        $this.addClass('select');
                       $this.tip($(this),'icoPro16');
                   })
               }
            }
        },
        valid:function(self, is_merge){
            if (!self.is(":visible"))return;
            var $this  = this,
                _val = '',
                $rules = self.attr('data-rule');
            if (!$rules)return true;
            var _rules = $rules.split('|');
            switch(self.attr('type')){
                case 'select-one':
                case 'select':
                case 'raido':
                case 'hidden':
                case 'text':
                case 'password':
                case 'textarea':
                case 'file':
                    if (is_merge){
                        var merge = self.attr('data-merge');
                        if(merge){
                            merge = merge.split(',');
                            for(var i=0;i<merge.length;i++){
                               if (!$this.valid($($this.els[merge[i]]),false)) return false;
                            }
                        }
                    }
                    _val = self.val();
                    break;
                case 'checkbox':
                    _val = $('input[name='+self.attr('name').replace('[','\\[').replace(']','\\]')+']').map(function(){
                        if ($(this).attr('checked') == true)return $(this).val();
                    }).get().join(',');
                    break;
            }
            if (_rules[0] == 'required' && !_val){
                $this.tip(self, 'icoErr16');
                return false;
            }
            if (!_val)return true;
            var _ajaxcheck = false;
            for(var i=0;i<_rules.length;i++){
               var _rule = _rules[i];
               if (_rule == 'required')continue;
               if (_rule.substring(0,6) =='regexp'){
                    var _regexp = _rule.substring(7, _rule.length-1) || '';
                    if (_regexp){
                        if (!(new RegExp(eval("regexEnum." + _regexp), 'i').test(_val))){
                            var msg = eval('languages.'+_regexp+'_error');
                            $this.tip(self, 'icoErr16', msg ? msg : '');
                            return false;
                        }
                    }
                }
                else if (_rule.substring(0, 7) =='matches')
                {
                     var _field = _rule.substring(8, _rule.length-1) || '';
                     if (_field && $this.els[_field].value != _val){
                         var msg = eval('languages.'+_field+'_matches');
                         $this.tip(self, 'icoErr16', msg ? msg : '');
                        return false;
                     }
                }else if (_rule =='greater[min_max]'){
                //起始小于结束
                     var _name = self.attr('name');
                     _name  = _name.substr(0,_name.length-4);
                     var _min =  parseFloat($this.els[_name+'_min'].value);
                     var _max = parseFloat($this.els[_name+'_max'].value);
                     if(_name && _min>= _max){
                         var msg = '起始值必须小于结束值';
                         $this.tip(self, 'icoErr16', msg ? msg : '');
                        return false;
                     }
                }else if ( _rule.substring(0, 6) =='valmin')
                {
                     var _min = parseFloat(_rule.substring(7, _rule.length-1));
                     if (_val < _min){
                        var msg = '该值必须大于'+_min;
                        var re = new RegExp("valmin\\[(\\d+)\\]\\|valmax\\[(\\d+)\\]", "i" );
                        var a = re.exec( $rules );
                        if (a !==null){
                            var msg = '该值的取值范围为'+a[1]+'-'+a[2]+'之间';
                        }
                        $this.tip(self, 'icoErr16', msg ? msg : '');
                        return false;
                     }
                }else if ( _rule.substring(0, 6) =='valmax' )
                {
                     var _max = parseFloat(_rule.substring(7, _rule.length-1));
                     if (_val > _max){
                        var msg = '该值必须小于'+_max;
                        var re = new RegExp("valmin\\[(\\d+)\\]\\|valmax\\[(\\d+)\\]", "i" );
                        var a = re.exec( $rules );
                        if (a !==null){
                            var msg = '该值的取值范围为'+a[1]+'-'+a[2]+'之间';
                        }
                        $this.tip(self, 'icoErr16', msg ? msg : '');
                        return false;
                     }
                }
                else if (_rule.substring(0, 9) == 'ajaxcheck')
                {
                   _ajaxcheck = true;
                   var _field = _rule.substring(10, _rule.length-1) || '';
                   var success = function(res){
                          qrh.cache[_val] = res;
                          if (res.code == 200){
                                $this.okhide == true ? $this.hidetip(self) : $this.tip(self, 'icoCor16');
                                return true;
                           }else{
                               $this.tip(self, 'icoErr16', res.data.error);
                               return false;
                           }
                    }
                }
            }
           if (_ajaxcheck==false)$this.okhide == true ? $this.hidetip(self) : $this.tip(self, 'icoCor16');
           return true;
        },
        isValid:function(id,callback){
            var $this  = this;
            if (id)$this.els = document.getElementById(id).elements;
            var callback = callback || function(){};
            var error = false;
            if($this.els)
            for(var i=0, max=$this.els.length; i < max; i++)
            {
                if ( $this.valid( $($this.els[i]), true ) == false )error = true;
            }
            if (error == false) callback();
            return error;
        },
        errors:function(error_messages){
            for(var name in error_messages){
                if (!this.els[name])continue;
                this.tip($(this.els[name]), 'icoErr16', error_messages[name]);
            }
        }
    }
})($);
