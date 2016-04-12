<table class="table table-hover custom-table">
    <thead>
        <tr>
            <th>标题</th>
            <th style="width: 30%;">内容</th>
            <th>任务类型</th>
            <th>跟单方式</th>
            <th>阅读情况</th>
            <th>完成情况</th>
            <th>计划跟单时间</th>
            <th>跟单完成时间</th>
            <th style="width: 8%;">操作</th>
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
<style>
    .custom-table>thead>tr>th{min-width: 5.7em;}
</style>
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
        //完成跟单任务
        $('.ajaxCompletedTask').click(function (e) {
            e.preventDefault();
            var requestUrl = $(this).attr('href');
            if (confirm('确认完成这个任务?')){
                $.ajax({
                    url: requestUrl,
                    async: false,
                    success: function (data) {
                        if (data.status == 'ok') {
                            location.reload();
                        } else {
                            alert('操作失败!');
                        }
                    },
                    complete: function () {
                        // hide loading gif.
                    }
                });
            }
        });
    });
</script>