<table class="table table-hover custom-table">
    <thead>
        <tr>
            <th>预约ID</th>
            <th>预约单号</th>
            <th>患者</th>
            <th>创建人</th>
            <th>提交时间</th>
            <th>预约医生</th>
            <th>患者来源</th>
            <th>处理状态</th>
            <th>就诊方式</th>
            <th>支付编号</th>
            <th>费用类型</th>
            <th>支付金额</th>
            <th>支付状态</th>
            <th></th>
        </tr>
    </thead>

    <tbody>  
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_viewSearchResult',
        ));
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $(".pager ul>li>a").click(function (e) {
            e.preventDefault();
            var requestUrl = $(this).attr('href');
            $.ajax({
                url: requestUrl,
                async: false,
                success: function (data) {
                    $("#searchResult").html(data);
                },
                complete: function () {
                    // hide loading gif.
                }
            });
        });
    });
</script>