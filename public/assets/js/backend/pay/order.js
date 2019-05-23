define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'pay/order/index' + location.search,
                    add_url: 'pay/order/add',
                    edit_url: 'pay/order/edit',
                    del_url: 'pay/order/del',
                    multi_url: 'pay/order/multi',
                    table: 'wk_order',
                }
            });
            // $(document).on('click','.spec_add_btn', function (event) {
            //     var url = $(this).attr('data-url');
            //     if(!url) return false;
            //     var msg = $(this).attr('data-title');
            //     var width = $(this).attr('data-width');
            //     var height = $(this).attr('data-height');
            //     var area = [$(window).width() > 800 ? (width?width:'800px') : '95%', $(window).height() > 600 ? (height?height:'600px') : '95%'];
            //     var options = {
            //         shadeClose: false,
            //         shade: [0.3, '#393D49'],
            //         area: area,
            //         callback:function(value){
            //             CallBackFun(value.id, value.name);//在回调函数里可以调用你的业务代码实现前端的各种逻辑和效果
            //         }
            //     };
            //     Fast.api.open(url,msg,options);
            // });
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
                        {field: 'user_id', title: __('User_id')},
                        {field: 'leader_id', title: __('Leader_id')},
                        {field: 'type', title: __('Type'), searchList: {"1":__('Type 1'),"2":__('Type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'order_amount', title: __('Order_amount'), operate:'BETWEEN'},
                        {field: 'goods_detail', title: __('Goods_detail')},
                        {field: 'goods_title', title: __('Goods_title')},
                        {field: 'user_in', title: __('User_in'), operate:'BETWEEN'},
                        {field: 'agent_in', title: __('Agent_in'), operate:'BETWEEN'},
                        {field: 'platform_in', title: __('Platform_in'), operate:'BETWEEN'},
                        {field: 'yeepay_in', title: __('Yeepay_in'), operate:'BETWEEN'},
                        {field: 'order_status', title: __('Order_status'), searchList: {"1":__('Order_status 1'),"2":__('Order_status 2'),"3":__('Order_status 3')}, formatter: Table.api.formatter.status},
                        {field: 'residual_amount', title: __('Residual_amount'), operate:'BETWEEN'},
                        {field: 'divide_rate', title: __('Divide_rate'), operate:'BETWEEN'},
                        {field: 'add_time', title: __('Add_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'sn', title: __('Sn')},
                        // {field: 'wkuser.id', title: __('Wkuser.id')},
                        {field: 'wkuser.type', title: __('Wkuser.type'), searchList: {"1":__('Wkuser_type 1'),"2":__('Wkuser_type 2'),"3":__('Wkuser_type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'wkuser.user_name', title: __('Wkuser.user_name')},
                        {
                            field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'refund',
                                    title: __('退款'),
                                    classname: 'btn btn-xs btn-primary btn-addtabs',
                                    icon: 'fa fa-list',
                                    url: 'pay/order/refund',
                                    hidden:function(row){
                                        // Layer.alert("接收到回传数据：" + JSON.stringify(row), {title: "回传数据"});
                                        // Layer.alert("接收到回传数据：" +  JSON.stringify(111), {title: "回传数据"});
                                        if(row.order_status == 1 || row.order_status == 3 || row.update_time < parseInt(Date.parse(new Date())/1000-7200) || row.group_id == 1){

                                            return true;
                                        }
                                    },
                                    // callback: function (data) {
                                    //     Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    // }
                                }],
                            formatter: Table.api.formatter.operate
                        },
                        // {
                        //     field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate,
                        //     formatter: Table.api.formatter.operate
                        // },
                        // {
                        //     field: 'buttons',
                        //     width: "120px",
                        //     title: __('按钮组'),
                        //     table: table,
                        //     events: Table.api.events.operate,
                        //     buttons: [
                        //         {
                        //             name: 'detail',
                        //             text: __('弹出窗口打开'),
                        //             title: __('弹出窗口打开'),
                        //             classname: 'btn btn-xs btn-primary btn-dialog',
                        //             icon: 'fa fa-list',
                        //             url: 'example/bootstraptable/detail',
                        //             callback: function (data) {
                        //                 Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                        //             },
                        //             visible: function (row) {
                        //                 //返回true时按钮显示,返回false隐藏
                        //                 return true;
                        //             }
                        //         },
                        //         {
                        //             name: 'ajax',
                        //             text: __('发送Ajax'),
                        //             title: __('发送Ajax'),
                        //             classname: 'btn btn-xs btn-success btn-magic btn-ajax',
                        //             icon: 'fa fa-magic',
                        //             url: 'example/bootstraptable/detail',
                        //             confirm: '确认发送',
                        //             success: function (data, ret) {
                        //                 Layer.alert(ret.msg + ",返回数据：" + JSON.stringify(data));
                        //                 //如果需要阻止成功提示，则必须使用return false;
                        //                 //return false;
                        //             },
                        //             error: function (data, ret) {
                        //                 console.log(data, ret);
                        //                 Layer.alert(ret.msg);
                        //                 return false;
                        //             }
                        //         },
                        //         {
                        //             name: 'addtabs',
                        //             text: __('新选项卡中打开'),
                        //             title: __('新选项卡中打开'),
                        //             classname: 'btn btn-xs btn-warning btn-addtabs',
                        //             icon: 'fa fa-folder-o',
                        //             url: 'example/bootstraptable/detail'
                        //         }
                        //     ],
                        //     formatter: Table.api.formatter.buttons
                        // }
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});