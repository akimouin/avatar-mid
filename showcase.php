<?php include __DIR__ . './parts/connect-db.php' ?>
<?php include __DIR__ . './parts/html-head.php' ?>
<?php include __DIR__ . './parts/navbar.php' ?>
<div class="container">
    <div class="row" id="showcase"></div>
</div>
<?php include __DIR__ . './parts/scripts.php' ?>
<script>
    const showcase = document.querySelector('#showcase');
    const avatarBox = (f, g) => {
        return `
        <div class="avatarBox col-3">
            <a href="javascript: delete_it(${g})">
            刪除
            </a>
            <p>${f}</p>
        </div>`;
    };
    async function getData() {
        const r = await fetch('getshowcase-api.php', {
            method: 'POST',
            //body: fd,
        });
        const result = await r.json();
        console.log(result);
        for (i = 0; i < result.length; i++) {
            showcase.innerHTML += avatarBox(result[i].avatar_created_at, result[i].avatar_id);
        }


    }

    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `order-delete-api.php?sid=${sid}`;
        }
    }
    getData();
</script>
<?php include __DIR__ . './parts/html-foot.php' ?>