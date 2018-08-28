<?php
$js        = new \wx\wx_jsapi();
$appid     = WX_APPID;
$timestamp = $js->getTimestamp();
$noncestr  = $js->getNoncestr();
$signature = $js->getSignature();
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>四维平面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/source/css/weui.css">
    <link rel="stylesheet" type="text/css" href="/source/css/wx-web.css">
    <script src="/source/js/jweixin-1.2.0.js" type="text/javascript"></script>
    <script src="/source/js/weui.min.js" type="text/javascript"></script>
    <script src="/source/js/jquery.min.js" type="text/javascript"></script>
    <script src="/source/js/wx-web.js" type="text/javascript"></script>
</head>
<body>
<div class="page_hd">
    <h1 class="page_title" onclick="window.location.reload()">四维平面</h1>
    <p class="page_desc">siweipingmian</p>
</div>
<div class="container" id="container">
    <div class="page grid js_show">
        <div class="weui-grids">
            <a href="javascript:" class="weui-grid" id="demo">
                <div class="weui-grid__icon">
                    <img src="/source/image/lys.jpg" alt="">
                </div>
                <p class="weui-grid__label">demo</p>
            </a>
        </div>
    </div>
</div>

<div class="weui-footer">
    <p class="weui-footer__links">
        <a href="https://blog.aikamino.cn/" class="weui-footer__link">四维平面技术部</a>
    </p>
    <p class="weui-footer__text">Copyright © 2018 aikamino.cn</p>
</div>


<script>
    wx.config({
        debug: true,
        appId: '<?=$appid?>',
        timestamp: '<?=$timestamp?>',
        nonceStr: '<?=$noncestr?>',
        signature: '<?=$signature?>',
        jsApiList: [
            'chooseImage',
            'previewImage',
            'startRecord',
        ]
    });
    wx.error(function (msg) {
        alert(msg)
    })
</script>
</body>
</html>