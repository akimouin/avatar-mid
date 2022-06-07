<?php include __DIR__ . './parts/connect-db.php' ?>
<?php include __DIR__ . './parts/html-head.php' ?>
<?php include __DIR__ . './parts/navbar.php' ?>
<div class="container border">
    <div class="row border">
        <div class="pictureFrame col-12 col-lg-6 border d-flex justify-content-center align-items-center" id="pictureFrame"></div>
        <div class="controlArea col-12 col-lg-6 border" id="controlArea">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="eye-tab" data-bs-toggle="tab" data-bs-target="#eyesbox" type="button" role="tab" aria-controls="eyesbox" aria-selected="true">Eye</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nose-tab" data-bs-toggle="tab" data-bs-target="#nosebox" type="button" role="tab" aria-controls="nosebox" aria-selected="false">nose</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mouth-tab" data-bs-toggle="tab" data-bs-target="#mouthbox" type="button" role="tab" aria-controls="mouthbox" aria-selected="false">mouth</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ear-tab" data-bs-toggle="tab" data-bs-target="#earbox" type="button" role="tab" aria-controls="earbox" aria-selected="false">ear</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hair-tab" data-bs-toggle="tab" data-bs-target="#hairbox" type="button" role="tab" aria-controls="hairbox" aria-selected="false">hair</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="eyesbox" role="tabpanel" aria-labelledby="eye-tab">
                    eyes
                </div>
                <div class="tab-pane fade" id="nosebox" role="tabpanel" aria-labelledby="nose-tab">
                    nose
                </div>
                <div class="tab-pane fade" id="mouthbox" role="tabpanel" aria-labelledby="mouth-tab">mouth
                </div>
                <div class="tab-pane fade" id="earbox" role="tabpanel" aria-labelledby="ear-tab">ear
                </div>
                <div class="tab-pane fade" id="hairbox" role="tabpanel" aria-labelledby="hair-tab">hair
                </div>
            </div>
            <form action="" name="form1" id="form1" onsubmit="sendData(); return false;">
                <div class="mb-3">
                    <label for="" class="form-label">眼睛</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="eyes" value="0" checked>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="eyesColor" value="0" checked>
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" id="edit" class="btn btn-primary">Edit</button>
            </form>
            <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                資料新增成功
            </div>
        </div>
        <div class="col-12 col-lg-6"></div>
        <div class="col-12 col-lg-6">
            <button class="btn btn-primary" id="submitClick">保存形象</button>
        </div>
    </div>
</div>
<?php include __DIR__ . './parts/scripts.php' ?>
<script src="https://pixijs.download/release/pixi.js"></script>
<script>
    //畫布定義
    const pictureFrame = document.querySelector("#pictureFrame");
    let avatar = new PIXI.Application({
        width: 480,
        height: 500
    });
    avatar.renderer.backgroundColor = 0x2f4f4f;
    pictureFrame.appendChild(avatar.view);
    //基礎底圖
    let circle = PIXI.Sprite.from('./avatar_img/basic/circle-01.png');
    circle.anchor.set(0.5);
    circle.scale.set(0.5);
    circle.x = 240;
    circle.y = 250;
    //circle.tint = 0xdda0dd;
    avatar.stage.addChild(circle);
    let body = PIXI.Sprite.from('./avatar_img/basic/body-shadow(gray)-01.png');
    body.anchor.set(0.5);
    body.scale.set(0.5);
    body.x = 240;
    body.y = 250;
    body.zIndex = 1;
    body.tint = 0xdda0dd;
    avatar.stage.addChild(body);

    //顏色列表
    const colors = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f];

    //部位總表
    const parts = ['eyes', 'ear', 'hair', 'mouth', 'nose']

    //眼睛元件
    const eyesimgs = ["./avatar_img/eyes/0.png", "./avatar_img/eyes/1.png", "./avatar_img/eyes/2.png"]; //之後要改為由資料庫引入
    const items = [];
    items[0] = [];
    for (let i = 0; i < eyesimgs.length; i++) {
        let eye = PIXI.Sprite.from(eyesimgs[i]);
        eye.anchor.set(0.5); //錨點
        eye.scale.set(0.5); //大小
        //畫布上的位置
        eye.x = 240;
        eye.y = 250;
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
        nose.scale.set(0.5); //大小
        //畫布上的位置
        nose.x = 240;
        nose.y = 250;
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
        mouth.scale.set(0.5); //大小
        //畫布上的位置
        mouth.x = 240;
        mouth.y = 250;
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
        ear.scale.set(0.5); //大小
        //畫布上的位置
        ear.x = 240;
        ear.y = 250;
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
        hair.scale.set(0.5); //大小
        //畫布上的位置
        hair.x = 240;
        hair.y = 250;
        hair.zIndex = 2;
        items[4].push(hair); //存入陣列中備用
    }
    avatar.stage.addChild(items[4][0]);
    
    //調整圖層的前後順序
    avatar.stage.sortChildren();


    const form1 = document.querySelector('#form1');
    const eyesbox = document.querySelector("#eyesbox");
    for (let x = 0; x < items[0].length; x++) {
        const a = document.createElement("input");
        a.type = "radio";
        a.name = parts[0];
        a.id = parts[0] + x;
        a.value = x;
        form1.appendChild(a);
        const b = document.createElement("button");
        b.className = parts[0] + "btn";
        b.innerText = parts[0] + x;
        b.addEventListener(
            "click",
            function() {
                svgChange(x);
            },
            false
        );
        b.addEventListener(
            "click",
            function() {
                colorEvent(x);
            },
            false
        );
        b.addEventListener(
            "click",
            function() {
                const chose = document.querySelector("#" + parts[0] + x);
                chose.click();
            },
            false
        );
        b.addEventListener(
            "click",
            function() {
                const chose = document.querySelector("#colorbtn0");
                chose.click();
            },
            false
        );
        eyesbox.appendChild(b);
    }
    //在畫面中製作顏色的按鈕
    //問題:發現會出現顏色不連動的BUG 還要再修改; 已解決
    for (let i = 0; i < colors.length; i++) {
        const a = document.createElement("input");
        a.type = "radio";
        a.name = parts[0] + "Color";
        a.id = parts[0] + "Color" + i;
        a.value = i;
        form1.appendChild(a);
        const b = document.createElement("button");
        b.className = "colorbtn";
        b.id = "colorbtn" + i;
        b.innerText = colors[i].toString(16);
        b.style.backgroundColor = "#" + colors[i].toString(16);
        b.addEventListener(
            "click",
            function() {
                colorchange(0, i);
            },
            false
        );
        b.addEventListener(
            "click",
            function() {
                const chose = document.querySelector("#"+parts[0] + "Color" + i);
                chose.click();
            },
            false
        );
        eyesbox.appendChild(b);
    }

    //變更圖片
    const svgChange = (a) => {
        for (let i = 0; i < items[0].length; i++) {
            avatar.stage.removeChild(items[0][i]);
        }
        avatar.stage.addChild(items[0][a]);
    };
    //變更顏色
    const colorchange = (a, b) => {
        items[0][a].tint = colors[b];
    };

    //撈取所有顏色按鈕
    const colorbtns = document.querySelectorAll(".colorbtn");

    //為顏色按鈕加上function
    const colorEvent = (x) => {
        for (let c = 0; c < colors.length; c++) {
            for (let i = 0; i < items[0].length; i++) {
                colorbtns[c].removeEventListener(
                    "click",
                    function() {
                        colorchange(i, c);
                    },
                    false
                );
            }
            colorbtns[c].addEventListener(
                "click",
                function() {
                    colorchange(x, c);
                },
                false
            );
        }
    };

    const submitClick = document.querySelector('#submitClick');
    submitClick.addEventListener("click", function() {
        const submit = document.querySelector("#submit");
        submit.click();
    })
    async function sendData() {
        const fd = new FormData(document.form1);
        const r = await fetch('order-add-api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
    }
</script>

<?php include __DIR__ . './parts/html-foot.php' ?>