document.getElementById('submit').addEventListener('click', async function(e) {
    e.preventDefault()

    await fetch(
        '/', {method:'post', body: new FormData(document.getElementById('form'))}
    ).then(
        async (data) => {
            document.getElementById('url').value = await data.text()
        }
    )

})