<div class="result-content">
    <table class="table table-hover custom-table">
        <thead>
            <tr>
                <th>预约号</th>
                <th>患者姓名</th>
                <th>患者手机</th>
                <th>疾病诊断</th>
                <th>创建日期</th>
                <th>工作进度</th>
                <th>业务员</th>
                <th>客户来源</th>
                <th>授权KA/地推</th>
                <th>费用类型</th>
                <th>支付状态</th>
                <th>患者目的</th>
                <th>手术日期</th>
                <th>推送医生姓名</th>
                <th>推送医生电话</th>
                <th>患者满意度</th>
                <th>理想专家</th>
                <th>理想医院</th>
                <th>理想专家电话</th>
                <th>导流来源</th>
                <th>预约类型</th>
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
</div>
<style>
    .table td,.table th{min-width: 10%;}
    #searchResult{overflow-x: scroll;}
    #searchResult>.result-content{width: 150%;}
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
    });
</script>