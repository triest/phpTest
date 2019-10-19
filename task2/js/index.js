var part1;
var part2;
window.onload = function () {
    part1 = document.getElementById('part1');
    part2 = document.getElementById('part2');
};

function countChar1() {
    let input = document.getElementById('code').value;
    if (input.length >= 2) {
        part1.focus();
    }
}

function countChar2() {
    let input = document.getElementById('part1').value;
    if (input.length >= 2) {
        part2.focus();
    }
}

function countChar3() {
    let input = document.getElementById('part2').value;
    if (input.length === 3) {
        sendRequwest()
    }
}

function sendRequwest() {
    var formData = {s: 's'};
    var xhr = new XMLHttpRequest();
    var data = {};
    data.code = document.getElementById('code').value;
    data.part1 = document.getElementById('part1').value;
    data.part2 = document.getElementById('part2').value;
    $.ajax({
        type: 'POST',
        url: './server.php',
        data,
        success: function (msg) {
            alert(msg);
            document.getElementById('code').disabled = true;
            document.getElementById('part1').disabled = true;
            document.getElementById('part2').disabled = true
        }
    });

}