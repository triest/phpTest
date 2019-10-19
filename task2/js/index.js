var part1;
var part2;
window.onload = function () {
    console.log("load");
    part1 = document.getElementById('part1');
    part2 = document.getElementById('part2');
};

function countChar1() {
    console.log("count");
    let input = document.getElementById('code').value;
    if (input.length >= 2) {
        part1.focus();
    }
}

function countChar2() {
    console.log("count2");
    let input = document.getElementById('part1').value;
    if (input.length >= 2) {
        part2.focus();
    }
}