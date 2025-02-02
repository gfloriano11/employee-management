const picInput = document.querySelector('#picture_input');
const userPic = document.querySelector('#picture');
const image = document.querySelector('#user_pic');

userPic.addEventListener('click', () => {
    picInput.click();
});

picInput.addEventListener('change', (click) => {
    const file = click.target.files[0];

    if(file){
        const reader = new FileReader();

        reader.onload = (send_file) => {
            image.src = send_file.target.result;
        }

        reader.readAsDataURL(file);
    }

    console.log(file.name);
})