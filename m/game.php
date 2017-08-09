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
        <div class="preload" hidden>
            <img id="GapCnyAll" src="img/gigi.png"/>
            <img id="GapSpring" src="img/GAP_all_spring.png"/>
            <img id="GapBase" src="img/floor.png"/>
        </div>
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
        <!-- part2 -->
        <div class="part2">
            <ul class="howtoplay">
                <li><img src="img/how.png" alt=""></li>
                <li>
                    左右移動手機
                    <br> 讓雞正確踩在雲朵上
                    <br> 積極向上跳躍
                    <br> 就能領取獨家優惠！
                    <br> ＊數量有限 先領先贏
                </li>
                <li>
                    <a href="#" class="known">我知道了</a>
                </li>
            </ul>
            <div class="countdown" hidden><h1>3</h1></div>
        </div>
        <canvas id="myStage" hidden></canvas>

        <!-- part3 -->
        <div class="part3">
            <!-- 春連 -->
            <div class="couplet">
                <!--  燈籠 -->
                <div class="lantern">
                    <img src="asset/svg/A.svg" alt="" hidden>
                </div>
                <div class="line"></div>
                <!--  燈籠 -->
                <div class="circle a"></div>
                <div class="circle b"></div>
                <div class="circle c"></div>
                <div class="circle d"></div>
                <div class="outside">
                    <ul>
                        <li class="left got"><img src="asset/svg/got.svg" alt=""></li>
                        <li class="left number">
                            <img src="asset/svg/28.svg" alt="">
                            <img class="doll" src="asset/svg/dollar.svg" alt=""></li>
                        <li class="right"><img src="asset/svg/coupon.svg" alt=""></li>
                        <li class="happy"><img src="asset/svg/happynewyear.svg" alt=""></li>
                        <li class="newyear" hidden><img src="asset/svg/S_newyear.svg" alt=""></li>
                        <li class="soldout" hidden><img src="asset/svg/Soldout.svg" alt=""></li>
                        <li class="1">
                            <button> 領取COUPON</button>
                        </li>
                        <li class="1">
                            <button> 再玩一次</button>
                        </li>
                    </ul>
                </div>
                <div></div>
            </div>
        </div>
        <!-- part3結束 -->
        <!-- footer -->
        <footer></footer>
    </body>
    <script src="js/game.js"></script>
    <script src="js/menu.js"></script>
</html>
