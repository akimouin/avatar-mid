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


    //鼻子元件
    const noseimgs = ["./avatar_img/nose/0.png"]; //之後要改為由資料庫引入


    //嘴巴元件
    const mouthimgs = ["./avatar_img/mouth/0.png"]; //之後要改為由資料庫引入


    //耳朵元件
    const earimgs = ["./avatar_img/ear/0.png"]; //之後要改為由資料庫引入


    //頭髮元件
    const hairimgs = ["./avatar_img/hair/0.png"]; //之後要改為由資料庫引入




    const avatarBox = (f, g) => {
        return `
        <div class="avatarBox col-3">
            <a href="javascript: edit_it(${g})" class="btn btn-info">
            修改
            </a>
            <a href="javascript: delete_it(${g})" class="btn btn-danger">
            刪除
            </a>
            <p>${g}</p>
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
        for (i = 0; i < 5; i++) {
            showcase.innerHTML += avatarBox(result[i].avatar_created_at, result[i].avatar_id);
        }
        for (i = 0; i < 5; i++) {
            const a = JSON.parse(result[i]['combination']);
            console.log(a);
            const avatarBoxes = document.querySelectorAll('.avatarBox');
            const avatar = new PIXI.Application({
                width: 200,
                height: 200
            });
            avatar.renderer.backgroundColor = 0x1f4f5f;
            avatarBoxes[i].appendChild(avatar.view);
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

            let eye = PIXI.Sprite.from(eyesimgs[a[parts[0]]]);
            eye.anchor.set(0.5); //錨點
            eye.scale.set(0.2); //大小
            //畫布上的位置
            eye.x = 100;
            eye.y = 100;
            eye.zIndex = 2;
            eye.tint = colors[0][a[parts[0] + "Color"]];
            //items[0].push(eye); //存入陣列中備用

            avatar.stage.addChild(eye);

            // items[1] = [];
            // for (let i = 0; i < noseimgs.length; i++) {
            let nose = PIXI.Sprite.from(noseimgs[a[parts[1]]]);
            nose.anchor.set(0.5); //錨點
            nose.scale.set(0.2); //大小
            //畫布上的位置
            nose.x = 100;
            nose.y = 100;
            nose.zIndex = 2;
            nose.tint = colors[1][a[parts[1] + "Color"]];
            //     items[1].push(nose); //存入陣列中備用
            // }
            avatar.stage.addChild(nose);

            // items[2] = [];
            // for (let i = 0; i < mouthimgs.length; i++) {
            let mouth = PIXI.Sprite.from(mouthimgs[a[parts[2]]]);
            mouth.anchor.set(0.5); //錨點
            mouth.scale.set(0.2); //大小
            //畫布上的位置
            mouth.x = 100;
            mouth.y = 100;
            mouth.zIndex = 2;
            mouth.tint = colors[2][a[parts[2] + "Color"]];
            //     items[2].push(mouth); //存入陣列中備用
            // }
            avatar.stage.addChild(mouth);

            // items[3] = [];
            // for (let i = 0; i < earimgs.length; i++) {
            let ear = PIXI.Sprite.from(earimgs[a[parts[3]]]);
            ear.anchor.set(0.5); //錨點
            ear.scale.set(0.2); //大小
            //畫布上的位置
            ear.x = 100;
            ear.y = 100;
            ear.zIndex = 0;
            ear.tint = colors[3][a[parts[3] + "Color"]];
            //     items[3].push(ear); //存入陣列中備用
            // }
            avatar.stage.addChild(ear);

            // items[4] = [];
            // for (let i = 0; i < hairimgs.length; i++) {
            let hair = PIXI.Sprite.from(hairimgs[a[parts[4]]]);
            hair.anchor.set(0.5); //錨點
            hair.scale.set(0.2); //大小
            //畫布上的位置
            hair.x = 100;
            hair.y = 100;
            hair.zIndex = 2;
            hair.tint = colors[4][a[parts[4] + "Color"]];
            //     items[4].push(hair); //存入陣列中備用
            // }
            avatar.stage.addChild(hair);

            //調整圖層的前後順序
            avatar.stage.sortChildren();
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