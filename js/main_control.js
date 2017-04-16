function mapPutPixel(x, y, color) {
    str = "#line"+ y + " th:nth-child(" + x + ")";
//	console.log(str);
    $(str).css('background', color);
}

function moveShip(){

}

const DOWN = 0;
const LEFT = 1;
const UP = 2;
const RIGHT = 3;
$(document).ready(function() {
    currentShip = null;
    current = 0;

    //LEFT BUTTON
    $('#left_button').click(function(){
        console.log ('LEFTCLICK BEFORE DIR:', currentShip['ship_dir']);
        currentShip['ship_dir'] = parseInt(currentShip['ship_dir']);
        eraseShip(currentShip['ship_pos_x'],currentShip['ship_pos_y'], model[currentShip['ship_type']] , currentShip['ship_dir']);
        currentShip['ship_dir'] = (currentShip['ship_dir'] + 3) % 4;
        drawShip(currentShip['ship_pos_x'], currentShip['ship_pos_y'], model[currentShip['ship_type']], currentShip['ship_color'], currentShip['ship_dir']);
        console.log ('LEFTCLICK BEFORE DIR:', currentShip['ship_dir']);

    });

    //RUGHT BUTTON
    $('#right_button').click(function(){
        console.log ('RIGHT BEFORE DIR:', currentShip['ship_dir']);
        currentShip['ship_dir'] = parseInt(currentShip['ship_dir']);
        eraseShip(currentShip['ship_pos_x'],currentShip['ship_pos_y'], model[currentShip['ship_type']] , currentShip['ship_dir']);
        currentShip['ship_dir'] = (currentShip['ship_dir'] + 1) % 4;
        console.log("current ship dir", currentShip['ship_dir']);
        drawShip(currentShip['ship_pos_x'], currentShip['ship_pos_y'], model[currentShip['ship_type']], currentShip['ship_color'], currentShip['ship_dir']);
        console.log ('RIGHT BEFORE DIR:', currentShip['ship_dir']);

    });

    function parseArrayToPost(array, type){
        ret = type + "=true";
        for (var key in array) {
            if (array.hasOwnProperty(key)) {
                ret += "&" + key + "=" + array[key];
            }
        }
        return (ret);
    }
    //UP BUTTON
    //data:"ship=true" + "&x=" + current['x'] + "&y=" + ships_data['y'] + "&ship_id= " + ships_data['ship_id'],
    $('#up_button').click(function(){
        eraseShip(currentShip['ship_pos_x'],currentShip['ship_pos_y'], model[currentShip['ship_type']] , currentShip['ship_dir']);
        parseArrayToPost(currentShip);
        console.log ('ship _dir = ', currentShip['ship_dir']);
        switch (parseInt(currentShip['ship_dir'])){
            case UP: currentShip['ship_pos_y']--;break;
            case DOWN: currentShip['ship_pos_y']++;break;
            case LEFT: currentShip['ship_pos_x']--;break;
            case RIGHT: currentShip['ship_pos_x']++;break;
        }
        //drawShip(ships_data['ship_pos_x'], ships_data['ship_pos_y'], model[ships_data['ship_type']], 'blue',DOWN);// ships_data['dir']);

        drawShip(currentShip['ship_pos_x'], currentShip['ship_pos_y'], model[currentShip['ship_type']], currentShip['ship_color'], currentShip['ship_dir']);
    });

    function find_next_current(index, ships){
        count = 0;
        if (index >= Object.keys(ships).length - 1) {
            index = 0;
        }
        while (ships[index]['ship_user_id'] != ships['current_user_id'])
        {
            index++;
            if (index >= Object.keys(ships).length - 1){
                index = 0;
            }
            count ++;
            if (count> Object.keys(ships).length)
                return (-1);
        }
        return (index);
    }
    //SUBMIT
    $('#submit_button').click(function(){
        current = find_next_current(current + 1, ships_data);
       /* current+=1;
        if (current >= Object.keys(ships_data).length -1) {
            current = 0;
        }
        count = 0;
        console.log ("curent user ID AND ship user id", ships_data['current_user_id'], ships_data[current]['ship_user_id']);
        while (ships_data[current]['ship_user_id'] == ships_data['current_user_id']) {
            current += 1;
            console.log('current', current);
            if (current >= Object.keys(ships_data).length - 1)
                current = 0;
            count++;
            if (count > Object.keys(ships_data).length)
                return;
        }*/
       /* if (current < Object.keys(ships_data).length)
            currentShip = ships_data[current];
        else
        {
            current=0;
            currentShip = ships_data[0];
            console.log('end of ship');
        }*/
        $.ajax({
            url:"action.php",
            type:"post",
            data:parseArrayToPost(currentShip, "ship"),
            success:function(msg){
                console.log ("HERE IS RESULT ",msg);
            }
        });
    });

    function eraseShip(x, y, model, dir) {
        x = parseInt(x) + 1;
        y = parseInt(y);
        if (dir == DOWN) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, 'lightblue');
                }
            }
        }
        if (dir == UP) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, 'lightblue');
                }
            }
        }
        if (dir == LEFT) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x + Math.floor((model.length / 2)) - i, y + Math.floor((model[0].length / 2)) - j, 'lightblue');
                }
            }
        }
        if (dir == RIGHT) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x - Math.floor((model.length / 2)) + i, y - Math.floor((model[0].length / 2)) + j, 'lightblue');
                }
            }
        }
    }
    function drawShip(x, y, model, color, dir) {
        (x)= parseInt(x) + 1;
        (y)= parseInt(y);
        console.log ("in draw ", x, y);
        if (dir == DOWN) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                    {
                        console.log ("in down ", x, y)
                        mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, color);
                    }
                }
            }
        }
        else if (dir == UP) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, color);
                }
            }
        }
        else if (dir == LEFT) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x + Math.floor((model.length / 2)) - i, y + Math.floor((model[0].length / 2)) - j, color);
                }
            }
        }
        else if (dir == RIGHT) {
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                    if (model[i][j] == '#')
                        mapPutPixel(x - Math.floor((model.length / 2)) + i, y - Math.floor((model[0].length / 2)) + j, color);
                }
            }
        }
    }

    {
        model = new Array();
        model.push(new Array());
        model[0].push("## ## ## ##");
        model[0].push("## ## ## ##");
        model[0].push("###########");
        model[0].push("#  #####  #");
        model[0].push("#  #####  #");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("  #######  ");
        model[0].push("  #######  ");
        model[0].push("  #  #  #  ");
        model[0].push("  #  #  #  ");
        model[0].push("  #######  ");
        model[0].push("   #####   ");

        model.push(new Array());
        model[1].push("###########");
        model[1].push("#   ###   #");
        model[1].push("###########");
        model[1].push("   #####   ");
        model[1].push("   ## ##   ");
        model[1].push("   #   #   ");

        model.push(new Array());
        model[2].push("##  ###  ##");
        model[2].push("#   ###   #");
        model[2].push("###########");
        model[2].push("    ###    ");
        model[2].push("    ###    ");
        model[2].push("     #     ");} // model
    ships_data = new Array();
    function ajaxGetShip(handleData) {
        $.ajax({
            url: "action.php?action=getship",
            type: "get",
            success: function (msg) {
                ships_data = JSON.parse(msg);
                for (a = 0; a < Object.keys(ships_data).length - 1; a++) {
                    console.log("PROUUUTEUU");
                    drawShip(ships_data[a]['ship_pos_x'], ships_data[a]['ship_pos_y'], model[ships_data[a]['ship_type']], ships_data[a]['ship_color'], ships_data[a]['ship_dir']);
                }
                handleData(ships_data);
            }
        });
    }

    function ajaxRefreshShip(handleData) {
        $.ajax({
            url: "action.php?action=refreshship",
            type: "get",
            success: function (msg) {
                ships_data_new = JSON.parse(msg);
                //console.log(msg);
                test = 0;
                for (a = 0; a < Object.keys(ships_data).length - 1; a++) {
                    if (ships_data_new[a]["nb_jr"] == '0')
                    {
                        test = 1;
                        console.log ("AJAX RQUEST DONE", ships_data_new);
                        eraseShip(ships_data[a]['ship_pos_x'],ships_data[a]['ship_pos_y'], model[ships_data[a]['ship_type']] , ships_data[a]['ship_dir']);  
                        drawShip(ships_data_new[a]['ship_pos_x'], ships_data_new[a]['ship_pos_y'], model[ships_data_new[a]['ship_type']], ships_data_new[a]['ship_color'], ships_data_new[a]['ship_dir']);
                    }
                }
                if (test == 1)
                    ships_data = ships_data_new;
                handleData(ships_data);
            }
        });
    }
    ajaxGetShip(function (ships_data){
        currentShip = ships_data[current];
    });

    function qwe()
    {
        ajaxRefreshShip(function (ships_data){
        currentShip = ships_data[current];
    });
    }

     $.ajax({
            url: "action.php?action=getship",
            type: "get",
            success: function (msg) {
                ships_data = JSON.parse(msg);
                console.log("HEY!", Object.keys(ships_data).length, ships_data);
                current = find_next_current(current, ships_data);
                for (a = 0; a < Object.keys(ships_data).length - 1; a++) {
                        drawShip(ships_data[a]['ship_pos_x'], ships_data[a]['ship_pos_y'], model[ships_data[a]['ship_type']], ships_data[a]['ship_color'], ships_data[a]['ship_dir']);
                }
            }
        });
    setInterval(qwe,1000);
});

function ecri()
{
    $.post("req_php.php?page=game", { text: $("#msg").val()});
    $("#msg").val("");
}

$(document).keypress(function (e) {
    if (e.which == 13 || event.keyCode == 13) {
        ecri();
    }
});