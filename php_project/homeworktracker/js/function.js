const progress = document.querySelector('#progresstxt');
const progressBar = document.querySelector('#slider');
console.log(progressBar.value);
const color = document.querySelector('#color');
const remove = document.querySelector('.remove');
const preformance = document.querySelector('.preformance');
const li = document.querySelectorAll('li');

progressBar.addEventListener('input', () => {
    progress.textContent = progressBar.value + '%';  
    let min = progressBar.min;
    let max = progressBar.max;

    let poor = min;
    let execl = max;
    
    if((progressBar.value > poor) && (progressBar.value < 25)){
        color.style.background="red";
    }
    if((progressBar.value >= 25) && (progressBar.value < (execl / 2))){
        color.style.background="orange";
    }
    if((progressBar.value > 50) && (progressBar.value < 75 )){
        color.style.background="yellow";
    }
    if((progressBar.value >= 75) && (progressBar.value < 100)){
        color.style.background="green";
    }
});

const back = () => {
    preformance.style.display="none";
}

remove.addEventListener('click', back);

function getName(){
    console.log(li.value);
}

function printMyBillingArea() {
    var divContent_1 = document.querySelector('h1').innerHTML;
    var divContent_2 = document.querySelector('ul').innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>Homework Report</title>');
    a.document.write('<body style="font-family: fangsong">');
    a.document.write(divContent_1);
    a.document.write(divContent_2);
    a.document.write('</html>');
    a.document.close();
    a.print();
}