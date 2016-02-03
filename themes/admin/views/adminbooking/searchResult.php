<table class="table table-hover custom-table">
    <thead>
        <tr>
            <th>预约ID</th>
            <th>预约类型</th>
            <th>预约号</th>
            <th>患者姓名</th>
            <th>患者年龄</th>
            <th>患者所在省</th>
            <th>理想专家</th>
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