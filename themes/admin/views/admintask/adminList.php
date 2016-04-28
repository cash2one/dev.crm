<?php
if (is_null($data)) {
    echo '没有权限!';
} else {
    ?>
    <h1>客服任务信息</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>客服姓名</th>
                <th>客服手机</th>
                <th>已完成</th>
                <th>已读未完成</th>
                <th>未读未完成</th>
                <th>总任务数</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $results = $data->results;
            foreach ($results as $adminUser) {
                ?>
                <tr>
                    <td><?php echo $adminUser->adminUserName; ?></td>
                    <td><?php echo $adminUser->mobile; ?></td>
                    <td><?php echo $adminUser->taskIsDone; ?></td>
                    <td class="color-red"><?php echo $adminUser->taskIsReadNotDone; ?></td>
                    <td class="strong"><?php echo $adminUser->taskNotDone; ?></td>
                    <td><?php echo $adminUser->taskCount; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}