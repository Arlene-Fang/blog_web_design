      $(document).ready(function(){
        // .modal-trigger类所在的a标签的href属性必须制定模态框的id才能被触发。
        $('.modal').modal({
            dismissible: false, // 点击模态外面模态消失关闭
            opacity: .5, // 相对于背景的不透明度
            in_duration: 300, // 显示特效的时间
            out_duration: 200, // 消失特效时间
            starting_top: '4%', // 启动时的样式属性
            ending_top: '10%', // 结束时的样式属性
            ready: function(modal, trigger) {
                console.log(modal, trigger);
            },
            
        });
      });