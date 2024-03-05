let formCadastro = document.getElementById("formCadastro");
formCadastro.addEventListener('submit',(e)=>{
    e.preventDefault();
    
    const form = new FormData(formCadastro);

    if(checkInputs(formCadastro)){
        sendInfoPHP(form);
    }
})

function checkInputs(data){

    if(data.user.value === "" || data.email.value === "" || data.password.value === ""){
        if(!data.user.value && !data.email.value && !data.password.value){
            errorAlert("Todos os campos estão vazios!");
        }
 
        else if(!data.user.value && !data.email.value){
            errorAlert("Os campos de usuario e email estão vazios!");
        }
        
        else if(!data.email.value && !data.password.value){
            errorAlert("Os campos de email e senha estão vazios!");
        }
        
        else if(!data.user.value && !data.password.value){
            errorAlert("Os campos de usuário e senha estão vazios!");
        }
        
        else if(!data.user.value){
            errorAlert("O campo de usuário está vazio");
        }

        else if(!data.email.value){
            errorAlert("O campo de e-mail está vazio");
        }

        else if(!data.password.value){
            errorAlert("O campo de senha está vazio");
        }

        return false
    }

    else{
        return true;
    }
}

function sendInfoPHP(form){
    fetch('Class/Cadastro.php', {
        method: "POST",
        body: form
    })
    .then(resposta => resposta.json())
    .then(data => {
        if(data === true){
            registerAlert();

            let timeOut = setTimeout(goHome, 1800);
            function goHome(){
                window.location.href = 'index.php';
            }
        }
        else{
            errorAlert("E-mail já cadastrado, tente com outro e-mail!");
        }
    })
    .catch(err => console.log(err))
}

function registerAlert(){
    let containerVerify = document.getElementById('containerVerify');
    let formRegister = document.getElementById('formCadastro');
    let tittleMain = document.getElementById('tittleMain');

    tittleMain.style.display = 'none';
    formRegister.style.display = 'none';
    containerVerify.style.display = 'block';
}

function errorAlert(message){
    let containerError = document.getElementById("containerError");
    let errorTittle = document.getElementById("errorTittle");
    let errorMessage = document.getElementById("errorMessage");

    containerError.style.display = 'flex';
    errorTittle.innerText = "Erro ao finalizar o cadastro";
    errorMessage.innerText = `${message}`;

    let timeOut = setTimeout(takeOutAlert, 5000);
    function takeOutAlert(){
        containerError.style.display = 'none';
    } 
}