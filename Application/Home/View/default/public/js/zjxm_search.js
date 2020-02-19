
            //菜单选择导航
            $('.rs a').bind('click', function () {
                alert(11);
                //判断多选
                if($(this).hasClass("part-multi-select")){
                    if($(this).parent().siblings(".part-choose-list-a-cont").hasClass("part-heigt-s")){
                        $(this).addClass("fn-v-hide").parents("section").siblings(".part-choose-list-a-cont").addClass("small-icon-gou").children("div").show().siblings().find("span").before("<i></i>");
                    }else{
                        $(this).addClass("fn-v-hide").siblings().addClass("current").children(".j-multi-more").text("收起").parents("section").siblings(".part-choose-list-a-cont").addClass("small-icon-gou part-heigt-s").children("div").show().siblings().find("span").before("<i></i>");
                    }
                    return false;
                }

                //判断更多
                if($(this).hasClass("current")){
                    $(this).removeClass("current").children(".j-multi-more").text("更多").parents("section").siblings(".part-choose-list-a-cont").removeClass("part-heigt-s small-icon-gou").children("p").find("a").removeClass("cur").find("i").remove();
                    if($(this).siblings().text()!=''){
                        $(this).siblings().removeClass("fn-v-hide").parents("article").find(".part-choose-list-a-cont").children("div").hide();
                    }
                }else{
                    if($(this).siblings().text()!=''){
                        $(this).siblings().removeClass("fn-v-hide");
                    }
                    $(this).addClass("current").find(".j-multi-more").html("收起").parents("section").siblings(".part-choose-list-a-cont").addClass("part-heigt-s");
                }
            });
            

            //点击选择
            $('.part-choose-list-a .ui-btn-gray').bind('click', function () {
                 if($(this).parents(".part-choose-list-a-cont").siblings("section").find(".part-multi-select").text()!=''){
                      $(this).parent().hide().parent(".part-choose-list-a-cont").siblings("section").find(".part-multi-select").removeClass("fn-v-hide");
                  }
                 $(this).parents(".part-choose-list-a-cont").removeClass("part-heigt-s small-icon-gou").siblings("section").find(".part-multi-select").siblings().removeClass("current").children(".j-multi-more").text("更多");
                 $(this).parent().siblings().children().removeClass("cur").find("i").remove();
            });
            