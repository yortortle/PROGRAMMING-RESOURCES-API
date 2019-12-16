BEGIN;

CREATE DATABASE RESOURCES;
\c resources;

CREATE TABLE submissions(
  id SERIAL,
  title VARCHAR(64),
  tool VARCHAR(64),
  description varchar(256),
  url VARCHAR(256),
  cost INT
);

INSERT INTO submissions ( title, tool, description, url, cost ) VALUES ( 'C++ Udemy Course', 'C++', 'In depth C++ programming from beginner to master', 'https://www.udemy.com/course/beginning-c-plus-plus-programming/learn/lecture/9535214?start=0#overview', 15 );

INSERT INTO submissions ( title, tool, description, url, cost ) VALUES ( 'PHP Laravel Crash Course', 'PHP Laravel', 'Great youtube series to learn laravel, a PHP framework', 'https://www.youtube.com/watch?v=eD4yMI-IR8g&list=PLpzy7FIRqpGC8Jk6gyWdSVdxCVXZAsenQ', 0 );

INSERT INTO submissions ( title, tool, description, url, cost ) VALUES ( 'Coders Tape VUE crash course', 'Vue', 'Vue from beginning to master hosted by youtube channel coders tape', 'https://www.youtube.com/watch?v=wVmSvDqojBc', 0 );


CREATE TABLE snippets(
  id SERIAL,
  title VARCHAR(64),
  description VARCHAR(512)
);

INSERT INTO snippets ( title, description ) VALUES ( 'Bubblesort method 1 javascript', 'let bubbleSort = (inputArr) => {
    let len = inputArr.length;
    for (let i = 0; i < len; i++) {
        for (let j = 0; j < len; j++) {
            if (inputArr[j] > inputArr[j + 1]) {
                let tmp = inputArr[j];
                inputArr[j] = inputArr[j + 1];
                inputArr[j + 1] = tmp;
            }
        }
    }
    return inputArr;
};');

INSERT INTO snippets ( title, description ) VALUES ( 'luhn formula javascript', '// Takes a credit card string value and returns true on valid number
function valid_credit_card(value) {
  // Accept only digits, dashes or spaces
	if (/[^0-9-\s]+/.test(value)) return false;

	// The Luhn Algorithm.
	let nCheck = 0, bEven = false;
	value = value.replace(/\D/g, "");

	for (var n = value.length - 1; n >= 0; n--) {
		var cDigit = value.charAt(n),
			  nDigit = parseInt(cDigit, 10);

		if (bEven && (nDigit *= 2) > 9) nDigit -= 9;

		nCheck += nDigit;
		bEven = !bEven;
	}

	return (nCheck % 10) == 0;
}');

INSERT INTO snippets ( title, description ) VALUES ( 'javascript for loop', 'var i;
for (i = 0; i < cars.length; i++) {
  text += cars[i] + "<br>";
}');
