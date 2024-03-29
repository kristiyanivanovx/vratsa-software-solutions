function solve(arr) {
    if (arr === '') {
        return "The input must not be an empty string";
    }
    
    let met = [];
    let splitted = arr.split(' ');

    splitted.forEach(element => {
        let numberElement = Number(element);
        if (!met.includes(numberElement) && !isNaN(numberElement)) {
            met.push(numberElement);
        }
    })

    if (met.length === 0) {
        return 'The input values must be convertible to a number';
    }

    return met;
}

console.log(solve(''));
console.log(solve('1 2 2 6 8 6 7 8'));
console.log(solve('0 0 0 0 0 '));
console.log(solve('mk pp we vfv'));
console.log(solve('1 br 2 1 werr 3 1'));
console.log(solve('2 “” add “” 1 1 asd 2 “” 3'));


