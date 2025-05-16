<section class="row">
    <div class="column flex-3">
        <div id="maps" class="expand column"></div>
        <form id="create-map-form" method="POST" action="/createMap">
            <input name="name" type="text">
            <input type="submit" value="Créer la carte">
        </form>
    </div>
    <div class="column flex-6">
        <h1 id="title"></h1>
        <div id="map"></div>
    </div>
    <div class="column flex-3">
        <form id="stand-form" class="column" method="POST">
            <label for="name">Nom</label>
            <input id="name" type="text">
            <label for="x">X</label>
            <input id="x" type="number">
            <label for="y">Y</label>
            <input id="y" type="number">
            <label for="width">Largeur</label>
            <input id="width" type="number">
            <label for="height">Hauteur</label>
            <input id="height" type="number">
        </form>
        <div>
            <button>Supprimer</button>
        </div>
    </div>
</section>