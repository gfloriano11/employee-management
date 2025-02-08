import { toCamelCase } from '../scripts/toCamelCase.js';

const submitButton = document.querySelector('#submit');
const buttonValue = document.querySelector('#submit').value;

submitButton.addEventListener('click', () => {

    if(buttonValue === 'register'){

        let inputs = document.querySelectorAll('.input');
        let select = document.querySelector('#select').value;

        let formData = {}; // braces means that the object can use key-values
        // if it is [] it means that it can be used only numerical values... [0], [1], [2]...

        inputs.forEach(input => {

            input.name = toCamelCase(input.name);

            formData[input.name] = input.value;

            
        })

        if(formData.password.length <= 3){

            const email_container = document.querySelector('.email_container');
            const password_container = document.querySelector('.password_container');

            let errorExists = document.querySelector('.password_container .incorrect_text');
    
            if(!errorExists){

                const errorText = document.createElement('p');
                errorText.innerText = 'Senha muito pequena';

                errorText.classList.add('incorrect_text');

                password_container.appendChild(errorText);

            } else if(errorExists.innerText === 'Senhas não coincidem'){

                password_container.removeChild(errorExists);

                const errorText = document.createElement('p');
                errorText.innerText = 'Senha muito pequena';

                errorText.classList.add('incorrect_text');

                password_container.appendChild(errorText);
            }

            if(!formData.email.includes('@')){

                let errorExists = document.querySelector('.email_container .incorrect_text');
                
                if(!errorExists){
    
                    const errorText = document.createElement('p');
                    errorText.innerText = 'E-mail Incorreto';
    
                    errorText.classList.add('incorrect_text')
    
                    email_container.appendChild(errorText);
                }

            } else {

                let errorExists = document.querySelector('.email_container .incorrect_text');

                if(errorExists){
                    const email_container = document.querySelector('.email_container');
                    const errorText = document.querySelector('.email_container .incorrect_text');
    
                    email_container.removeChild(errorText);
                }

            }

        } else {

            let emailError = document.querySelector('.email_container .incorrect_text');
            let passwordError = document.querySelector('.password_container .incorrect_text');

            if(passwordError && emailError){
                passwordError.remove()
                emailError.remove();
            }

            if(formData.password === formData.confirmPassword && formData.email.includes('@')){

                let emailError = document.querySelector('.email_container .incorrect_text');
                let passwordError = document.querySelector('.password_container .incorrect_text');
    
                if(emailError){

                    emailError.remove();
                } 
                
                if(passwordError){
                
                    passwordError.remove();
                }

                fetch(`auth/register`, {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json',
                    },
                    body: JSON.stringify({
                        full_name: formData.fullName,
                        email: formData.email,
                        password: formData.password,
                        confirm_password: formData.confirmPassword,
                        post: formData.post,
                        admin: select
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if(data.success){
                        window.location = data.redirect;
                    } else {
                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.log('Erro na requisição: ', error);
                })
    

            } else{
    
                const email_container = document.querySelector('.email_container');
                const password_container = document.querySelector('.password_container');
    
                if(!formData.email.includes('@')){
    
                    let errorExists = document.querySelector('.email_container .incorrect_text');
                    
                    if(!errorExists){
        
                        const errorText = document.createElement('p');
                        errorText.innerText = 'E-mail Incorreto';
        
                        errorText.classList.add('incorrect_text')
        
                        email_container.appendChild(errorText);
                    }
    
                } else {
    
                    let errorExists = document.querySelector('.email_container .incorrect_text');
    
                    if(errorExists){

                        const email_container = document.querySelector('.email_container');
                        const errorText = document.querySelector('.email_container .incorrect_text');
        
                        email_container.removeChild(errorText);
                    }
    
                }
    
                if(formData.password !== formData.confirmPassword){
    
                    let errorExists = document.querySelector('.password_container .incorrect_text');
    
                    if(!errorExists){
    
                        const errorText = document.createElement('p');
                        errorText.innerText = 'Senhas não coincidem';
        
                        errorText.classList.add('incorrect_text');
        
                        password_container.appendChild(errorText);
                    }

                } else {
    
                    let errorExists = document.querySelector('.password_container .incorrect_text');
    
                    if(errorExists){
    
                    console.log('removendo erro senha')
                        const password_container = document.querySelector('.password_container');
                        const errorText = document.querySelector('.password_container .incorrect_text');
    
                        password_container.removeChild(errorText);
                    }
                }
            }
        }
    
    } else{

        let inputs = document.querySelectorAll('.input');

        let formData = {};

        inputs.forEach(input => {

            input.name = toCamelCase(input.name);

            formData[input.name] = input.value;

        })

        if(formData.email.includes('@') && formData.password.length > 3){

            fetch(`auth/login`, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify({
                    email: formData.email,
                    password: formData.password
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)
                if(data.success){
                    window.location = data.redirect;
                } else {
                    console.log(data.message);
                }
            })
            .catch(error => {
                console.log('Erro na requisição: ', error);
            })
        } else {

            if(!formData.email.includes('@')){

                let errorExists = document.querySelector('.email_container .incorrect_text');

                if(!errorExists){

                    const errorText = document.createElement('p');
                    errorText.innerText = 'E-mail incorreto';

                    const email_container = document.querySelector('.email_container');

                    errorText.classList.add('incorrect_text');

                    email_container.appendChild(errorText);
                }
            } else {

                let errorExists = document.querySelector('.email_container .incorrect_text');

                if(errorExists){
                    errorExists.remove();
                }
            }

            if(!formData.password){

                let errorExists = document.querySelector('.password_container .incorrect_text');
                
                if(!errorExists){
                    
                    let errorText = document.createElement('p');

                    errorText.innerText = 'Senha incorreta';

                    errorText.classList.add('incorrect_text');

                    const password_container = document.querySelector('.password_container');

                    password_container.appendChild(errorText);
                } 
            } else {

                let errorExists = document.querySelector('.password_container .incorrect_text');

                if(errorExists){
                    errorExists.remove();
                }
            }
        }
    }
})