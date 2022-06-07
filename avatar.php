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
            <form action="" name="form1" id="form1" onsubmit="sendData(); return false;" style="display: none;">
                <div class="mb-3">
                    <label for="" class="form-label">眼睛</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="eye" value="0" checked>
                        <label class="form-check-label" for="eye0">eye0
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="eyeColor" value="0" checked>
                        <label class="form-check-label" for="c0">c0
                        </label>
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
    body.tint = 0xdda0dd;
    avatar.stage.addChild(body);

    //顏色列表
    const colors = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f];
    

    // async function getData() {
    //     const r = await fetch('sqldata.api.php', {
    //         method: 'POST',
    //         //body: fd,
    //     });
    //     const result = await r.json();
    //     console.log(result);
    // }
    // getData();


    //眼睛元件
    const eyesimgs = ["./avatar_img/eyes/0.png", "./avatar_img/eyes/1.png", "./avatar_img/eyes/2.png"]; //之後要改為由資料庫引入
    const eyesitems = [];
    for (let i = 0; i < eyesimgs.length; i++) {
        let eye = PIXI.Sprite.from(eyesimgs[i]);
        eye.anchor.set(0.5); //錨點
        eye.scale.set(0.5); //大小
        //畫布上的位置
        eye.x = 240;
        eye.y = 250;

        eyesitems.push(eye); //存入陣列中備用
    }
    avatar.stage.addChild(eyesitems[0]);

    //耳朵元件
    const earimgs = ["./avatar_img/ear/0.png"]; //之後要改為由資料庫引入
    const earitems = [];
    for (let i = 0; i < earimgs.length; i++) {
        let ear = PIXI.Sprite.from(earimgs[i]);
        ear.anchor.set(0.5); //錨點
        ear.scale.set(0.5); //大小
        //畫布上的位置
        ear.x = 240;
        ear.y = 250;
        earitems.push(ear); //存入陣列中備用
    }
    avatar.stage.addChild(earitems[0]);


    const form1 = document.querySelector('#form1');
    const eyesbox = document.querySelector("#eyesbox");
    for (let x = 0; x < eyesimgs.length; x++) {
        const a = document.createElement("input");
        a.type = "radio";
        a.name = "eye";
        a.id = "eye" + x;
        a.value = x;
        form1.appendChild(a);
        const eyebtn = document.createElement("button");
        eyebtn.className = "eyebtn";
        eyebtn.innerText = "eye" + x;
        eyebtn.addEventListener(
            "click",
            function() {
                svgChange(x);
            },
            false
        );
        eyebtn.addEventListener(
            "click",
            function() {
                colorEvent(x);
            },
            false
        );
        eyebtn.addEventListener(
            "click",
            function() {
                const chose = document.querySelector("#eye" + x);
                chose.click();
            },
            false
        );
        eyebtn.addEventListener(
            "click",
            function() {
                const chose = document.querySelector("#colorbtn0");
                chose.click();
            },
            false
        );
        eyesbox.appendChild(eyebtn);
    }
    //在畫面中製作顏色的按鈕
    //問題:發現會出現顏色不連動的BUG 還要再修改; 已解決
    for (let i = 0; i < colors.length; i++) {
        const a = document.createElement("input");
        a.type = "radio";
        a.name = "eyeColor";
        a.id = "ec" + i;
        a.value = i;
        form1.appendChild(a);
        const colorbtn = document.createElement("button");
        colorbtn.className = "colorbtn";
        colorbtn.id = "colorbtn" + i;
        colorbtn.innerText = colors[i].toString(16);
        colorbtn.style.backgroundColor = "#" + colors[i].toString(16);
        colorbtn.addEventListener(
            "click",
            function() {
                colorchange(0, i);
            },
            false
        );
        colorbtn.addEventListener(
            "click",
            function() {
                const chose = document.querySelector("#ec" + i);
                chose.click();
            },
            false
        );
        eyesbox.appendChild(colorbtn);
    }

    //變更圖片
    const svgChange = (a) => {
        for (let i = 0; i < eyesimgs.length; i++) {
            avatar.stage.removeChild(eyesitems[i]);
        }
        avatar.stage.addChild(eyesitems[a]);
    };
    //變更顏色
    const colorchange = (a, b) => {
        eyesitems[a].tint = colors[b];
    };

    //撈取所有顏色按鈕
    const colorbtns = document.querySelectorAll(".colorbtn");

    //為顏色按鈕加上function
    const colorEvent = (x) => {
        for (let c = 0; c < colors.length; c++) {
            for (let i = 0; i < eyesimgs.length; i++) {
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