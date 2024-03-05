function logout(){
    confirmMessage("Deseja realmente sair?").then((confirmed) => {
        if (confirmed) {
            let data = {
                action: 'logout',
                confirmation: true
            };
            fetch('Class/Logout.php',{
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(respo=>respo.json())
            .then(data =>{
                if(data){
                    window.location.href = "index.php";
                }
            })
            .catch(err=>console.log(err))
        }
    });
}

function changeName(){
    let newUserName = document.getElementById('newName');

    if(newUserName.value == ''){
        message('Campo de alteração vazio!', 'alert', 'updateNameMessage'); 
    }
    else{
        let data = {
            infoUpdate: 'name',
            newName: newUserName.value
        }
    
        fetch('Class/UpdateInfos.php', {
            method: 'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(repos => repos.json())
        .then(data =>{
            message('Nome alterado com sucesso', 'success', 'updateNameMessage');
            hideOptions('updateNameValues');
            
            let timeout = setTimeout(reloadPage, 2000);
            function reloadPage() {
                location.reload();
            } 
        })
        .catch(err=>console.log(err))
    }
}

let viewImage = document.getElementById('newImageInput');
viewImage.addEventListener('input', ()=>{
    let convertedImage = new Blob(viewImage.files, {type: "file/html"});
    let showImage = document.getElementById('newImage');
    var reader  = new FileReader();

    showImage.style.display = 'block';

    reader.onloadend = function () {
        showImage.src = reader.result;
    }

    if (viewImage) {
        reader.readAsDataURL(convertedImage);
      } else {
        preview.src = "";
    }
});

function changeImage(){
    let newImageInput = document.getElementById('newImageInput');

    if(!newImageInput.files[0]){
        message('Nenhuma imagem foi selecionada!', 'alert', 'updateImageMessage');
    }
    else{
        let data = {
            infoUpdate: 'image',
            newImg: newImageInput.files[0],
            imgType: newImageInput.files[0]['type']
        }
    
        let form = new FormData();

        for (let key in data) {
            form.append(key, data[key]);
        }

        fetch('Class/UpdateInfos.php', {
            method: 'POST',
            body: form
        })
        .then(repos => repos.json())
        .then(data =>{
            message('Imagem alterada com sucesso', 'success', 'updateImageMessage');
            hideOptions('updateImageValues');
            
            let timeout = setTimeout(reloadPage, 2000);
            function reloadPage() {
                location.reload();
            } 
        })
        .catch(err=>console.log(err))
    }
}

function changePassword(){
    let newPass= document.getElementById('newPassword');
    let newPasswordConfirm = document.getElementById('newPasswordConfirm');

    if(newPass.value == '' || newPasswordConfirm.value == ''){
        message('Campo(s) de alteração vazio(s)', 'alert', 'updatePasswordMessage');
    }
    else if(newPass.value !== newPasswordConfirm.value){
        message('As senhas informadas não são iguais!', 'alert', 'updatePasswordMessage');
    }
    else{
        let data = {
            infoUpdate: 'password',
            newPassword: newPass.value
        }
    
        fetch('Class/UpdateInfos.php', {
            method: 'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(repos => repos.json())
        .then(data =>{
            message('Senha alterada com sucesso', 'success', 'updatePasswordMessage');
            hideOptions('updatePasswordValues');
            
            let timeout = setTimeout(reloadPage, 2000);
            function reloadPage() {
                location.reload();
            } 
        })
        .catch(err=>console.log(err))
    }
}

function deleteAccount(){
    confirmMessage("Você tem certeza que deseja fazer isso?").then((confirmed) => {
        if (confirmed) {
            let data = {
                infoUpdate: 'deleteAccount',
            }
        
            fetch('Class/UpdateInfos.php', {
                method: 'POST',
                headers:{
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(repos => repos.json())
            .then(data =>{  
                if(data){
                    let containerDeleteMessage = document.getElementById('containerDeleteMessage')
                    containerDeleteMessage.style.display = 'block';
                }
            })
            .catch(err=>console.log(err))  
        }
    });
}


function showOptions(element, displayType) {
    let elementContainer = document.getElementById(`${element}`);
    if (displayType == '' || displayType == null) {
        displayType = 'block';
    }
    elementContainer.style.display = `${displayType}`;
}

function hideOptions(element) {
    let elementContainer = document.getElementById(`${element}`);
    elementContainer.style.display = 'none';
}

function message(message, type, element) {
    let color = '';
    switch (type) {
        case 'error':
            color = 'red';
            break;

        case 'alert':
            color = '#d16c00';
            break;

        case 'success':
            color = 'green';
            break;

        default:
            color = 'black';
            break;
    }

    let elementContainer = document.getElementById(`${element}`);
    elementContainer.style.display = 'block';
    elementContainer.style.color = `${color}`;
    elementContainer.innerText = `${message}`;

    let timeout = setTimeout(hideMessage, 3000);
    function hideMessage() {
        elementContainer.style.display = 'none';
    }
}

function confirmMessage(message){
    return new Promise((resolve, reject) => {

        let body = document.getElementById('body');
        let confirmMessagePage = document.getElementById('confirmMessagePage');
        let confirmMessage = document.getElementById('confirmMessage');
        let yesButton = document.getElementById('yesButton');
        let notButton = document.getElementById('notButton'); 

        let goPerfilLink = document.getElementById('goPerfilLink');
        goPerfilLink.style.display = 'none';
    

        confirmMessagePage.style.display = 'block';

        body.style.overflow = 'hidden';
        confirmMessage.innerText = `${message}`;

        yesButton.addEventListener('click', ()=>{
            resolve(true);
        });

        notButton.addEventListener('click', ()=>{
            confirmMessagePage.style.display = 'none';
            body.style.overflow = 'auto';

            let goPerfilLink = document.getElementById('goPerfilLink');
            goPerfilLink.style.display = 'block';
        
            resolve(false);
        });
    });
}

function logoutDeleteAc(){
    let data = {
        action: 'logout',
        confirmation: true
    };
    fetch('Class/Logout.php',{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(respo=>respo.json())
    .then(data =>{
        window.location.href = "index.php"; 
    })
    .catch(err=>console.log(err))
}