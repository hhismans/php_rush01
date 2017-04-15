


function mapPutPixel(x, y, color) {
    str = "#line"+ y + " th:nth-child(" + x + ")";
    console.log(str);
    $(str).css('background', color);
}

function moveShip(){

}

$(document).ready(function(){
    function drawShip(x, y, model, color, dir) {
        if (dir == 0) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, color);
                }
            }
        }
        if (dir == 1) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, color);
                }
            }
        }
        if (dir == 2) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(y + Math.floor((model.length / 2)) - i, x + Math.floor((model[0].length / 2)) - j, color);
                }
            }
        }
        if (dir == 3) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(y - Math.floor((model.length / 2)) + i, x - Math.floor((model[0].length / 2)) + j, color);
                }
            }
        }
    }

    model = new Array();
    model.push("###");
    model.push(" # ");
    model.push(" # ");

    drawShip(2,3,model, 'blue', 0);
    drawShip(40,20,model, 'blue', 1);
    drawShip(60,20,model, 'blue', 2);
    drawShip(80,20,model, 'blue', 3);

    ship_coord = new Array();
    $.ajax({
        url:"action.php?action=getship",
        type:"get",
        success:function(msg){
            ship_coord = JSON.parse(msg);
            console.log(msg);
        }
    });

    $('#left_button').click(function(){
        $.get('test.php?move=left', function(data, status) {
            alert("data : " + data + "\nStatus" + status);
        })
    });

    $('#right_button').click(function(){
        $.get('test.php?move=right', function(data, status) {
            alert("data : " + data + "\nStatus" + status);
        })
    });

    $('#up_button').click(function(){
        $.get('test.php?move=up', function(data, status) {
            alert("data : " + data + "\nStatus" + status);
        })
    });

    $('#down_button').click(function(){
        $.get('test.php?move=down', function(data, status) {
            alert("data : " + data + "\nStatus" + status);
        })
    });

    $('#my-span').click(function(){
        console.log(ship_coord);
    });
});
