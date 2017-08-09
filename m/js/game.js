window.requestAnimFrame = (function() {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
        function(callback) {
        window.setTimeout(callback, 1000 / 60);
    };
})();

// 手機/平板判斷區
var mobileFG = false;
var ipadFG = false;
var moboleVertical = true;
if (isMobile.phone) mobileFG = true;
if (isMobile.tablet) ipadFG = true;

if(isMobile.apple.device){
    thisOS = 'ios';
}else{
    thisOS = (isMobile.android.device || isMobile.windows.device || isMobile.other.device) ? 'android' : '';
}

// 全域變數區
var canvas = document.getElementById('myStage');
var ctx = canvas.getContext('2d');
// 處理canvas畫質問題
var devicePixelRatio = window.devicePixelRatio || 1;
var backingStoreRatio = ctx.webkitBackingStorePixelRatio ||
    ctx.mozBackingStorePixelRatio ||
    ctx.msBackingStorePixelRatio ||
    ctx.oBackingStorePixelRatio ||
    ctx.backingStorePixelRatio || 1;
var ratio = devicePixelRatio / backingStoreRatio;

var height = $(window).height();
var width = $(window).width();
var imageMain = document.getElementById('GapCnyAll');
var imageBase = document.getElementById('GapBase');
var imageSpring = document.getElementById('GapSpring');
var stdHeight = 984;        // 基礎高
var percent = 1;            // 高度比例值

var endTime = new Date('1/26/2017');

if(mobileFG && !ipadFG){
    stdHeight = 667;
}else if(!mobileFG && ipadFG){
    stdHeight = 1280;
}

percent = (height / stdHeight);

var winds = [];                                 // 平台
var windCount = Math.floor(8 * percent);        // 平台數量
var dir = 'left';                               // 起始方向
var score = 0;                                  // 分數
var Gravity = 0.2;                              // y加速度
var moveGravity = 0.15;                         // x加速度
var speedLimit = 8;                             // x軸的速限
var gameEndScore = 500;                         // 遊戲結束的分數
var gameEND = false;                            // 遊戲結束的判斷flag
var jump = -10;
var jumpHeight = -18;
var jumpTop = -100;

var EndY,endScreenY;
var sensorCnt = 25;                             // 拉繩範圍
var endCnt = [];                                // 重排平台的y for endLines
var endLines = [];
var endLineCount = 3;                           // 結束的拉繩數量
var endLineHeight = height;                     // 結束的拉繩寬度
var endLineWidth = 84 * endLineHeight / 800;    // 結束的拉繩寬度

var platHeight = 90;
var platWidth = 146;
var playerHeight = 185;
var playerWidth = 160;
var propHeight = 73;
var propWidth = 65;

var CouponCard = $('.part3');
var OverLineIndex;
var MoveLineX;
var MoveLineSpeed = 7.5;
var MoveLineLeft_fg = false;
var MoveLineRight_fg = false;
var MovePlayerDone_fg = false;

var playerMoveY = 40;
var stopHeight = height * -0.3;

if(mobileFG && !ipadFG){
    Gravity = 0.15;
    moveGravity = 0.075;
    speedLimit = 4;
    gameEndScore = 500;
    jump = -8;
    jumpHeight = -12;
    jumpTop = -75;

    sensorCnt = 10;

    platHeight = platHeight / 2;
    platWidth = platWidth / 2;
    playerHeight = playerHeight / 2;
    playerWidth = playerWidth / 2;
    propHeight = propHeight / 2;
    propWidth = propWidth / 2;

    MoveLineSpeed = 5;

    playerMoveY = 15;
}

//mobileFG = false;
//ipadFG = false;

var Base = function() {
    this.height = 336 * width / 750;
    this.width = width;
    this.x = 0;
    this.y = height - this.height;

    this.cx = 0;
    this.cy = 125.5;
    this.cwidth = 750;
    this.cheight = 336;

    this.draw = function() {
        try {
            ctx.drawImage(imageBase, this.cx, this.cy, this.cwidth, this.cheight, this.x, this.y, this.width, this.height);
        } catch (e) {}
    };
};
var BaseWind = function() {
    this.height = 125 * base.height / 337;
    this.width = width * 186 / 750;

    this.x = (width * 393 / 750) + (width * 78 / 750) - 2;
    this.y = height - this.height - underBaseHeight;

    this.cx = 470;
    this.cy = 0;
    this.cwidth = 187;
    this.cheight = 125;

    this.draw = function() {
        try {
            ctx.drawImage(imageBase, this.cx, this.cy, this.cwidth, this.cheight, this.x, this.y, this.width, this.height);
        } catch (e) {}
    };
};
var Player = function() {
    this.height = playerHeight;
    this.width = playerWidth;
    this.x = basewind.x + (basewind.width / 2) - (this.width / 3.2);
    this.y = basewind.y - this.height + playerMoveY;

    this.cx = 0;
    this.cy = 0;
    this.cheight = 285;
    this.cwidth = 245;

    this.vy = 11;
    this.vx = 0;

    this.isMovingLeft = false;
    this.isMovingRight = false;
    this.isDead = false;
    this.isJumpOver = false;
    this.dir = "left";

    this.draw = function() {
        try {
            if (this.dir == "right") this.cy = 1020;
            else if (this.dir == "left") this.cy = 430;
            else if (this.dir == "right_land") this.cy = 725;
            else if (this.dir == "left_land") this.cy = 135;

            ctx.drawImage(imageMain, this.cx, this.cy, this.cwidth, this.cheight, this.x, this.y, this.width, this.height);
        } catch (e) {}
    };

    this.jump = function() {
        this.vy = jump;
    };
    this.jumpHigh = function() {
        this.vy = jumpHeight;
    };
    this.jumpTop = function() {
        this.vy = jumpTop;
    };
};
function wind() {
    this.scale = Math.random() * 6 / 10 + 0.8;

    this.height = platHeight * this.scale;
    this.width = platWidth * this.scale;
    this.x = Math.random() * (width - this.width);
    this.y = position;

    position += (height / windCount);

    this.cx = 10;
    this.cy = 0;
    this.cheight = 130;
    this.cwidth = 211;

    this.state = 0;
    this.drawFG = true;

    this.draw = function() {
        try {
            ctx.drawImage(imageMain, this.cx, this.cy, this.cwidth, this.cheight, this.x, this.y, this.width, this.height);
        } catch (e) {}
    };
}
var spring = function() {
    this.height = propHeight;
    this.width = propWidth; 
    this.x = 0;
    this.y = 0;

    this.cx = 60;
    this.cy = 0;
    this.cheight = 138;
    this.cwidth = 124;

    this.state = 0;
    this.type = 0;

    this.draw = function() {
        try {
            if (this.type === 0) {
                this.cy = 1444;
            }else if (this.type === 1) {
                this.cy = 1320;
            };

            if(this.state === 0){
                ctx.drawImage(imageMain, this.cx, this.cy, this.cwidth, this.cheight, this.x, this.y, this.width, this.height);
            }
        } catch (e) {}
    };
};
var endLine = function(){
    this.height = endLineHeight;
    this.width = endLineWidth;
    this.x = 0;
    this.y = height * -1;

    this.cx = 0;
    this.cy = 0;
    this.cwidth = 84;
    this.cheight = 800;

    this.isDraw = true;

    this.draw = function() {
        try {
            if(this.isDraw) ctx.drawImage(imageSpring, this.cx, this.cy, this.cwidth, this.cheight, this.x, this.y, this.width, this.height);
        } catch (e) {}
    };
}

var base = new Base();

var underBaseHeight = 31 * base.height / 337;
var position = base.y - height + 50; 

var basewind = new BaseWind();
var player = new Player();
var Spring = new spring();


for (var i = 0; i < windCount; i++) {
    winds.push(new wind());
}
for (var i = 0; i < endLineCount; i++) {
    endLines.push(new endLine());
    endLines[i].cx = i * 84;
}
/* Setting End */

var game = {
    token: '',
    num: '',
    money: 0,
    coupon: true,
    init: function(){
        var $this = this;

        var num = 2;
        var part2 = $('.part2');
        var part3 = $('.part3');
        var knownBtn = $('.known');
        var couponBtn = $('.outside .1 button').eq(0);
        var againBtn = $('.outside .1 button').eq(1);

        CouponCard.css('top', height * -1);

        canvas.width = width;
        canvas.height = height;
        var oldWidth = canvas.width;
        var oldHeight = canvas.height;
        canvas.width = oldWidth * ratio;
        canvas.height = oldHeight * ratio;
        canvas.style.width = oldWidth + 'px';
        canvas.style.height = oldHeight + 'px';
        ctx.scale(ratio, ratio);

        $('body').on('touchmove', function (event) {
            event.preventDefault();
        });

        $('.part3').css('background-color', 'rgba(0, 0, 0, 0)');

        $('#myStage').fadeIn('fast',function(){
            game.updateAll();
            part2.fadeIn('fast',function(){
                $this.getKey('start');
            });
        });


        knownBtn.on('click',function(event){
            event.preventDefault();
            var $btn = $(this);

            $('.howtoplay').fadeOut('fast',function(){
                $('.countdown').fadeIn('fast');
                var cnt = setInterval(function(){
                    if(num == 0){
                        clearInterval(cnt);
                        part2.fadeOut('fast',function(){
                            game.play();
                            $this.getKey('play');
                        });
                    }
                    $('.countdown h1').html(num);
                    num--;
                }, 1000);
                $btn.off('click');
            });
        });

        couponBtn.on('click',function(event){
            event.preventDefault();

            if(!$this.coupon){
                location.href = 'index.php';
            }else{
                /* 2017-01-17 Jeffery 更新 */
                // gaclick('result_get_coupon');
                $this.getKey('taken');
            }
        });

        againBtn.on('click',function(event){
            event.preventDefault();
            trackWaitJump('result_replay','game.php');
        });

        $this.mobileLockWay();

        gapage('1_game');
    },
    getKey: function(type){
        if(type === undefined) alert('type 參數傳遞錯誤！');
        var $this = this;
        var url = '';
        var data = {};
        
        /* 2016-01-23 Jeffery 加上活動結束判斷 */
        if(new Date() >= endTime){
            if(type === 'start'){
                $('.outside li:not(.1)').hide();
                $('.newyear, .soldout').show();
                $('.outside .1 button').eq(0).html(' 回首頁');
            }
            return;
        }

        if(type === 'start'){
            url = 'api/check.php';
        }else if(type === 'play'){
            url = 'api/number.php';
            data = { 
                token : $this.token 
            };
        }else if(type === 'taken'){
            url = 'api/taken.php';
            data = { 
                token : $this.token,
                num : $this.num
            };
        }

        $.ajax({
            method: "POST",
            url: url,
            data: $.param(data),
            success: function(result){
                if(!result.err){
                    if(type === 'start'){
                        $this.token = result.token;
                        $this.coupon = result.coupon;

                        if(!$this.coupon){
                            $('.outside li:not(.1)').hide();
                            $('.newyear, .soldout').show();
                            $('.outside .1 button').eq(0).html(' 回首頁');
                        }
                    }else if(type === 'play'){
                        $this.num = result.num;
                        $this.money = result.money;
                        $('.left.number img').eq(0).attr('src','asset/svg/'+result.money+'.svg');
                    }else if(type === 'taken'){
                        /* 2017-01-17 Jeffery 更新 */
                        trackWaitJump('result_get_coupon','coupon.php');
                        //location.href = 'coupon.php';
                    }
                }else{
                    /* 2017-01-16 Jeffery 調整loading關閉延遲 */
                    // alert(type+' : 後端程式繁忙，請稍後再試！');
                    alert('連線逾時，請稍後再試！');
                }
            },
            error: function(result){
                /* 2017-01-16 Jeffery 調整loading關閉延遲 */
                // alert(type + ' : 網路連線出錯，請稍後再試！');
                alert('連線逾時，請稍後再試！');
            }
        });
    },
    play: function(){
        var $this = this;
        window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", $this.mobileLockWay , false);
        animloop = function() {
            $this.updateAll();
            requestAnimFrame(animloop);
        };

        animloop();
    },
    updateAll: function(){
        var $this = this;
        if(moboleVertical){
            $this.clearCanvas();
            base.draw();
            basewind.draw();
            endLines.forEach(function(p, i) {
                p.draw();
            });
            $this.drawProps();
            $this.drawWind();  
            $this.drawPlayer();

            player.draw();
        }
    },
    OverDraw: function(){
        var $this = this;
        var MovePlayerX = MoveLineSpeed;

        overLoop = function(){
            $this.clearCanvas();
            $this.drawWind();

            endLines.forEach(function(p, i) {
                switch (i){
                    case 0:
                        if(p.x < MoveLineX){
                            p.x += MoveLineSpeed; 
                        }else{
                            if(OverLineIndex !== i) p.isDraw = false;
                            MoveLineLeft_fg = true;
                        }
                        break;
                    case 1:
                        if(OverLineIndex !== i && (MoveLineLeft_fg || MoveLineRight_fg)) p.isDraw = false;
                        break;
                    case 2:
                        if(p.x > MoveLineX){
                            p.x -= MoveLineSpeed; 
                        }else{
                            if(OverLineIndex !== i) p.isDraw = false;
                            MoveLineRight_fg = true;
                        }
                        break;
                }

                p.draw();
            });

            switch (OverLineIndex){
                case 0:
                    if(player.x + player.width / 3 < MoveLineX){
                        player.dir = 'right';
                        player.x += MovePlayerX;
                    }else{
                        MovePlayerDone_fg = true;
                    }
                    break;
                case 1:
                    MovePlayerDone_fg = true;
                    break;
                case 2:
                    if(player.x + player.width / 5 > MoveLineX){
                        player.dir = 'left';
                        player.x -= MovePlayerX;
                    }else{
                        MovePlayerDone_fg = true;
                    }
                    break;
            }

            player.draw();

            if(MoveLineLeft_fg && MoveLineRight_fg && MovePlayerDone_fg){
                var oldHeight = parseInt(CouponCard.css('top').replace('px',''));
                if(oldHeight < 0){
                    if(oldHeight < stopHeight){
                        player.y += MoveLineSpeed;
                        endLines.forEach(function(p, i) {
                            p.y += MoveLineSpeed;
                        });   
                    }
                    $this.dropCoupon();
                }else{
                    CouponCard.css('top','0px');
                    TweenMax.to($('.part3'), .5, {
                        backgroundColor: 'rgba(0, 0, 0, 0.5)',
                        ease: Power1.easeOut,
                        onComplete: function () {

                        }
                    });
                    overLoop = function(){
                        return;
                    }
                }
            }

            requestAnimFrame(overLoop);
        };
        overLoop();
    },
    dropCoupon: function(){
        var oldHeight = parseInt(CouponCard.css('top').replace('px',''));
        var newHeight = oldHeight + MoveLineSpeed;

        if(newHeight > 0){ newHeight = 0; }
        CouponCard.css('top',newHeight + 'px');
    },
    clearCanvas: function(){
        ctx.clearRect(0, 0, width, height);
    },
    mobileSensor: function(){
        var gamma = Math.round(event.gamma);
        var range = 5;

        if(thisOS === 'android'){
            range = 4;
        }

        if(gamma > range){
            dir = "right";
            player.isMovingRight = true;
        }else if (gamma >= (range*-1) && gamma <= range){
            player.isMovingLeft = false;
            player.isMovingRight = false;
        }else if(gamma < (range*-1)){
            dir = "left";
            player.isMovingLeft = true;
        }
    },
    mobileLockWay:function(){
        if (window.orientation === 180 || window.orientation === 0) {
            moboleVertical = true;
        }
        if (window.orientation === 90 || window.orientation === -90 ){
            moboleVertical = false;
        } 
    },
    drawPlayer: function(){
        var $this = this;
        if (dir == "left") {
            player.dir = "left";
            if (player.vy < -6 && player.vy > -15) player.dir = "left_land";
        } else if (dir == "right") {
            player.dir = "right";
            if (player.vy < -6 && player.vy > -15) player.dir = "right_land";
        }

        if(mobileFG || ipadFG){
            window.addEventListener('deviceorientation', $this.mobileSensor , false);
        }else{
            document.onkeydown = function(e) {
                var key = e.keyCode;

                if (key == 37) {
                    dir = "left";
                    player.isMovingLeft = true;
                } else if (key == 39) {
                    dir = "right";
                    player.isMovingRight = true;
                }

                if(key == 32) {
                    animloop = function() {
                        return;
                    };
                }
            };
            document.onkeyup = function(e) {
                var key = e.keyCode;

                if (key == 37) {
                    dir = "left";
                    player.isMovingLeft = false;
                } else if (key == 39) {
                    dir = "right";
                    player.isMovingRight = false;
                }
            };
        }

        if (player.isMovingLeft === true) {
            player.x += player.vx;
            player.vx -= moveGravity;
        } else {
            player.x += player.vx;
            if (player.vx < 0) player.vx += 0.05;
        }

        if (player.isMovingRight === true) {
            player.x += player.vx;
            player.vx += moveGravity;
        } else {
            player.x += player.vx;
            if (player.vx > 0) player.vx -= 0.05;
        }

        if(player.vx > speedLimit){
            player.vx = speedLimit;
        }else if(player.vx < (speedLimit * -1)){
            player.vx = (speedLimit * -1);
        }

        var calcBaseX = base.y + base.height - underBaseHeight;
        var calcPlayerY = (player.y + player.height - (player.height / 4));
        if(calcBaseX > height){
            if (calcPlayerY > height) player.jump();
        }else if(calcBaseX <= height){
            if (calcPlayerY > height - underBaseHeight) player.jump();
        }

        if((player.y + player.height - (player.height / 4)) > basewind.y
           && (player.x + (player.width / 3) < basewind.x + basewind.width) 
           && (player.x + player.width - (player.width / 3) > basewind.x) 
          ) player.jump();

        if(score > gameEndScore){
            player.isDead = true;
            winds.forEach(function(p, i) {
                endCnt.push(p.y);
            });

            endCnt.sort(function(a,b){
                if (a > b) return -1;
                if (a < b) return 1;
                return 0;
            });

            EndY = endCnt[0];
            endScreenY = EndY - (height * 2);
            endLines.forEach(function(p, i) {
                if(endScreenY < stopHeight){
                    var adj = 0;
                    if(i == 0){ adj = width * -0.05; }
                    if(i == 2){ adj = width * 0.05; }
                    p.x = ((width / (endLineCount + 1)) * (i + 1)) - (endLineWidth / 2) + adj;
                    if(i == 1) MoveLineX = p.x;
                    if(!gameEND) p.y = endScreenY;
                }
                p.draw();
            });
        }

        if (player.x > width) {
            player.x = 0 - player.width;
        }else if (player.x < 0 - player.width){ 
            player.x = width;
        }

        if (player.y >= (height / 2) - (player.height / 2)) {
            player.y += player.vy;
            player.vy += Gravity;
        } else {
            winds.forEach(function(p, i) {
                if (player.vy < 0) p.y -= player.vy;

                if (p.y > height && player.isDead !== true) {
                    winds[i] = new wind();
                    winds[i].y = p.y - height;
                }
            });

            base.y -= player.vy;
            basewind.y -= player.vy;
            player.vy += Gravity;

            if (player.vy >= 0) {
                player.isJumpOver = false;
                player.y += player.vy;
                player.vy += Gravity;
            }
            score++;
        }

        $this.collides();
        if (player.isDead === true) $this.gameOver();
    },
    collides: function(){
        winds.forEach(function(p, i) {
            if (player.vy > 0 
                && p.state === 0 
                && (player.x + (player.width / 3) < p.x + p.width) 
                && (player.x + player.width - (player.width / 3) > p.x) 
                && (player.y + (player.height / 2) > p.y) 
                && (player.y + (player.height / 2) < p.y + p.height)) {
                if(p.drawFG) player.jump();
            }
        });

        var s = Spring;
        var pX = player.x + player.width + 15;
        var pY = player.y + player.height + 15;
        if((s.state === 0) && !player.isJumpOver
           && (pX > s.x && pX < s.x + (s.width * 3)) 
           && (pY > s.y && pY < s.y + (s.height * 3))
          ){
            if(s.type === 0){
                player.jumpHigh();
            }else if(s.type === 1){
                player.isJumpOver = true;

                var newjumpTop = 0;
                if(score > score * 0.1){
                    newjumpTop = jumpTop *  1;
                    //console.log(1);
                    if(score > gameEndScore * 0.2){
                        newjumpTop = jumpTop * 0.8;
                        //console.log(2);
                        if(score > gameEndScore * 0.3){
                            newjumpTop = jumpTop * 0.775;
                            //console.log(3);
                            if(score > gameEndScore * 0.4){
                                newjumpTop = jumpTop * 0.7;
                                //console.log(4);
                                if(score > gameEndScore * 0.5){
                                    newjumpTop = jumpTop * 0.6;
                                    //console.log(5);
                                    if(score > gameEndScore * 0.6){
                                        newjumpTop = jumpTop * 0.55;
                                        //console.log(6);
                                        if(score > gameEndScore * 0.7){
                                            newjumpTop = jumpTop * 0.425;
                                            //console.log(7);
                                            if(score > gameEndScore * 0.8){
                                                newjumpTop = jumpTop * 0.35;
                                                //console.log(8);
                                                if(score > gameEndScore * 0.9){
                                                    newjumpTop = jumpTop * 0.225;
                                                    //console.log(9);
                                                    if(score > gameEndScore){
                                                        newjumpTop = jumpTop * 0.2;
                                                        //console.log(10);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                jumpTop = newjumpTop;
                //console.log(jumpTop);
                player.jumpTop();
            }
            s.type = Math.floor(Math.random() * 2);
            s.state = 1;
        }
    },
    drawProps: function(){
        var s = Spring;
        var p = winds[0];
        p.drawFG = false;

        s.x = p.x + p.width - s.width * 1.5;
        s.y = p.y - p.height / 2 + s.height / 2;

        if(s.state === 0) s.draw();
        if(s.y < 0) s.state = 0;
    },
    drawWind: function(){
        winds.forEach(function(p, i) {
            if(p.drawFG) p.draw();
        });
    },
    gameOver: function(){
        var $this = this;
        if(!gameEND){
            var adjX = (player.width / 3 * 2);
            var playerX = player.x;
            var playerY = player.y + (player.height / 2);
            var passHeight = playerY - height;

            endLines.forEach(function(p, i) {
                var thisX = p.x + (p.width / 2);
                if((playerX + adjX - thisX > 0 && playerX + player.width - adjX - thisX < sensorCnt) && (passHeight <= endScreenY)){
                    gameEND = true;
                    OverLineIndex = i;
                    animloop = function() {
                        return;
                    };
                }
            });
        }
        if(gameEND) $this.OverDraw();
    }
}

$(function(){
    game.init();
});