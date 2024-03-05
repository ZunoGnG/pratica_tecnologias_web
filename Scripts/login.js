let formLogin = document.getElementById("formLogin");
formLogin.addEventListener('submit',(e)=>{
    e.preventDefault();
    const form = new FormData(formLogin);
    if(checkInputs(formLogin)){
        loginRequest(form);
    }
})

function loginRequest(form){
    fetch('Class/Login.php',{
        method: "POST",
        body: form
    })
    .then(respos=>respos.json())
    .then(data=>{
        if(data === true){
            window.location.href = 'perfil.php';
        }
        else if(data === "notAccount"){
            errorAlert("A conta não existe ou a senha está incorreta");
        }
    })
    .catch(err=>console.log(err))
}

function checkInputs(form){
    if(form.email.value === "" || form.password.value === ""){
        if(form.email.value === "" && form.password.value === ""){
            errorAlert("Os campos de e-mail e senha estão vazios");
        }
        else if(form.email.value === ""){
            errorAlert("O campo de e-mail está vazio");
        }
        else if(form.password.value === ""){
            errorAlert("O campo de senha está vazio");
        }
        
        return false;
    }
    else{
        return true
    }
}

function errorAlert(message){
    let containerError = document.getElementById("containerError");
    let errorTittle = document.getElementById("errorTittle");
    let errorMessage = document.getElementById("errorMessage");

    containerError.style.display = 'flex';
    errorTittle.innerText = "Erro ao fazer login";
    errorMessage.innerText = `${message}`;

    let timeOut = setTimeout(takeOutAlert, 5000);
    function takeOutAlert(){
        containerError.style.display = 'none';
    } 
}