define(['jquery', 'bootstrap', 'backend', 'table', 'form','jquery-code'], function ($, undefined, Backend, Table, Form,jquery_code) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'pay/account/index' + location.search,
                    add_url: 'pay/account/add',
                    edit_url: 'pay/account/edit',
                    del_url: 'pay/account/del',
                    multi_url: 'pay/account/multi',
                    table: 'wk_order',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'order_id', title: __('Order_id')},
                        {field: 'unique_order_id', title: __('Unique_order_id')},
                        {field: 'order_status', title: __('支付状态'), searchList: {"1":__('Order_status 1'),"2":__('Order_status 2'),"3":__('Order_status 3')}, formatter: Table.api.formatter.status},
                        {field: 'type', title: __('Type'), searchList: {"1":__('Type 1'),"2":__('Type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'order_amount', title: __('Order_amount'), operate:'BETWEEN'},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},

                        {
                            field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'refund',
                                    title: __('退款'),
                                    classname: 'btn btn-xs btn-primary btn-addtabs',
                                    icon: 'fa fa-list',
                                    url: 'pay/account/refund',
                                    hidden:function(row){
                                        // Layer.alert("接收到回传数据：" + JSON.stringify(row), {title: "回传数据"});
                                        // Layer.alert("接收到回传数据：" +  JSON.stringify(111), {title: "回传数据"});
                                        // if(row.order_status == 1 || row.order_status == 3 || row.update_time < parseInt(Date.parse(new Date())/1000-7200)){
                                        if(row.order_status == 1 || row.order_status == 3){

                                            return true;
                                        }
                                    },
                                    // callback: function (data) {
                                    //     Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    // }
                                }],
                            formatter: Table.api.formatter.operate
                        },
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        paymethod:function () {
            $(".weixinbtn").click(function() {
                if($('#money').val().trim()===''||$('#money').val().trim()<=0){
                    alert('金额必须是不能为空的大于0的数值');
                    return(false)
                }
                var amount = $("#money").val();
                var query = new Object();
                query.amount = amount;
                query.type = 2;
                $.ajax({
                    url: "pay/account/paymethod",
                    async: false, //同步 非异步
                    data: query,
                    type: "POST",
                    dataType: "json",
                    success: function(result) {
                        var path = "data:image/png;base64," + result.data;
                        $("#qrcode").attr("src", path);
                        $("#weixinPay").css("display", "block");
                        $("#zhifuPay").css("display", "none");
                    },
                    error: function() {
                        alert("失败");
                    }
                });
            });
            $(".zhifubtn").click(function() {
                if($('#money').val().trim()===''||$('#money').val().trim()<=0){
                    alert('金额必须是不能为空的大于0的数值');
                    return(false)
                }
                var amount = $("#money").val();
                var query = new Object();
                query.amount = amount;
                query.type = 1;
                $.ajax({
                    url: "pay/account/paymethod",
                    async: false, //同步 非异步
                    data: query,
                    type: "POST",
                    dataType: "json",
                    success: function(result) {
                        var path = "data:image/png;base64," + result.data;
                        $("#qrcode").attr("src", path);
                        $("#zhifuPay").css("display", "block");
                        $("#weixinPay").css("display", "none");
                    },
                    error: function() {
                        alert("失败");
                    }
                });
            });
            $("#money").blur(function() {
                let reg = /^([1-9]\d*(\.\d*[1-9])?)|(0\.\d*[1-9])$/;
                if ($('#money').val().trim().length === 0) {
                    $('.warntext').css('display','none')
                    console.log('1')
                } else if (
                    !reg.test($('#money').val().trim())
                ) {
                    console.log('2');
                    $('.warntext').css('display','block')
                } else {
                    $('.warntext').css('display','none')
                }
                return true;
            });
        },

        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
