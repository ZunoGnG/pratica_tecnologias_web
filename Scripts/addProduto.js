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

let priceValueInt = document.getElementById('priceValueInt');
priceValueInt.addEventListener('keypress', (tecla) => {
    let keyPressed = tecla.key;

    if (!/[0-9]/.test(keyPressed)) {
        tecla.preventDefault();
        return;
    }
});

let priceValueDec = document.getElementById('priceValueDec');
priceValueDec.addEventListener('keypress', (tecla) => {
    let keyPressed = tecla.key;

    if (!/[0-9]/.test(keyPressed)) {
        tecla.preventDefault();
        return;
    }
});

let amountValue = document.getElementById('amountValue');
amountValue.addEventListener('keypress', (tecla) => {
    let keyPressed = tecla.key;

    if (!/[0-9]/.test(keyPressed)) {
        tecla.preventDefault();
        return;
    }
});


let formattedPrice = document.getElementById('formattedPrice');
priceValueInt.addEventListener('input', () => {
    if (!priceValueDec.value) {
        priceValueDec.value = '00';
    }
    formattedPrice.innerText = `${priceValueInt.value},${priceValueDec.value}`;
});
priceValueDec.addEventListener('input', () => {
    if (!priceValueInt.value) {
        priceValueInt.value = '0';
    }
    formattedPrice.innerText = `${priceValueInt.value},${priceValueDec.value}`;
});


let imageSent = document.getElementById('FileInput');
imageSent.addEventListener('input', ()=>{
    let convertedImage = new Blob(imageSent.files, {type: "file/html"});
    let showImage = document.getElementById('showImage');
    var reader  = new FileReader();

    reader.onloadend = function () {
        showImage.src = reader.result;
    }

    if (imageSent) {
        reader.readAsDataURL(convertedImage);
      } else {
        preview.src = "";
    }
});

function addProduct() {
    let FileInput = document.getElementById('FileInput');
    let nameInput = document.getElementById('nameValue');
    let priceInputInt = document.getElementById("priceValueInt");
    let priceInputDec = document.getElementById("priceValueDec");
    let descInput = document.getElementById("descValue");
    let amountInput = document.getElementById("amountValue");

    let totalPrice = `${priceInputInt.value}.${priceInputDec.value}`;
    
    if (!priceInputDec.value) {
        priceInputDec.value = '00';
    }

    else if (priceInputDec.value.length == 1) {
        priceInputDec.value = `${priceInputDec.value}0`;
    }

    if (!nameInput.value || !priceInputInt.value || !descInput.value || !amountInput.value) {
        message('Há campos vazios', 'alert', 'addMessage')
    }
    else if(FileInput.files.length < 1){
        message('Nenhuma imagem foi adicionada!', 'alert', 'addMessage')
    }
    
    else{
        let img = FileInput.files[0];
        let imgType = FileInput.files[0]['type'];

        let data = {
            name: nameInput.value,
            price: totalPrice,
            desc: descInput.value,
            amount: amountInput.value,
            image: img,
            imageType: imgType
        }

        addProductMessage();
        sendToDatabase(data);
    }
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

function addProductMessage(){
    let addProductMessage = document.getElementById('addProductMessage');
    addProductMessage.style.display = 'block';

    let bodyContainer = document.getElementById('bodyContainer');
    bodyContainer.style.overflow = 'hidden';

    let goPerfilLink = document.getElementById('goPerfilLink');
    goPerfilLink.style.display = 'none';
}

function showYesOptionMessage(){
    let addContainer = document.getElementById('addContainer');
    let containerAddMessage = document.getElementById('containerAddMessage');

    addContainer.style.display = 'none';
    containerAddMessage.style.display = 'flex';

    let timeout = setTimeout(goBackPerfil ,2000);
    function goBackPerfil(){
        window.location.href = 'perfil.php';
    }
}

function hideAddContainer(){
    let addProductMessage = document.getElementById('addProductMessage');
    let bodyContainer = document.getElementById('bodyContainer');

    let goPerfilLink = document.getElementById('goPerfilLink');
    goPerfilLink.style.display = 'block';

    addProductMessage.style.display = 'none';
    bodyContainer.style.overflow = 'auto';
}

function sendToDatabase(data){
    let form = new FormData();

    for (let key in data) {
        form.append(key, data[key]);
    }

    fetch('Class/AddProduto.php', {
        method: "POST",
        body: form
    })
    .then(respo => respo.json())
    .then(data => {
    })
    .catch(err => console.log(err))
}