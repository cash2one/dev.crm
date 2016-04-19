<style>
    @media (min-width: 1200px){#showImgModal .modal-dialog{width: 1200px;}}
</style>
<div class="modal" id="showImgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">查看图片</h4>
            </div>
            <div class="modal-body">
                <img src="">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
        $('#showImgModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var dataSrc = button.data('src');
            var modal = $(this);
            modal.find('.modal-body img').attr('src', dataSrc);
        });
    });
</script>