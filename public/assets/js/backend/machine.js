define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'machine/index' + location.search,
                    add_url: 'machine/add',
                    edit_url: 'machine/edit',
                    del_url: 'machine/del',
                    multi_url: 'machine/multi',
                    table: 'machine',
                }
            });

            var table = $("#table");//这个就对应了前端(admin\view\machine\index.html)

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'machine_id',//这个是主键
                sortName: 'machine_id',//这个是根据排序的字段
                columns: [
                    [
                        {checkbox: true},//这个对应每条数据前面的勾选框
                        {field: 'machine_id', title: __('Machine_id'),operate:false},//这里就是具体的数据，field是字段名，title是标题 如果加了operate:false该字段就不会出现在搜索条件中
                        {field: 'user_id', title: __('User_id')},
                        {field: 'machine_name', title: __('Machine_name')},
                        {field: 'type_id', title: __('Type_id')},
                        {field: 'phone', title: __('Phone')},
                        {field: 'addtime', title: __('Addtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status')},
                        {field: 'version_id', title: __('Version_id')},
                        {field: 'odds', title: __('Odds')},
                        {field: 'game_price', title: __('Game_price')},
                        {field: 'update_id', title: __('Update_id')},
                        {field: 'is_online', title: __('Is_online')},
                        {field: 'province_id', title: __('Province_id')},
                        {field: 'city_id', title: __('City_id')},
                        {field: 'district_id', title: __('District_id')},
                        {field: 'partner_id', title: __('Partner_id')},
                        {field: 'sn', title: __('Sn')},
                        {field: 'is_same_odds', title: __('Is_same_odds')},
                        {field: 'address', title: __('Address')},
                        {field: 'position_lng', title: __('Position_lng')},
                        {field: 'position_lat', title: __('Position_lat')},
                        {field: 'client_id', title: __('Client_id')},
                        {field: 'priority', title: __('Priority')},
                        {field: 'offline_game_price', title: __('Offline_game_price'), operate:'BETWEEN'},
                        {field: 'goods_price', title: __('Goods_price')},
                        {field: 'offline_goods_prices', title: __('Offline_goods_prices'), operate:'BETWEEN'},
                        {field: 'offline_odds', title: __('Offline_odds')},
                        {field: 'type_name', title: __('Type_name')},
                        {field: 'group_id', title: __('Group_id')},
                        {field: 'uuid', title: __('Uuid')},
                        {field: 'px', title: __('Px')},
                        {field: 'access_token', title: __('Access_token')},
                        {field: 'model', title: __('Model')},
                        {field: 'new_pos_lng', title: __('New_pos_lng')},
                        {field: 'new_pos_lat', title: __('New_pos_lat')},
                        {field: 'auto_update', title: __('Auto_update')},
                        {field: 'multibuy', title: __('Multibuy')},
                        {field: 'last_online', title: __('Last_online'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'last_offline', title: __('Last_offline'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'is_disable', title: __('Is_disable')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                        //这个是操作列
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