const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () =>{
        container.classList.add("active");
    });

loginBtn.addEventListener('click', () =>{
    container.classList.remove("active");
});

function validate(){
    let name = document.getElementById("name").value;
    let password = document.getElementById("password").value;
    let email= document.getElementById("email").value;

    let emailError = document.getElementById("email-error");


    if(name.length ==0){
        alert("Name cant be Empty!");
        return false;
    }
    if(password.length<6){
        alert("password must be 6 characters long!");
        return false;
    }
    if(email.length==0){
        emailError.textContent = "Please enter a valid email address.";
        return false;
    }

}