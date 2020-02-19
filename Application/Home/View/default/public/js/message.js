$('#leave_msg_content').on('keyup',function(){
    var $this=$(this);
    var maxChars = $this.attr('maxlength')||300;
    var num = maxChars - $this.val().length;
    var $tip=$('#leave_msg_input_tip');
        if(!$tip){
            return;
        }
                if (num < 0) {
                    $tip.html('<span class="colye">您输入的内容，已超过'+maxChars+'个字，请重新编辑</span>');
                }
                else if(num!=0) {
                    $tip.html('还可输入<span class="colye">' + num + '</span>个字');
                }
                else{
                    $tip.html('已经'+maxChars+'个字了');
                }
            });
