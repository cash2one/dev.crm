<h1>任务搜索</h1>

<?php
$urlSearch = $this->createUrl('admintask/searchResult');
$urlUserView = $this->createAbsoluteUrl('adminTask/view');
?>

<div class="row form" id="searchForm">
    <div class="form-group col-sm-2">
        <label >标题</label>
        <div>
            <input class="form-control" name = 'subject' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >内容</label>
        <div>
            <input class="form-control" name = 'content' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >任务类型</label>
        <div>
            <select name = 'type' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>预约</option>
                <option value = '2'>医生用户</option>
                <option value = '3'>订单</option>
                <option value = '4'>追单</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >完成情况</label>
        <div>
            <select name = 'status' class="form-control">
                <option value = ''>全部</option>
                <option value = '0'>未完成</option>
                <option value = '1'>已完成</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >阅读情况</label>
        <div>
            <select name = 'is_read' class="form-control">
                <option value = ''>全部</option>
                <option value = '0'>未阅读</option>
                <option value = '1'>已阅读</option>
            </select>
        </div>
    </div>

    <div class="form-group col-sm-2">
        <label >计划跟单时间</label>
        <div>
            <input class="form-control" name = 'date_plan' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >跟单完成时间</label>
        <div>
            <input class="form-control" name = 'date_done' value = '' >
        </div>
    </div>

    <div class="form-group col-sm-2 mt25">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div> 
    <div class="clearfix"></div>
</div>

<div id="searchResult">   
</div>


<script>
    $(document).ready(function () {
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";
        loadUserSearchResult(requestUrl, selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?first=1';
            domForm.find("input,select").each(function () {
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                }
            });
            loadUserSearchResult(searchUrl, selectorSearchResult);
        });

    });
    function loadUserSearchResult(requestUrl, selectorSearchResult) {
        $.ajax({
            url: requestUrl,
            async: false,
            success: function (data) {
                $(selectorSearchResult).html(data);
            },
            complete: function () {
                // hide loading gif.
            }
        });
    }

</script>

