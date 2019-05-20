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
                        {field: 'type', title: __('Type')},
                        {field: 'order_amount', title: __('Order_amount'), operate:'BETWEEN'},
                        {field: 'goods_detail', title: __('Goods_detail')},
                        {field: 'goods_title', title: __('Goods_title')},
                        {field: 'user_in', title: __('User_in'), operate:'BETWEEN'},
                        {field: 'agent_in', title: __('Agent_in'), operate:'BETWEEN'},
                        {field: 'platform_in', title: __('Platform_in'), operate:'BETWEEN'},
                        {field: 'yeepay_in', title: __('Yeepay_in'), operate:'BETWEEN'},
                        {field: 'order_status', title: __('Order_status')},
                        {field: 'residual_amount', title: __('Residual_amount'), operate:'BETWEEN'},
                        {field: 'divide_rate', title: __('Divide_rate'), operate:'BETWEEN'},
                        {field: 'add_time', title: __('Add_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'sn', title: __('Sn')},
                        {field: 'wkuser.id', title: __('Wkuser.id')},
                        {field: 'wkuser.type', title: __('Wkuser.type')},
                        {field: 'wkuser.user_name', title: __('Wkuser.user_name')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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