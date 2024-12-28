const darkMode = document.getElementById('darkModeToggle');
const elements = document.querySelectorAll('#boxCalculator', '#boxButton', '#boxBilangan');
const hasil = document.getElementById('hasil');
const btn = document.querySelectorAll('button');
let str = '';
let arr = Array.from(btn);

const min = function(hasil){
    return hasil.value = -hasil.value;
};


document.addEventListener('keydown', function(e) {
    const key = e.key;

    if (/[\d.+\-*/%]/.test(key)){
        if(hasil.value == '0'){
            str = key;
            hasil.value = str; 
        } else{
            str += key;
            hasil.value = str;     
        }
    } else if (key === 'Enter'){
      str = eval(str);
      hasil.value = str;
    } else if (key === 'Backspace'){
      str = str.slice(0, -1);
      hasil.value = str;
    } else if (key === 'Delete'){
        str = '';
        hasil.value = str;
    }
});

arr.forEach(button =>{
    button.addEventListener('click', function(e){
        if(e.target.innerHTML == '='){
            str = eval(str);
            hasil.value = str;
        } else if(e.target.innerHTML == 'AC'){
            str = '';
            hasil.value = str;
        } else if(e.target.innerHTML == 'C'){
            str = str.slice(0, -1);
            hasil.value = str;
        } else if(e.target.innerHTML == '+/-'){
            str = min(hasil);
            hasil.value = str;
        }
        else {
            if(hasil.value == '0'){
                str = e.target.innerHTML;
                hasil.value = str; 
            } else{
                str += e.target.innerHTML;
                hasil.value = str;     
            }
        }
    });
});


darkMode.addEventListener("click", function(){
    document.body.classList.toggle('dark-mode');

    elements.forEach(function(e) {
        e.classList.toggle('dark-mode');
    });
});
