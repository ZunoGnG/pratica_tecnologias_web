document.addEventListener('DOMContentLoaded', ()=>{
    let textCurrentSituation = document.getElementById('textCurrentSituation');
    if(textCurrentSituation.textContent === 'Indisponível'){
        textCurrentSituation.style.color = 'red';
    }
    else if(textCurrentSituation.textContent === 'Disponível'){
        textCurrentSituation.style.color = 'green';
    }
    else if(textCurrentSituation.textContent){
        textCurrentSituation.style.color = 'black';
    }
})

function logout() {
    let data = {
        action: 'logout',
        confirmation: true
    };
    if (confirm("Deseja realmente sair?")) {
        fetch('Class/Logout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(respo => respo.json())
            .then(data => {
                if (data) {
                    window.location.href = "index.php";
                }
            })
            .catch(err => console.log(err))
    }
}

function showOptions(element, displayType) {
    let elementContainer = document.getElementById(`${element}`);
    if (displayType == '' || displayType == null) {
        displayType = 'block';
    }
    elementContainer.style.display = `${displayType}`;
}

/*Mudança de valores:*/

//adicionar uma confirmação nessas alteração com a mensagem "Você tem certeza que quer realizar esta alteração?" com 2 botões sim e não ****

function removeProductMessage() {
    let removeProductMessage = document.getElementById('removeProductMessage');
    removeProductMessage.style.display = 'block';

    let bodyContainer = document.getElementById('bodyContainer');
    bodyContainer.style.overflow = 'hidden';
}

function getIds() {
    const url = new URL(window.location.href)

    const params = new URLSearchParams(url.search);

    let ids = [params.get('productId'), params.get('userId')]
    return ids;
}

let imageSent = document.getElementById('changeFileInput');
imageSent.addEventListener('input', ()=>{
    let convertedImage = new Blob(imageSent.files, {type: "file/html"});
    let showImage = document.getElementById('newImageProduct');
    showImage.style.display = 'block';
    var reader = new FileReader();

    reader.onloadend = function () {
        showImage.src = reader.result;
    }

    if (imageSent) {
        reader.readAsDataURL(convertedImage);
      } else {
        preview.src = "";
    }
});

function changeProductImage(){
    let changeFileInput = document.getElementById('changeFileInput').files;
    let ids = getIds();
    if (changeFileInput.length < 1) {
        message('Insira uma imagem para continuar', 'alert', 'imageProductMessage');
    }
    else {
        let FileInput = document.getElementById('changeFileInput');
        let img = FileInput.files[0];
        let imgType = FileInput.files[0]['type'];
    
        let data = {
            process: 'changeImage',
            newImg: img,
            imageType: imgType,
            productId: ids[0],
            userId: ids[1]
        }
    
        function sendToDatabase(data){
            let form = new FormData();
        
            for (let key in data) {
                form.append(key, data[key]);
            }
        
            fetch('Class/Processes.php', {
                method: "POST",
                body: form
            })
            .then(respo => respo.json())
            .then(data => {
                message('Imagem alterada com sucesso', 'success', 'imageProductMessage');
    
                hideOptions('containerChangeImage');
                let timeout = setTimeout(reloadPage, 2000);
                function reloadPage() {
                    location.reload();
                }
            })
            .catch(err => console.log(err))
        }

        sendToDatabase(data);
    }
}


function changeName() {
    let nameChangedValue = document.getElementById('nameChangedValue').value;
    let ids = getIds();

    if (nameChangedValue == null || nameChangedValue == '') {
        message('Campo de mudança vazio!', 'alert', 'nameProductMessage');
    }
    else {

        let data = {
            process: 'changeName',
            newName: nameChangedValue,
            productId: ids[0],
            userId: ids[1]
        }

        fetch('Class/Processes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(respo => respo.json())
            .then(data => {
                if (data) {
                    message('Nome do produto alterado com sucesso', 'success', 'nameProductMessage');

                    hideOptions('containerChangeName');

                    let timeout = setTimeout(reloadPage, 2000);
                    function reloadPage() {
                        location.reload();
                    }
                }
            })
            .catch(err => console.log(err))
    }
}


let priceChangedValueInt = document.getElementById('priceChangedValueInt');
let priceChangedValueDec = document.getElementById('priceChangedValueDec');

priceChangedValueInt.addEventListener('keypress', (tecla) => {
    let keyPressed = tecla.key;

    if (!/[0-9]/.test(keyPressed)) {
        tecla.preventDefault();
        return;
    }
});

priceChangedValueDec.addEventListener('keypress', (tecla) => {
    let keyPressed = tecla.key;

    if (!/[0-9]/.test(keyPressed)) {
        tecla.preventDefault();
        return;
    }
});

function changePrice() {
    let ids = getIds();

    if (!priceChangedValueInt.value || !priceChangedValueDec.value) {
        message('Há campo(s) vazio(s)!', 'alert', 'priceProductMessage');
    }

    else {
        if (priceChangedValueDec.value.length < 2) {
            priceChangedValueDec.value = `${priceChangedValueDec.value}0`;
        }

        let price = `${priceChangedValueInt.value}.${priceChangedValueDec.value}`;

        let data = {
            process: 'changePrice',
            newPrice: price,
            productId: ids[0],
            userId: ids[1]
        }

        fetch('Class/Processes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(respo => respo.json())
            .then(data => {
                if (data) {
                    message('Preço do produto alterado com sucesso', 'success', 'priceProductMessage');

                    hideOptions('containerChangePrice');

                    let timeout = setTimeout(reloadPage, 2000);
                    function reloadPage() {
                        location.reload();
                    }
                }
            })
            .catch(err => console.log(err))
    }
}


let amountChangedValue = document.getElementById('amountChangedValue');
amountChangedValue.addEventListener('keypress', (tecla) => {
    let keyPressed = tecla.key;

    if (!/[0-9]/.test(keyPressed)) {
        tecla.preventDefault();
        return;
    }
});

function changeAmount() {
    if (!amountChangedValue.value) {
        message('Campo de mudança vazio!', 'alert', 'amountProductMessage');
    }
    else {
        if (amountChangedValue.value < 1){
            let ids = getIds();

            let data = {
                process: 'changeSituation',
                newSituation: 'Indisponível',
                productId: ids[0],
                userId: ids[1]
            }


            fetch('Class/Processes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(respo => respo.json())
                .then(data => {
                })
                .catch(err => console.log(err)) 
        }
/*
        //Muda a situação se a quantidade nova for maior que 0:

        else{
            let ids = getIds();

            let data = {
                process: 'changeSituation',
                newSituation: 'Disponível',
                productId: ids[0],
                userId: ids[1]
            }

            fetch('Class/Processes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(respo => respo.json())
                .then(data => {
                })
                .catch(err => console.log(err)) 
        }
*/
        let ids = getIds();

        let data = {
            process: 'changeAmount',
            newAmount: amountChangedValue.value,
            productId: ids[0],
            userId: ids[1]
        }

        fetch('Class/Processes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(respo => respo.json())
            .then(data => {
                if (data) {
                    message('Quantidade do produto alterada com sucesso', 'success', 'amountProductMessage');

                    hideOptions('containerChangeAmount');

                    let timeout = setTimeout(reloadPage, 2000);
                    function reloadPage() {
                        location.reload();
                    }
                }
            })
            .catch(err => console.log(err))
    }
}


function changeDesc() {
    let descChangedValue = document.getElementById('descChangedValue');
    if (!descChangedValue.value) {
        message('Campo de mudança vazio!', 'alert', 'descProductMessage');
    }

    else {
        let ids = getIds();

        let data = {
            process: 'changeDesc',
            newDesc: descChangedValue.value,
            productId: ids[0],
            userId: ids[1]
        }

        fetch('Class/Processes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(respo => respo.json())
            .then(data => {
                if (data) {
                    message('Descrição do produto alterada com sucesso', 'success', 'descProductMessage');

                    hideOptions('containerChangeDesc');

                    let timeout = setTimeout(reloadPage, 2000);
                    function reloadPage() {
                        location.reload();
                    }
                }
            })
            .catch(err => console.log(err))
    }
}


function changeSituation() {
    let currentySituation = document.getElementById('currentySituation');
    let amountText = document.getElementById('amountText');
    
    if(parseInt(amountText.textContent) < 1){
        message('Não é possível alterar a situação pois não há produtos em estoque!', 'error', 'messageCurrentySituation'); 
    }
    else{
        if (currentySituation.value == 0) {
            message('Escolha uma opção para continuar!', 'alert', 'messageCurrentySituation');
        }
    
        else {        
            if(currentySituation.value !== 'Indisponível' && currentySituation.value !== 'Disponível'){
                message('Houve um erro na seleção de opções! \nAtualize a página e tente novamente.', 'error', 'messageCurrentySituation');
            }
    
            else{
                let ids = getIds();
    
                let data = {
                    process: 'changeSituation',
                    newSituation: currentySituation.value,
                    productId: ids[0],
                    userId: ids[1]
                }
    
                fetch('Class/Processes.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(respo => respo.json())
                    .then(data => {
                        if (data) {
                            message('Mudança concluída com sucesso!', 'success', 'messageCurrentySituation');
    
                            hideOptions('containerChangeSituation');
    
                            let timeout = setTimeout(reloadPage, 2000);
                            function reloadPage() {
                                location.reload();
                            }
                        }
                    })
                    .catch(err => console.log(err)) 
            }
        }
    }
}

//----------------------------------------------------------------

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

function hideOptions(element) {
    let elementContainer = document.getElementById(`${element}`);
    elementContainer.style.display = 'none';
}

function showYesOptionMessage() {
    let removeContainer = document.getElementById('removeContainer');
    let containerRemovedMessage = document.getElementById('containerRemovedMessage');

    removeContainer.style.display = 'none';
    containerRemovedMessage.style.display = 'flex';

    deleteProduct();

    let timeout = setTimeout(goBackPerfil, 2000);
    function goBackPerfil() {
        window.location.href = 'perfil.php';
    }
}

function hideRemoveContainer() {
    let removeProductMessage = document.getElementById('removeProductMessage');
    let bodyContainer = document.getElementById('bodyContainer');

    removeProductMessage.style.display = 'none';
    bodyContainer.style.overflow = 'auto';
}

function deleteProduct(){
    let ids = getIds();
    let data = {
        process: 'deleteProduct',
        productId: ids[0],
        userId: ids[1]
    }

    fetch('Class/Processes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(respo => respo.json())
        .then(data => {
            console.log(data);
        })
        .catch(err => console.log(err)) 
}