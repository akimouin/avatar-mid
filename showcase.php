<?php include __DIR__ . './parts/connect-db.php' ?>
<?php include __DIR__ . './parts/html-head.php' ?>
<?php include __DIR__ . './parts/navbar.php' ?>
<div class="container">
    <div class="row" id="showcase"></div>
</div>
<?php include __DIR__ . './parts/scripts.php' ?>
<script>
    const showcase = document.querySelector('#showcase');
    const avatarBox = (f)=>{
        return`
        <div class="avatarBox col-3"><p>${f}</p></div>`;
    };
    async function getData() {
        const r = await fetch('getshowcase-api.php', {
            method: 'POST',
            //body: fd,
        });
        const result = await r.json();
        console.log(result);
        for (i=0; i<result.length; i++){
            showcase.innerHTML += avatarBox(result[i].avatar_created_at);
        }
        

    }
    getData();
</script>
<?php include __DIR__ . './parts/html-foot.php' ?>