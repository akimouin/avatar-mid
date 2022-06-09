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
    circle.anchor.set(0.5);
    circle.scale.set(0.2);
    circle.x = 100;
    circle.y = 100;
    //circle.tint = 0xdda0dd;
    avatar.stage.addChild(circle);
    let body = PIXI.Sprite.from('./avatar_img/basic/body-shadow(gray)-01.png');
    body.anchor.set(0.5);
    body.scale.set(0.2);
    body.x = 100;
    body.y = 100;
    body.zIndex = 1;
    body.tint = 0xdda0dd;
    avatar.stage.addChild(body);

    //顏色列表
    const colors = [];
    colors[0] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700, 0xed1848];
    colors[1] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700];
    colors[2] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700];
    colors[3] = [0xdda0dd, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700];
    colors[4] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700, 0xaee0d7];

    //部位總表
    const parts = ['eyes', 'nose', 'mouth', 'ear', 'hair']

    //眼睛元件
    const eyesimgs = ["./avatar_img/eyes/0.png", "./avatar_img/eyes/1.png", "./avatar_img/eyes/2.png"]; //之後要改為由資料庫引入
    const items = [];
    items[0] = [];
    for (let i = 0; i < eyesimgs.length; i++) {
        let eye = PIXI.Sprite.from(eyesimgs[i]);
        eye.anchor.set(0.5); //錨點
        eye.scale.set(0.2); //大小
        //畫布上的位置
        eye.x = 100;
        eye.y = 100;
        eye.zIndex = 2;
        items[0].push(eye); //存入陣列中備用
    }
    avatar.stage.addChild(items[0][0]);

    //鼻子元件
    const noseimgs = ["./avatar_img/nose/0.png"]; //之後要改為由資料庫引入
    items[1] = [];
    for (let i = 0; i < noseimgs.length; i++) {
        let nose = PIXI.Sprite.from(noseimgs[i]);
        nose.anchor.set(0.5); //錨點
        nose.scale.set(0.2); //大小
        //畫布上的位置
        nose.x = 100;
        nose.y = 100;
        nose.zIndex = 2;
        items[1].push(nose); //存入陣列中備用
    }
    avatar.stage.addChild(items[1][0]);

    //嘴巴元件
    const mouthimgs = ["./avatar_img/mouth/0.png"]; //之後要改為由資料庫引入
    items[2] = [];
    for (let i = 0; i < mouthimgs.length; i++) {
        let mouth = PIXI.Sprite.from(mouthimgs[i]);
        mouth.anchor.set(0.5); //錨點
        mouth.scale.set(0.2); //大小
        //畫布上的位置
        mouth.x = 100;
        mouth.y = 100;
        mouth.zIndex = 2;
        items[2].push(mouth); //存入陣列中備用
    }
    avatar.stage.addChild(items[2][0]);

    //耳朵元件
    const earimgs = ["./avatar_img/ear/0.png"]; //之後要改為由資料庫引入
    items[3] = [];
    for (let i = 0; i < earimgs.length; i++) {
        let ear = PIXI.Sprite.from(earimgs[i]);
        ear.anchor.set(0.5); //錨點
        ear.scale.set(0.2); //大小
        //畫布上的位置
        ear.x = 100;
        ear.y = 100;
        ear.zIndex = 0;
        ear.tint = 0xdda0dd;
        items[3].push(ear); //存入陣列中備用
    }
    avatar.stage.addChild(items[3][0]);

    //頭髮元件
    const hairimgs = ["./avatar_img/hair/0.png"]; //之後要改為由資料庫引入
    items[4] = [];
    for (let i = 0; i < hairimgs.length; i++) {
        let hair = PIXI.Sprite.from(hairimgs[i]);
        hair.anchor.set(0.5); //錨點
        hair.scale.set(0.2); //大小
        //畫布上的位置
        hair.x = 100;
        hair.y = 100;
        hair.zIndex = 2;
        items[4].push(hair); //存入陣列中備用
    }
    avatar.stage.addChild(items[4][0]);

    //調整圖層的前後順序
    avatar.stage.sortChildren();

    const avatarBox = (f, g, h) => {
        return `
        <div class="avatarBox col-3">
            <a href="javascript: delete_it(${g})">
            刪除
            </a>
            <a href="javascript: edit_it(${g})">
            修改
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
            location.href = `./order-delete-api.php?sid=${sid}`;
        }
    }
    function edit_it(sid) {
        location.href = `./avatar.php?avatarid=${sid}`;
    }
    getData();
</script>
<?php include __DIR__ . './parts/html-foot.php' ?>