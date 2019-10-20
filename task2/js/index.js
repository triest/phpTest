var part1;
var part2;
var code;
window.onload = function () {
    part1 = document.getElementById('part1');
    part2 = document.getElementById('part2');
    code = document.getElementById('code');
    part2.oninput = function () {
        if (part2.value.length == 0) {
            part1.focus();
        }
    };
    part1.oninput = function () {
        if (part1.value.length == 0) {
            code.focus();
        }
    };
};


function countChar1() {
    let input = code.value;
    if (input.length >= 2) {
        part1.focus();
    }
}

function countChar2() {
    let input = part1.value;
    if (input.length >= 2) {
        part2.focus();
    }
}

function countChar3() {
    let input = part2.value;
    console.log(input.length);
    if (input.length === 3) {
        sendRequwest()
    }
}

function sendRequwest() {
    var formData = {s: 's'};
    var xhr = new XMLHttpRequest();
    var data = {};
    data.code = code.value;
    data.part1 = part1.value;
    data.part2 = part2.value;
    if (data.code == "" || data.part2 == "") {
        part2.focus();
    }
    $.ajax({
        type: 'POST',
        url: './server.php',
        data,
        success: function (msg) {
            alert(msg);
            code.style.display = 'none';
            part1.style.display = 'none';
            part2.style.display = 'none';
        }
    });

}