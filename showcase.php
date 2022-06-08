<?php include __DIR__ . './parts/connect-db.php' ?>
<?php include __DIR__ . './parts/html-head.php' ?>
<?php include __DIR__ . './parts/navbar.php' ?>
<div class="container">
    <div class="row" id="showcase"></div>
    <div id="showcases"></div>
</div>
<?php include __DIR__ . './parts/scripts.php' ?>
<script src="https://pixijs.download/release/pixi.js"></script>
<script>
    const showcase = document.querySelector('#showcase');
    const showcases = document.querySelector('#showcases');

    const avatar = new PIXI.Application({
        width: 200,
        height: 200
    });
    avatar.renderer.backgroundColor = 0x1f4f5f;
    showcases.appendChild(avatar.view);
    //基礎底圖
    let circle = PIXI.Sprite.from('./avatar_img/basic/circle-01.png');
    circle.anchor.set(0.2);
    circle.scale.set(0.2);
    circle.x = 30;
    circle.y = 35;
    //circle.tint = 0xdda0dd;
    avatar.stage.addChild(circle);
    let body = PIXI.Sprite.from('./avatar_img/basic/body-shadow(gray)-01.png');
    body.anchor.set(0.2);
    body.scale.set(0.2);
    body.x = 30;
    body.y = 35;
    body.zIndex = 1;
    body.tint = 0xdda0dd;
    avatar.stage.addChild(body);

    const avatarBox = (f, g, h) => {
        return `
        <div class="avatarBox col-3">
            <a href="javascript: delete_it(${g})">
            刪除
            </a>
            <p>${f}</p>
            <p>${h}</p>
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
            showcase.innerHTML += avatarBox(result[i].avatar_created_at, result[i].avatar_id, result[i].combination);
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