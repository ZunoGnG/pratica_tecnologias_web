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


function showProductInfo(idProduto, idCliente) {
    window.location.href = `produtoInfo.php?userId=${idCliente}&productId=${idProduto}`;
}