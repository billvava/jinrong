function YYYYMMDDstart(){
    //先给年下拉框赋内容   
    var y  = new Date().getFullYear();
    for (var i = (y-30); i <= (y); i++) 
    //以今年为准，前30年，后30年   
    document.FormData.found_time.options.add(new Option(" "+ i +" 年", i));   
    document.FormData.found_time.value = y;
}

if(document.attachEvent){
    window.attachEvent("onload", YYYYMMDDstart);
}else{
    window.addEventListener('load', YYYYMMDDstart, false);
}