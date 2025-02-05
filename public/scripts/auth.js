import { toCamelCase } from '../scripts/toCamelCase.js';

const submitButton = document.querySelector('#submit');
const buttonValue = document.querySelector('#submit').value;

submitButton.addEventListener('click', () => {
    console.log('clicou!');

    console.log(buttonValue);

    if(buttonValue === 'register'){

        let inputs = document.querySelectorAll('.input');

        let formData = {}; // braces means that the object can use key-values
        // if it is [] it means that it can be used only numerical values... [0], [1], [2]...

        inputs.forEach(input => {

            input.name = toCamelCase(input.name);

            formData[input.name] = input.value;
            
        })

        

        if(formData.password === formData.confirmPassword && formData.email.includes('@')){

            const email_container = document.querySelector('.email_container');

            const errorText = document.querySelector('.incorrect_text');

            email_container.removeChild(errorText);

        } else{

            const email_container = document.querySelector('.email_container');
            const password_container = document.querySelector('.password_container');

            if(!formData.email.includes('@')){

                const errorText = document.createElement('p');
                errorText.innerText = 'E-mail Incorreto';

                errorText.classList.add('incorrect_text')

                email_container.appendChild(errorText);
            }

            if(formData.password != formData.confirmPassword){

                const errorText = document.createElement('p');
                errorText.innerText = 'Senhas não coincidem';

                errorText.classList.add('incorrect_text');

                password_container.appendChild(errorText);
            }
        }
    
    } else{

    }
})


function verifyRegister(){
    
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm_password');
    
}