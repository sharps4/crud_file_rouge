const title = document.getElementById('title');
const maps = document.getElementById('maps');
const map = document.getElementById('map');

var selected = undefined;

class Stand {
    constructor(data) {
        this.data = data;
        this.element = document.createElement('button');
        this.element.innerHTML = data.name;
        this.element.style.position = 'absolute';
        map.append(this.element);
    }

    resize(width, height, cellSize) {
        this.element.style.left = cellSize*this.data.x;
        this.element.style.top = cellSize*this.data.y;
        this.element.style.right = width-cellSize*this.data.width;
        this.element.style.top = height-cellSize*this.data.height;
    }
}

class Map {
    constructor(data) {
        this.data = data;
        this.stands = [];
        this.element = document.createElement('div');
        this.element.innerHTML = `
            <button>${data.name}</button>
            <button>Supprimer</button>
        `;
        this.element.firstElementChild.addEventListener('click', this.select.bind(this));
        this.element.lastElementChild.addEventListener('click', this.delete.bind(this));
        maps.append(this.element);
    }

    delete() {
        deleteElement('Map', { name: this.data.name }, response => {
            if (response.success) {
                this.deselect();
                this.element.remove();
            }
            else popupError('Impossible de supprimer la carte');
        });
    }

    select() {
        if (selected) selected.deselect();
        getElement('Stands', { map: this.data.name }, response => {
            if (response.success) {
                selected = this;
                title.innerHTML = this.data.name;
                for (const e of response.data) this.stands.push(new Stand(e));
                map.addEventListener('resize', this.resize.bind(this));
            }
        });
    }

    deselect() {
        if (selected === this) {
            selected = undefined;
            title.innerHTML = '';
            for (const stand of this.stands) stand.delete();
            this.stands = [];
        }
    }

    resize(event) {
        let width = 0;
        let height = 0;
        for (const stand of this.stands) {
            width = Math.max(width, stand.data.x+stand.data.width);
            height = Math.max(height, stand.data.y+stand.data.height);
        }
        let rect = map.getBoundingClientRect();
        let cellSize = Math.min(rect.width/width, rect.height/height);
        for (const stand of this.stands) stand.resize(rect.width, rect.height, cellSize);
    }
}



// var selectedMap = null;



// const standForm = document.getElementById('stand-form');

// function addStandButton(data) {
//     const element = document.createElement('button');
//     element.style.position = 'absolute';
//     element.style.left = e.x;
//     map.append(element);
// }

// function addMapButton(name) {
//     const title = document.getElementById('title');
//     const element = document.createElement('div');
//     element.innerHTML = `
//         <button>${name}</button>
//         <button>Supprimer</button>
//     `;
//     element.firstElementChild.addEventListener('click', () => {
//         const map = document.getElementById('map');
//         map.innerHTML = '';
//         selectedMap = name;
//         title.innerHTML = name;
//         getElement('Stands', { map: name }, response => {
//             if (response.success) {
//                 for (const e of response.data) addStandButton(e);
//             }
//         });
//     });
//     element.lastElementChild.addEventListener('click', () => {
//         if (selectedMap === name)
//         {
//             selectedMap = null;
//             title.innerHTML = '';
//         }
//         deleteElement('Map', { name }, response => {
//             if (response.success) element.remove();
//             else popupError('Impossible de supprimer la carte');
//         });
//     });
//     document.getElementById('maps').append(element);
// }

document.getElementById('create-map-form').onsubmit = event => {
    event.preventDefault();
    const name = new FormData(event.target).get('name');
    createElement('Map', name ? { name } : {}, response => {
        if (response.success) new Map(response.data);
        else popupError('Impossible de créer la carte');
    });
}

// function standsCallback(response)
// {
//     if (response.success)
//     {}
// }

getElement('Maps', {}, response => {
    if (response.success) {
        for (const e of response.data) new Map(e);
    }
});

// createElement('Map', { name: 'Rez-de-chaussée' });
// createElement('Map', { name: '1er étage' });
// createElement('Map', { name: '2e étage' });