<meta name="viewport" content="width=device-width, initial-scale=1">
<div style="padding:20px;margin-top:30px;">
    <h1>新增筆記</h1>
    @if ($message = Session::get('alert'))
        <script>alert("{{ $message }}");</script>
    @endif

    <div style="display:none">
        <img id="scream" width="220" height="277"
             src="{{asset('images/uccu/uccu1.jpg')}}" alt="m">
    </div>

    <form id="json" name="json" method="POST" action="/notes" enctype="multipart/form-data">
        @csrf
        @method('POST')
        課程：<input name="class" id="class"><br>
        筆記名稱：<input name="notename" id="notename"><br>



        <div style="display:none">
            <input name="json" id="json">
            <img id="jsonimg" width="220" height="277"
                 src="" alt="">

        </div>

        <button onclick="add()" id="send" name="send" type="submit">save</button>

        <div style="display: none">
            <input name="valuetojs" value="testsendvalue">
        </div>

    </form>

    文字：<input id="word" type="checkbox">
    插圖：<input id="pic" type="checkbox">


    <button><div id="clear">清空畫布</div></button>

{{--    <button onclick="save()">儲存</button>--}}

    <p id="demo"></p>


    <div style="position: relative;">
        <canvas id="note" width="1191" height="1684" style="position: absolute; left: 0; top: 0; z-index: 3;"></canvas>
        {{--    background-image:url({{asset('images/uccu/uccu1.jpg')}});--}}
        <canvas id="textlayer" width="1191" height="1684"
                style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
        <canvas id="imglayer" width="1191" height="1684"
                style="position: absolute; left: 0; top: 0; z-index: 1; background-image:url({{asset('images/uccu/uccu1.jpg')}}); "></canvas>
    </div>

    <canvas id="c2" width="1191" height="1684"></canvas>

</div>

<div class="tool" id="toolid">
    <a href="#about"><i class="fas fa-highlighter"></i> 螢光筆</a>
    <form style="margin:0" id="penform" name="penform">
        <a><input name="pen" id="pen" type="range" min="1" max="20" step="1" value="2"></a>
        <a><input readonly="readonly" name="penvalue" id="penvalue" size="1" style="text-align:center"></a>
        <a><input type="color" name="pencolor" id="pencolor" value="#000000"></a>
    </form>
    <a><i class="fas fa-font"></i><button onclick="textbox()" style="font-size: 17px;">文字</button></a>

    <form style="margin:0" id="text" name="text">
        <a><input name="text" id="text"></a>
    </form>
    <a href="#clients"><i class="fas fa-eraser"></i> 橡皮擦<input id="erasere" type="checkbox"></a>

    <form style="margin:0" id="image" name="image" method="POST" action="/image" enctype="multipart/form-data" onsubmit="return imgtocanvas(e)">
        @csrf
        @method('POST')
        <a><i class="fas fa-camera"></i> 圖片<input type="file" name="img" id="imgup" accept="image/*;" capture="camera" ></a>
        <div style="display:none">
            <button id="to" name="to" type="submit" value="send"></button>
        </div>
    </form>
    <a href="/"><i class="fas fa-home home" style="color:#FFFFFF"></i></a>
    <a href="javascript:void(0);" class="icon" onclick="hidd()"><i class="fa fa-bars"></i></a>
</div>


<style>
    canvas {
        width: 1191px;
        height: 1684px;
    }

    body{
        background: #F0F0F0;
    }

    .tool {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        z-index: 4;
        background-color: #333;
        position: fixed;
        top: 0;
        width: 100%;
    }
    .tool a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .tool a:hover {
        background-color: #ddd;
        color: black;
    }

    .tool a.active {
        background-color: #4CAF50;
        color: white;
    }

    .tool .icon {
        display: none;
    }

    .tool button {
        background-color:transparent;
        border-style:none;
        color:white;
    }
    .tool button:hover {
        background-color: #ddd;
        color: black;
    }

    @media screen and (max-width: 600px) {
        .tool a:not(:first-child) {display: none;}
        .tool a.icon {
            float: right;
            display: block;
        }
    }
    @media screen and (max-width: 600px) {
        .tool.responsive {
            position: fixed;
            top: 0;
            width: 100%;}
        .tool.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        .tool.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
    }
    .home{
        float: right;
    }
</style>
<script>

    let isDrawing = false;
    let x = 0;
    let y = 0;

    const note = document.getElementById('note');
    const context = note.getContext('2d');
    const textlayer = document.getElementById('textlayer');
    const textcontext = textlayer.getContext('2d');
    const imglayer = document.getElementById('imglayer');
    const imgcontext = imglayer.getContext('2d');

    note.addEventListener('mousedown', e => {
        x = e.offsetX;
        y = e.offsetY;
        isDrawing = true;

        if (erasere.checked&&note.click) {
            for (var i = 0; i < lines.length; i++) {
                if (x >= lines[i].start[0] && x <= lines[i].end[0]&&y<=lines[i].start[1]+5&&y>=lines[i].start[1]-5) {
                    context.globalAlpha = 1;
                    context.lineWidth = document.penform.pen.value;
                    context.strokeStyle = "#ffffff";
                    var w=+lines[i].width[0];
                    context.lineWidth=w+1;
                    context.globalCompositeOperation="destination-out";
                    context.beginPath();
                    context.moveTo(lines[i].start[0], lines[i].start[1]);
                    context.lineTo(lines[i].end[0], lines[i].end[1]);
                    context.stroke();
                    context.closePath();
                    lines.splice(i, 1);
                    isDrawing = false;
                }
            }
            for(var j=0; j<textarr.length; j++){
                if(x<=textarr[j].location[0]+textarr[j].width&&x>=textarr[j].location[0]&&y<=textarr[j].location[1]&&y>=textarr[j].location[1]-textarr[j].height){
                    textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-25, textarr[j].width, textarr[j].height+11);
                    textarr.splice(j, 1);
                    isDrawing = false;
                }
            }
            for(var k=0; k<picarr.length; k++){
                if(x<=picarr[k].location[0]+picarr[k].width[0]&&x>=picarr[k].location[0]&&y>=picarr[k].location[1]&&y<=picarr[k].location[1]+picarr[k].height[0]){
                    imgcontext.clearRect(picarr[k].location[0], picarr[k].location[1], picarr[k].width, picarr[k].height);
                    picarr.splice(k, 1);
                    isDrawing = false;

                }
            }
        }

        else if (isDrawing === true && erasere.checked===false ) {
            drawLine(context, x, y, e.offsetX, e.offsetY);
            x = e.offsetX;
            y = e.offsetY;
        }
    });

    note.addEventListener('mousemove', e => {
        if (erasere.checked===true||word.checked===true||pic.checked===true) {
            isDrawing = false;

        }

    });

    const lines = []
    window.addEventListener('mouseup', e => {
        if (isDrawing === true && erasere.checked===false && word.checked===false&&pic.checked===false) {
            drawLine(context, x, y, e.offsetX, e.offsetY);


            if (x !== e.offsetX) {

                const line = {
                    start: [x, y],
                    end: [e.offsetX, y],
                    color:[document.penform.pencolor.value],
                    width:[document.penform.pen.value]
                }
                lines.push(line)
            }
        }
        if(erasere.checked===false&&note.click&& word.checked===true&& pic.checked===false) {
            for (var j = 0; j < textarr.length; j++) {
                if(x<=textarr[j].location[0]+textarr[j].width&&x>=textarr[j].location[0]&&y<=textarr[j].location[1]&&y>=textarr[j].location[1]-textarr[j].height) {
                    console.log('hey tiz')

                    console.log(textarr[j].location[0])
                    console.log(textarr[j].location[1])
                    textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-25, textarr[j].width, textarr[j].height+11);
                    textarr[j].location[0]=e.offsetX;
                    textarr[j].location[1]=e.offsetY;
                    console.log(textarr[j].location[0])
                    console.log(textarr[j].location[1])
                    console.log(textarr)
                    textcontext.font = "30px Arial";
                    textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    textarr[j].width = textcontext.measureText(textarr[j].text).width;
                    textarr[j].height = 16;
                }
            }
        }

        if(erasere.checked===false&&note.click&& word.checked===false&& pic.checked===true) {
            for (var k = 0; k < picarr.length; k++) {
                if(x<=picarr[k].location[0]+picarr[k].width[0]&&x>=picarr[k].location[0]&&y>=picarr[k].location[1]&&y<=picarr[k].location[1]+picarr[k].height[0]) {
                    console.log('hey mochi')

                    console.log(picarr[k].location[0])
                    console.log(picarr[k].location[1])
                    imgcontext.clearRect(picarr[k].location[0], picarr[k].location[1], picarr[k].width, picarr[k].height);
                    picarr[k].location[0]=e.offsetX;
                    picarr[k].location[1]=e.offsetY;
                    console.log(picarr[k].location[0])
                    console.log(picarr[k].location[1])
                    console.log(picarr)


                    document.json.jsonimg.src="{{asset('images/')}}"+"/"+picarr[k].path[0]
                    var img = new Image();
                    img.src=document.json.jsonimg.src;
                    imgcontext.drawImage(img, picarr[k].location[0], picarr[k].location[1]);


                }
            }
        }

        else {
            x = 0;
            y = 0;

        }
        isDrawing = false;

    });
    note.addEventListener('touchstart', e => {
        document.getElementById("demo").innerHTML = "手機";
    });

    function drawLine(context, x1, y1, x2, y2) {
        context.beginPath();
        context.moveTo(x1, y1);
        context.lineTo(x2, y1);

        if(word.checked===false&&pic.checked===false) {
            context.stroke();
            context.closePath();
        }
    }


    const linetext= []
    function add(){
        linetext.push(textarr)
        linetext.push(lines)
        linetext.push(picarr)
        var linestr = JSON.stringify(linetext);
        console.log(linestr)
        document.json.json.value=linestr;
    }
    //new
    const textarr = []

    function textbox() {
        const dspace = document.text.text.value.replace(/^\s*|\s*$/g,"");
        if(dspace!=="") {
            const note = document.getElementById('note');
            const context = note.getContext('2d');
            const word = {
                location: [50, 50],
                text: [dspace]
            }
            textarr.push(word)
            console.log(textarr)

            textcontext.font = "30px Arial";
            textcontext.fillText(dspace, 50, 50);
            word.width = textcontext.measureText(word.text).width;
            word.height = 16;
        }
    }

    clear.addEventListener('click',function(){
        const note = document.getElementById('note');
        const context = note.getContext('2d');
        context.clearRect(0,0,note.width,note.height);
    });

    function save() {
        const note = document.getElementById('note');
        var dataURL=note.toDataURL('image/png');
        const link = document.createElement('a');
        link.innerText = '下載圖片';
        link.href = dataURL;
        link.download = 'download.png';
        document.body.appendChild(link);

    }


    window.onload = function() {

    }

    function hidd() {
        var x = document.getElementById("toolid");
        if (x.className === "tool") {
            x.className += " responsive";
        } else {
            x.className = "tool";
        }
    }
</script>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
    $("#imgupload").change(function(){
        readURL(this);

    });

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    var imageLoader = document.getElementById('imgup');
    imageLoader.addEventListener('change', imgtocanvas, false);
    const picarr=[]

    function imgtocanvas(e){

        $("#image").ajaxSubmit(function() {
        });


        var reader = new FileReader();
        reader.onload = function(e){
            var img = new Image();
            img.onload = function(){

                imgcontext.drawImage(img,0,0,img.width,img.height);
                const pic = {
                    location: [0, 0],
                    path: [imageLoader.value.split("\\").pop()],
                    width:[img.width],
                    height:[img.height]
                }

                picarr.push(pic)
                console.log(picarr)
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }

    pen.addEventListener("change", function (){

        for(var p=0;p<=20;p++){
            console.log(p)
            console.log(document.penform.pen.value)
            document.penform.penvalue.value=document.penform.pen.value;
            const pensize=+document.penform.pen.value;
            if (pensize === p) {
                context.globalAlpha = 0.5;
                context.globalCompositeOperation = "source-over";
                context.lineWidth = p;
                context.strokeStyle = document.penform.pencolor.value;

            }
        }

    },false);


    pencolor.addEventListener("change", function (){
        context.globalCompositeOperation = "source-over";
        document.penform.penvalue.value=document.penform.pen.value;
        context.globalAlpha = 0.5;
        context.strokeStyle = document.penform.pencolor.value;

    },false);

</script>



<script src="https://kit.fontawesome.com/a076d05399.js"></script>
