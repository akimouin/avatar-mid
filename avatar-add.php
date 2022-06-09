<?php include __DIR__ . './parts/connect-db.php';
$pageName = 'ab-add';
$title = '管理系統-新增部件';

?>
<?php include __DIR__ . './parts/html-head.php' ?>
<?php include __DIR__ . './parts/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        新增部件至資料庫
                    </h5>
                    <form name="form1" onsubmit="sendData();return false;">
                        <div class="mb-3">
                            <label for="" class="form-label">身體部位</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="part">
                                <option selected>---部位選擇---</option>
                                <option value="eyes">眼睛</option>
                                <option value="nose">鼻子</option>
                                <option value="mouth">嘴巴</option>
                                <option value="ear">耳朵</option>
                                <option value="hair">頭髮</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="part_id" class="form-label">檔案名稱</label>
                            <input type="text" class="form-control form-control-sm" id="part_id" placeholder="<檔案名稱>" name="part_id">
                        </div>
                        <div class="mb-3">
                            <label for="part_cost" class="form-label">價值</label>
                            <input type="text" class="form-control form-control-sm" id="part_cost" placeholder="價值" name="part_cost">
                        </div>
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . './parts/scripts.php' ?>
<?php include __DIR__ . './parts/html-foot.php' ?>