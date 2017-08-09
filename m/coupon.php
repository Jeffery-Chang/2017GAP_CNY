<?php @session_start();?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>GAP雞吉向上 | 新年有新意</title>
        <!-- facebook share -->
        <meta property="og:type" content="website" />
        <meta name="description" content="迎接金雞年，只要保持積極向上的態度，就能獲得意想不到的驚喜優惠，GAP新年賀歲遊戲等你來挑戰！">
        <meta name="keywords" content="Gap 蓋璞 台灣 1969 牛仔褲 卡其褲 優惠 折扣 減價 促銷 雞年 過年 新年 紅包 購物金 門市">
        <meta property="og:title" content="和GAP一起雞吉向上，領取新春優惠！" />
        <meta name="copyright" content="版權所有 Gap Taiwan">
        <meta property="og:image" content="img/600x315.png" />
        <meta property="og:description" content="迎接金雞年，只要保持積極向上的態度，就能獲得意想不到的驚喜優惠，GAP新年賀歲遊戲等你來挑戰！" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="icon" href="img/favicon.ico">
        <!-- css style -->
        <link rel="stylesheet" href="css/style.css">
        <!--[if gt IE 9]><script src="../js/vendor/html5shiv.js"></script><![endif]-->
        <script src="../js/vendor/jquery-1.9.1.min.js"></script>
        <script src="js/vendor/TweenMax.min.js"></script>
        <script src="js/vendor/hidpe-canvas-polyfill.min.js"></script>
        <script src="../js/vendor/isMobile.min.js"></script>
        <script src="../js/vendor/ga.js"></script>
        <script>
            var paramsUrl = '';
            if(location.search !== ''){
                paramsUrl = location.search;
            }
            
            if (!isMobile.phone && !isMobile.tablet) location.href = '../index.php' + paramsUrl;
        </script>
    </head>
    <body>
        <!-- only fot ipad -->
        <div class="trans_bg">
            <div class="trans_ipad">
                <div class="trans_center"><img src="img/turn.png">
                    <p>請將裝置轉至直式
                        <br>體驗最佳瀏覽方式</p>
                </div>
            </div>
            <!-- only for iphone -->
            <div class="trans_iphone">
                <div class="trans_center"><img src="img/turn.png">
                    <p>請將裝置轉至直式
                        <br>體驗最佳瀏覽方式</p>
                </div>
            </div>
        </div>
        <div class="coupon"> <div class="gaplogo"><img src="asset/svg/gaplogo.svg" alt=""></div><!-- <img src="img/coupon01_28.png" alt=""> -->
            <div class="dotted">
                <div class="purchase"><img src="img/coupon<?=$_SESSION['money']?>.png" alt=""></div>
                <div class="barcode">
                    <img src="api/image.php?code=code128&o=1&t=63&r=1&text=<?=$_SESSION['number']?>&f=3&a1=&a2=" alt="Error? Can\'t display image!">
                </div> 
                <p>＊請自行由螢幕截圖保存優惠券</p>
            </div>
        </div>
        <div class="txt"><p>活動期間在Gap台灣正價門市或Gap台灣在線商店（Gap.tw）購物，單筆訂單可折抵。優惠有效期2017年1月12日至2017年1月25日。門市消費時請於結帳時出示此券，經店員確認後使用，官網消費請在結算頁輸入’’優惠條碼序號15碼’’。優惠僅適用於Gap台灣門市及在線商店，不適用於Gap中國內地、香港、奧特萊斯店、清倉店和其他網上購物平台。本券一經删除或核銷即不可再次使用。單筆訂單僅限使用一張優惠券，每張優惠券僅限使用一次，不找零，不可抵扣運費及兌換現金。優惠對於之前所購買的產品不做相應調整。使用優惠券的訂單中的產品如需退換貨，則需按實際結算金額為准，退換貨後本券不予返還。優惠不得用於購買Gap禮品卡。優惠不得蓋璞公司員工優惠同時使用。</p></div>
        <a href="" class="fb_btn"><span><img src="asset/svg/facebook.svg" alt=""></span>分享你的新意</a>
    </body>
    <script src="js/coupon.js"></script>
    <script src="js/menu.js"></script>
</html>
