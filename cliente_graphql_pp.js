function getQueryString() {
    // Obtiene los elementos del HTML (URL, respuesta, query y variables)
    const url = document.getElementById('url').value;
    const resp = document.getElementById('resp');
    const query = document.getElementById('send').value;
    const vars = document.getElementById('vars').value;

    // Envía la petición al servidor usando fetch()
    fetch(url, {
        method: 'POST', // Siempre POST en GraphQL
        headers: {
            'Content-Type': 'application/json', // Cuerpo en formato JSON
        },
        body: JSON.stringify({ query, vars }) // Convierte los datos a JSON
    })
    // Espera la respuesta del servidor y la convierte a JSON
    .then(result => result.json())
    .then(json => {
        // Muestra el resultado en el textarea “respuesta”
        resp.value = JSON.stringify(json, null, ' ');
    })
    // Si hay errores (por ejemplo, servidor caído), los muestra también
    .catch(error => {
        resp.value = error.stack;
    });
}
