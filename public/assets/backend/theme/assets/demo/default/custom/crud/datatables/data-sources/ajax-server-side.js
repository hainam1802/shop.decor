var DatatablesDataSourceAjaxServer = {
    init: function () {
        $("#m_table_1").DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            searchDelay: 1000,
            ajax: '/admin/article',
            "order": [[ 0, "desc" ]],
            columns: [
                { data: 'id',title:'ID', "orderSequence": ["desc", "asc"] },
                { data: 'title',title:'Tiêu đề' },
                { data: 'content',title:'Nội dung' },
                { data: 'created_at',title:'Ngày tạo',
                    render: function (row) {
                        return moment(row).format('DD/MM/YYYY HH:mm:ss');
                    }
                },
                { data: 'status',title:'Trạng thái',
                    render: function (row) {
                        if(row==1){
                            return "<span class=\"m-badge  m-badge--success m-badge--wide\">Hoạt động</span>";
                        }else{
                            return "<span class=\"m-badge  m-badge--danger m-badge--wide\">Không hoạt động</span>";
                        }



                    }
                },
                { data: 'action',title:'Thao tác', orderable: false, searchable: false,}
            ],
        })
    }
};
jQuery(document).ready(function () {
    DatatablesDataSourceAjaxServer.init()
});