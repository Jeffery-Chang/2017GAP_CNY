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
        <header>
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
            <div class="store">
                <h1>門市資訊</h1>
                <h2>FIND A STORE</h2>
                <ul class="tab">
                    <li class="north"><a href="">北部</a><span></span></li>
                    <li class="center"><a href="">中部</a><span></span></li>
                    <li class="south"><a href="">南部</a></li>
                </ul>
                <div class="store_block north">
                    <p>ATT4FUN旗艦店</p>
                    <span>台北市信義區松壽路12號<br>
                        營業時間：10:00 - 22:00</span>
                </div>
                <div class="store_block">
                    <p>統一時代台北店</p>
                    <span>台北市信義區忠孝東路五段8號B1樓<br>
                        營業時間：<br>
                        週日~週四 11:00~21:30<br>
                        週五~週六 11:00~22:00<br>
                        (含國定假日前一天)</span>
                </div>
                <div class="store_block">
                    <p>大葉高島屋店 </p>
                    <span>台北市士林區忠誠路二段55號2樓<br>
                        營業時間：<br>週日~週四 11:00~21:30<br>
                        週五~週六 11:00~22:00
                    </span>
                </div>
                <div class="store_block">
                    <p>MegaCity板橋大遠百店
                    </p>
                    <span>新北市板橋區新站路28號B1樓<br>
                        營業時間 11:00~22:00
                    </span>
                </div>
                <div class="store_block">
                    <p>桃園台茂店 </p>
                    <span>桃園市蘆竹區南崁路一段112號3樓<br>
                        營業時間：<br>週一至週四 11:00~22:00<br>週五 11:00~22:30<br>
                        週六 10:30~22:30<br>週日 10:30~22:00
                    </span>
                </div>
                <div class="store_block">
                    <p>BigCity新竹巨城店 </p>
                    <span>新竹市中央路229號1樓<br>
                        營業時間：<br>週日~週四 11:00~21:30<br>週五~週六 11:00~22:00

                    </span>
                </div>
                <div class="store_block center">
                    <p>台中旗艦店</p>
                    <span>台中市西區台灣大道二段461號<br>
                        營業時間：11:00~22:00


                    </span>
                </div>
                <div class="store_block">
                    <p>TopCity台中大遠百店
                    </p>
                    <span>台中市西屯區台灣大道三段251號 北棟4樓<br>
                        營業時間：<br>週一~週五 11:00 - 22:00<br>
                        週六~週日 10:30 - 22:00
                    </span>
                </div>
                <div class="store_block south">
                    <p>台南南紡購物中心
                    </p>
                    <span>台南市東區中華東路一段366號1樓<br>
                        營業時間：<br>週一~週日 11:00~22:00
                    </span>
                </div>
                <div class="store_block">
                    <p>高雄夢時代店 </p>
                    <span>高雄市前鎮區中華五路789號1樓<br>
                        營業時間：<br>週一~週四 11:00~22:00<br>週五 11:00~22:30<br>
                        週六及例假日10:30~22:30<br>週日10:30~22:00
                    </span>
                </div>
            </div>
        </div>
        <!-- footer -->
        <footer></footer>
    </body>
    <script src="js/store.js"></script>
    <script src="js/menu.js"></script>
</html>
