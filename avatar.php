<?php include __DIR__ . './parts/connect_db.php' ?>
<?php include __DIR__ . './parts/html-head.php' ?>
<style>
    body {
        background-color: #2f4f4f;
    }

    .boxes button {
        width: 50px;
        height: 50px;
        border-radius: 10%;
        border: none;
        margin-right: 10px;
    }
</style>
<?php include __DIR__ . './parts/navbar.php' ?>
<div class="container border-top mt-5">
    <div class="row">
        <div class="pictureFrame col-12 col-lg-7 d-flex justify-content-center align-items-center border" id="pictureFrame"></div>
        <div class="controlArea col-12 col-lg-5 border" id="controlArea">
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
                <div class="tab-pane fade show active boxes" id="eyesbox" role="tabpanel" aria-labelledby="eye-tab">
                </div>
                <div class="tab-pane fade boxes" id="nosebox" role="tabpanel" aria-labelledby="nose-tab">
                </div>
                <div class="tab-pane fade boxes" id="mouthbox" role="tabpanel" aria-labelledby="mouth-tab">
                </div>
                <div class="tab-pane fade boxes" id="earbox" role="tabpanel" aria-labelledby="ear-tab">
                </div>
                <div class="tab-pane fade boxes" id="hairbox" role="tabpanel" aria-labelledby="hair-tab">
                </div>
            </div>
            <form action="" name="form1" id="form1" onsubmit="sendData(); return false;" style="display:none;">
                <div class="mb-3">
                    <label for="" class="form-label">??????</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="eyes" value="0" checked>
                        <input class="form-check-input" type="radio" name="nose" value="0" checked>
                        <input class="form-check-input" type="radio" name="mouth" value="0" checked>
                        <input class="form-check-input" type="radio" name="ear" value="0" checked>
                        <input class="form-check-input" type="radio" name="hair" value="0" checked>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="eyesColor" value="0" checked>
                        <input class="form-check-input" type="radio" name="noseColor" value="0" checked>
                        <input class="form-check-input" type="radio" name="mouthColor" value="0" checked>
                        <input class="form-check-input" type="radio" name="earColor" value="0" checked>
                        <input class="form-check-input" type="radio" name="hairColor" value="0" checked>
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" id="edit" class="btn btn-primary">Edit</button>
            </form>
            <form action="" name="form2" id="form2" onsubmit="return false;" style="display:none;">
                <div class="mb-3">
                    <label for="avatarID" class="form-label">avatarID</label>
                    <input type="text" class="form-control" id="avatarID" name="avatarID">
                </div>
            </form>
            <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                ??????????????????
            </div>
        </div>
        <div class="col-12 col-lg-7"></div>
        <div class="col-12 col-lg-5">
            <button class="btn btn-success" id="submitClick">????????????</button>
            <a href="./avatar-showcase.php" class="btn btn-info">????????????</a>
        </div>
    </div>
</div>

<?php include __DIR__ . './parts/scripts.php' ?>
<script src="https://pixijs.download/release/pixi.js"></script>
<script>
    //????????????
    const pictureFrame = document.querySelector("#pictureFrame");
    let avatar = new PIXI.Application({
        width: 500,
        height: 500
    });
    avatar.renderer.backgroundColor = 0x2f4f4f;
    pictureFrame.appendChild(avatar.view);
    //????????????
    let circle = PIXI.Sprite.from('./img/avatar_img/basic/circle-01.png');
    circle.anchor.set(0.5);
    circle.scale.set(0.5);
    circle.x = 240;
    circle.y = 250;
    //circle.tint = 0xdda0dd;
    avatar.stage.addChild(circle);
    let body = PIXI.Sprite.from('./img/avatar_img/basic/body-shadow(gray)-01.png');
    body.anchor.set(0.5);
    body.scale.set(0.5);
    body.x = 240;
    body.y = 250;
    body.zIndex = 1;
    body.tint = 0xdda0dd;
    avatar.stage.addChild(body);

    //????????????
    const colors = [];
    colors[0] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700, 0xed1848];
    colors[1] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700];
    colors[2] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700];
    colors[3] = [0xdda0dd, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700];
    colors[4] = [0xffffff, 0xffcccc, 0xccffcc, 0xccccff, 0x8fbc8f, 0xffd700, 0xaee0d7];

    //????????????
    const parts = ['eyes', 'nose', 'mouth', 'ear', 'hair']

    //????????????
    const eyesimgs = ["./img/avatar_img/eyes/0.png", "./img/avatar_img/eyes/1.png", "./img/avatar_img/eyes/2.png", "./img/avatar_img/eyes/3.png"]; //?????????????????????????????????
    const items = [];
    items[0] = [];
    for (let i = 0; i < eyesimgs.length; i++) {
        let eye = PIXI.Sprite.from(eyesimgs[i]);
        eye.anchor.set(0.5); //??????
        eye.scale.set(0.5); //??????
        //??????????????????
        eye.x = 240;
        eye.y = 250;
        eye.zIndex = 2;
        items[0].push(eye); //?????????????????????
    }
    avatar.stage.addChild(items[0][0]);

    //????????????
    const noseimgs = ["./img/avatar_img/nose/0.png"]; //?????????????????????????????????
    items[1] = [];
    for (let i = 0; i < noseimgs.length; i++) {
        let nose = PIXI.Sprite.from(noseimgs[i]);
        nose.anchor.set(0.5); //??????
        nose.scale.set(0.5); //??????
        //??????????????????
        nose.x = 240;
        nose.y = 250;
        nose.zIndex = 2;
        items[1].push(nose); //?????????????????????
    }
    avatar.stage.addChild(items[1][0]);

    //????????????
    const mouthimgs = ["./img/avatar_img/mouth/0.png"]; //?????????????????????????????????
    items[2] = [];
    for (let i = 0; i < mouthimgs.length; i++) {
        let mouth = PIXI.Sprite.from(mouthimgs[i]);
        mouth.anchor.set(0.5); //??????
        mouth.scale.set(0.5); //??????
        //??????????????????
        mouth.x = 240;
        mouth.y = 250;
        mouth.zIndex = 2;
        items[2].push(mouth); //?????????????????????
    }
    avatar.stage.addChild(items[2][0]);

    //????????????
    const earimgs = ["./img/avatar_img/ear/0.png", "./img/avatar_img/ear/1.png", "./img/avatar_img/ear/2.png"]; //?????????????????????????????????
    items[3] = [];
    for (let i = 0; i < earimgs.length; i++) {
        let ear = PIXI.Sprite.from(earimgs[i]);
        ear.anchor.set(0.5); //??????
        ear.scale.set(0.5); //??????
        //??????????????????
        ear.x = 240;
        ear.y = 250;
        ear.zIndex = 0;
        ear.tint = 0xdda0dd;
        items[3].push(ear); //?????????????????????
    }
    avatar.stage.addChild(items[3][0]);

    //????????????
    const hairimgs = ["./img/avatar_img/hair/0.png", "./img/avatar_img/hair/1.png", "./img/avatar_img/hair/2.png"]; //?????????????????????????????????
    items[4] = [];
    for (let i = 0; i < hairimgs.length; i++) {
        let hair = PIXI.Sprite.from(hairimgs[i]);
        hair.anchor.set(0.5); //??????
        hair.scale.set(0.5); //??????
        //??????????????????
        hair.x = 240;
        hair.y = 250;
        hair.zIndex = 2;
        items[4].push(hair); //?????????????????????
    }
    avatar.stage.addChild(items[4][0]);

    //???????????????????????????
    avatar.stage.sortChildren();


    const form1 = document.querySelector('#form1');
    const boxes = document.querySelectorAll('.boxes');
    for (let f = 0; f < parts.length; f++) {
        for (let x = 0; x < items[f].length; x++) {
            const a = document.createElement("input");
            a.type = "radio";
            a.name = parts[f];
            a.id = parts[f] + x;
            a.value = x;
            form1.appendChild(a);
            const b = document.createElement("button");
            b.className = parts[f] + "btn";
            b.innerText = x;
            b.addEventListener(
                "click",
                function() {
                    svgChange(x, f);
                },
                false
            );
            b.addEventListener(
                "click",
                function() {
                    colorEvent(x, f);
                },
                false
            );
            b.addEventListener(
                "click",
                function() {
                    const chose = document.querySelector("#" + parts[f] + x);
                    chose.click();
                },
                false
            );
            b.addEventListener(
                "click",
                function() {
                    const chose = document.querySelector("#" + parts[f] + "colorbtn0");
                    chose.click();
                },
                false
            );
            b.addEventListener(
                "click",
                function() {
                    avatar.stage.sortChildren();
                }, false
            );
            boxes[f].appendChild(b);
        }

        //?????????????????????????????????
        //??????:?????????????????????????????????BUG ???????????????; ?????????
        for (let i = 0; i < colors[f].length; i++) {
            const a = document.createElement("input");
            a.type = "radio";
            a.name = parts[f] + "Color";
            a.id = parts[f] + "Color" + i;
            a.value = i;
            form1.appendChild(a);
            const b = document.createElement("button");
            b.className = parts[f] + "colorbtn";
            b.id = parts[f] + "colorbtn" + i;
            b.innerText = "c" + i;
            b.style.backgroundColor = "#" + colors[f][i].toString(16);
            b.addEventListener(
                "click",
                function() {
                    colorchange(0, i, f);
                },
                false
            );
            b.addEventListener(
                "click",
                function() {
                    const chose = document.querySelector("#" + parts[f] + "Color" + i);
                    chose.click();
                },
                false
            );
            boxes[f].appendChild(b);
        }
    }

    //????????????
    const svgChange = (a, f) => {
        for (let i = 0; i < items[f].length; i++) {
            avatar.stage.removeChild(items[f][i]);
        }
        avatar.stage.addChild(items[f][a]);
    };
    //????????????
    const colorchange = (a, b, f) => {
        items[f][a].tint = colors[f][b];
    };

    //?????????????????????function
    const colorEvent = (x, f) => {
        //????????????????????????
        const colorbtns = document.querySelectorAll("." + parts[f] + "colorbtn");
        for (let i = 0; i < items[f].length; i++) {
            for (let c = 0; c < colors[f].length; c++) {
                colorbtns[c].removeEventListener(
                    "click",
                    function() {
                        colorchange(i, c, f);
                    },
                    false
                );
            }
        }
        for (let c = 0; c < colors[f].length; c++) {
            colorbtns[c].addEventListener(
                "click",
                function() {
                    colorchange(x, c, f);
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
        let aPi = './avatar-order-add-api.php';
        if (location.search.length > 0) {
            console.log(111);
            aPi = './avatar-order-edit-api.php';
        };
        const r = await fetch(aPi, {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        if (result['success'] === true) {
            alert('????????????');
        }
    }

    //?????????location.search???????????????
    if (location.search.length > 0) {
        console.log('search is alive!!');
        const inputAID = document.createElement('input');
        inputAID.type = 'text';
        inputAID.name = 'aid';
        inputAID.value = location.search.slice(10);
        form1.appendChild(inputAID);
        const avatarID = document.querySelector("#avatarID");
        avatarID.value = location.search.slice(10);
        async function getEditdata() {
            const fd = new FormData(document.form2);
            const r = await fetch('./avatar-get-edit-data-api.php', {
                method: 'POST',
                body: fd,
            });
            const result = await r.json();
            const a = JSON.parse(result[0]['combination']);
            for (i = 0; i < parts.length; i++) {
                const btns = document.querySelectorAll("." + parts[i] + "btn");
                const colorbtns = document.querySelectorAll("." + parts[i] + "colorbtn");
                btns[a[parts[i]]].click();
                colorbtns[a[parts[i] + "Color"]].click();
            }

        }
        getEditdata();
    }
</script>

<?php include __DIR__ . './parts/html-foot.php' ?>