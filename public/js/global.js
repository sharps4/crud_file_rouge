function executePostAction(uri, data = {}, callback = null) {
    const request = new XMLHttpRequest();
    request.open('POST', uri, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    if (callback) {
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) callback(JSON.parse(request.responseText));
        }
    }
    request.send(Object.entries(data).map(e => `${e[0]}=${e[1]}`).join('&'));
}

function createElement(element, data = {}, callback = null) {
    executePostAction(`create${element}`, data, callback);
}

function deleteElement(element, data = {}, callback = null) {
    executePostAction(`delete${element}`, data, callback);
}

function getElement(element, data = {}, callback = null) {
    executePostAction(`get${element}`, data, callback);
}

function popupError(message) {
    const element = document.createElement('div');
    element.className = 'popup column center';
    element.innerHTML = `
        <div>
            <p>Erreur</p>
            <p>${message}</p>
            <button>Ok</button>
        </div>
    `;
    element.lastElementChild.lastElementChild.addEventListener('click', () => element.remove());
    document.body.append(element);
}