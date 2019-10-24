var part1;
var part2;
var code;
window.onload = function () {
    code = document.getElementById('code');
    part1 = document.getElementById('part1');
    part2 = document.getElementById('part2');
    code.onkeyup = function () {
        codeFunction();
    };
    part1.onkeyup = function () {
        part1Function()
    };
    part2.onkeyup = function () {
        part2Function()
    }
};

//обработчик поля кода
function codeFunction() {
    let input = code.value;
    if (input.length >= 3) {
        part1.focus();
    }
}

//обработчик поле первой части
function part1Function() {
    let input = part1.value;
    console.log("down");
    console.log(input.length);
    if (input.length >= 3) {
        part2.focus();
    } else if (input.length == 0) {
        code.focus();
    }
}

//отбпьотчик поля второй части
function part2Function() {
    let input = part2.value;
    if (input.length === 3) {
        sendRequest()
    } else if (input.length == 0) {
        part1.focus();
    }
}

//отправка запроса
function sendRequest() {
    var data = {};
    data.code = code.value;
    data.part1 = part1.value;
    data.part2 = part2.value;
    var forHtml = document.getElementById("forHtml");
    if (data.code == "" || data.part2 == "") {
        part2.focus();
    }
    $.ajax({
        type: 'POST',
        url: './server.php',
        data,
        success: function (msg) {
            forHtml.innerHTML = msg;
            let form = document.getElementById('form');
            form.style.display = 'none';
        }
    });

}