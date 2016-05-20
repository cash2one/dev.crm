<?php
$adminBookings = $data->results;
$pageItem = $data->pageItem;
$dataNum = $data->dataNum;
$pageCount = floor($dataNum / 20);
if ($dataNum % 20 != 0) {
    $pageCount++;
}
$prePage = $pageItem - 1 < 1 ? 1 : $pageItem - 1;
$nextPage = $pageItem + 1 > $pageCount ? $pageCount : $pageItem + 1;
$urlSearchPage = $this->createUrl('adminbooking/searchResult');
?>
<div id="yw0" class="list-view">
    <div class="summary">
        <?php
        $starDataNum = 20 * ($pageItem - 1) + 1;
        $endDataNum = 20 * $pageItem > $dataNum ? $dataNum : 20 * $pageItem;
        echo '第 ' . $starDataNum . '-' . $endDataNum . ' 条, 共 ' . $dataNum . ' 条.';
        ?>
    </div>
    <div class="items"></div>
</div>
<?php if ($pageCount > 1): ?>
    <div class="pager">翻页: <ul id="yw1" class="yiiPager">
            <?php
            if ($pageItem != 1) {
                echo '<li class="first"><a href="' . $urlSearchPage . '?getcount=1&page=1">&lt;&lt; 首页</a></li>';
                echo '<li class="previous"><a href="' . $urlSearchPage . '?getcount=1&page=' . $prePage . '">&lt; 前页</a></li>';
            }
            for ($i = 1; $i <= $pageCount; $i++) {
                if ($i == $pageItem) {
                    echo '<li class="page selected"><a href="' . $urlSearchPage . '?getcount=1&page=' . $i . '">' . $i . '</a></li>';
                } else {
                    echo '<li class="page"><a href="' . $urlSearchPage . '?getcount=1&page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($pageItem != $pageCount) {
                echo '<li class="next"><a href="' . $urlSearchPage . '?getcount=1&page=' . $nextPage . '">后页 &gt;</a></li>';
                echo '<li class="last"><a href="' . $urlSearchPage . '?getcount=1&page=' . $pageCount . '">末页 &gt;&gt;</a></li>';
            }
            ?>
        </ul>
    </div>
<?php endif; ?>
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
//            $this->widget('zii.widgets.CListView', array(
//                'dataProvider' => $dataProvider,
//                'itemView' => '_viewSearchResult',
//            ));
            $this->renderPartial('_viewSearchResult', array('adminBookings' => $adminBookings));
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
            var domForm = $("#searchForm");
            var requestUrl = $(this).attr('href');
            domForm.find("input,select").each(function () {
                var searchUrl = '';
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                }
                requestUrl += searchUrl;
            });
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