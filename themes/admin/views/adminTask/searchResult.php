<table class="table table-hover custom-table">
    <thead>
        <tr>
            <th>标题</th>
            <th>内容</th>
            <th>任务类型</th>
            <th>跟单方式</th>
            <th>阅读情况</th>
            <th>完成情况</th>
            <th>计划跟单时间</th>
            <th>跟单完成时间</th>
            <th>跟单详情</th>
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