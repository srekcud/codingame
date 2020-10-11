/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
function compareNombres(a, b) {
    return a - b;
}

var N = parseInt(readline());
var horses = [];
var min = 999;
for (var i = 0; i < N; i++) {
    horses[i] = parseInt(readline());
}

horses.sort(function(a, b) {
    return a - b;
});

for (var i = 0; i < N - 1; i++) {
    var diff = horses[i + 1] - horses[i];
    if (diff < min) {
        min = diff
    }
}
// Write an action using print()
// To debug: printErr('Debug messages...');

print(min);