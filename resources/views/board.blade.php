<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test</title>

    <!-- Styles -->
    @vite('resources/css/app.css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .border-light-1 {
            border: 1px solid #252525;
        }

        .colors {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .color-box {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .timer {
            font-size: 24px;
            margin: 20px 0;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .selectedCell {
            box-shadow: 0px 0px 50px 25px rgba(0, 0, 0, 0.80);
        }
    </style>
</head>

<body>
    <div>
        <div class="board" id="board"></div>
        <div class="container" style="margin:10px">
            <div>{x:<span id="currentX"></span>, y:<span id="currentY"></span>, color:<span id="currentColor"></span>}
            </div>
            <div class="colors">
                <div class="color-box" style="background-color: red"></div>
                <div class="color-box" style="background-color: orange"></div>
                <div class="color-box" style="background-color: yellow"></div>
                <div class="color-box" style="background-color: green"></div>
                <div class="color-box" style="background-color: blue"></div>
                <div class="color-box" style="background-color: indigo"></div>
                <div class="color-box" style="background-color: violet"></div>
            </div>
            <button id="sendButton" style="margin-top:15px;" disabled>Paint</button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", createBoard({{ $board->width }}, {{ $board->height }}));

        // disable colors and send button div
        const colors = document.querySelector(".colors");
        colors.style.pointerEvents = "none";
        $("#currentX").text("null");
        $("#currentY").text("null");
        $("#currentColor").text("null");

        function createBoard(width, height) {
            const board = document.getElementById("board");
            board.style.display = "grid";
            board.style.gridTemplateColumns = `repeat(${width}, 30px)`;
            board.style.gridTemplateRows = `repeat(${height}, 30px)`;

            for (let i = 1; i <= width; i++) {
                for (let j = 1; j <= height; j++) {
                    const cell = document.createElement("div");
                    cell.classList.add("border-light-1");
                    cell.id = `cell-${i}-${j}`;
                    // add event listener
                    cell.addEventListener("click", () => {
                        update(i, j, cell);
                    });
                    board.appendChild(cell);
                }
            }
        }

        let formData = {
            x: null,
            y: null,
            color: null
        };

        // set x and y
        function update(x, y, cell) {
            $(".selectedCell").removeClass('selectedCell');
            $("#" + cell.id).addClass('selectedCell');
            formData.x = x;
            formData.y = y;

            // enable colors div
            const colors = document.querySelector(".colors");
            colors.style.pointerEvents = "auto";
            $("#currentX").text(x);
            $("#currentY").text(y);
        }

        function paint(x, y, color) {
            let cell = document.getElementById(`cell-${x}-${y}`);
            cell.style.backgroundColor = color;
        }

        // dots array
        let dots = JSON.parse('{!! $board->dots !!}');
        dots.forEach(dot => {
            paint(dot.x, dot.y, dot.color);
        });

        // Color Panel
        // Renk kutularını seçme
        const colorBoxes = document.querySelectorAll('.color-box');

        const sendButton = document.getElementById('sendButton');

        colorBoxes.forEach(box => {
            box.addEventListener('click', () => {
                colorBoxes.forEach(box => box.classList.remove('selected'));
                box.classList.add('selected');
                formData.color = box.style.backgroundColor;
                sendButton.removeAttribute('disabled');
                $("#currentColor").text(box.style.backgroundColor);
            });
        });

        // Gönder butonuna tıklandığında geri sayımı başlatma
        sendButton.addEventListener('click', () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('dot.store', $board->slug) }}',
                async: false,
                data: {
                    x: formData.x,
                    y: formData.y,
                    color: formData.color
                },
                done: function(data) {}
            });
            $(".selectedCell").removeClass('selectedCell');
            $("#currentX").text("null");
            $("#currentY").text("null");
            $("#currentColor").text("null");
            sendButton.setAttribute('disabled', true);
            colors.style.pointerEvents = "none";
        });
    </script>

    @vite('resources/js/app.js')
</body>

</html>
