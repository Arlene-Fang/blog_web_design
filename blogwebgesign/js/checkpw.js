function checkpwd(){
    var p1=document.reform.password.value;//获取密码框的值
    var p2=document.reform.cpassword.value;//获取重新输入的密码值
    if(p1==""){
        alert("Oops! There is no password~");//检测到密码为空，提醒输入//
        document.reform.password.focus();//焦点放到密码框
        return false;//退出检测函数
    }//如果允许空密码，可取消这个条件
                  
    if(p1!=p2){//判断两次输入的值是否一致，不一致则显示错误信息
        alert("Oops! Password does not match.");//检测到密码为空，提醒输入//
        document.reform.password.focus();//焦点放到密码框
        return false;
    }else{
        //密码一致，可以继续下一步操作 
    }
}