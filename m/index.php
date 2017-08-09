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
        <!--loading 雞跳跳 -->
        <div class="loading">
            <div class="jumper">
                <div class="cloud"><div class="gi">
                    <div class="gigibody"><img src="asset/svg/gigi_body.svg" alt="">
                        <div class="ass"></div>
                    </div>
                    </div>
                    <img src="asset/svg/cloud.svg" alt=""></div>
            </div>
        </div>
        <div class="part1">
            <header>
                <!-- logo    -->
                <a href="index.php" class="logo"><img src="asset/svg/LOGO.svg" alt=""></a>
                <!-- burger -->
                <div class="bur_box">
                    <div class="bur" tabindex="1">
                        <div class="burger-brick"></div>
                        <div class="burger-brick middle"></div>
                        <div class="burger-brick"></div>
                    </div>
                </div>           
            </header>
            <div class="menubox">
                <ul>
                    <li><button>活動首頁</button></li>
                    <li><button>活動辦法</button></li>
                    <li><button>門市資訊</button></li>
                    <li><button>臉書分享</button></li>
                </ul>
            </div>
            <div class="wrap">
                <!-- content -->
                <div class="main">
                    <section>
                        <div class="upupup"><img src="asset/svg/title.svg" alt=""></div>
                        <a href="#" class="start"><img src="asset/svg/start.svg" alt=""></a>
                    </section>
                </div>
            </div>
        </div>
        <!-- part1結束 -->
    </body>
    <script src="js/index.js"></script>
    <script src="js/menu.js"></script>
</html>