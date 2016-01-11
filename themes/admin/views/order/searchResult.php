<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>订单号</th>
            <th>Ping++ ID</th>
            <th>支付时间</th>
            <th>订单标题</th>
            <th>地推</th>
            <th>支付金额</th>
            <th>支付状态</th>
            <th>预约类型</th>
            <th>预约信息</th>
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