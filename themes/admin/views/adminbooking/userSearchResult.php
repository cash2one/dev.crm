<table class="table table-hover custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>手机</th>
            <th>医院</th>
            <th>科室</th>
            <th>临床职称</th>
            <th>学术职称</th>
            <th></th>
        </tr>
    </thead>

    <tbody>  
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_viewUserSearchDoctors',
        ));
        ?>
    </tbody>
</table>


<script>
    $(document).ready(function () {
        $('.relateDoctor').click(function (e) {
            e.preventDefault();
            if (confirm("确定关联这个医生吗？")) {
                var url = $(this).attr('href');
                window.location.href = url;
            }
        });
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