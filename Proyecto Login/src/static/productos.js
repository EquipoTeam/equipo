document.addEventListener('DOMContentLoaded', function() {
    // Hacer una solicitud AJAX a la ruta /productos para obtener los datos
    fetch('/productos')
        .then(response => response.json())
        .then(data => {
            const productosContainer = document.getElementById('productos-container');
            productosContainer.innerHTML = ''; // Limpiar cualquier contenido existente

            // Procesar cada producto y agregarlo al DOM
            data.forEach(producto => {
                const productCard = `
                    <div class="card-product">
                        <div class="container-img">
                            <img src="../static/img/${producto.imagen}" alt="${producto.nombre}" class="width" />
                            <span class="discount">-${producto.descuento}%</span>
                            <div class="button-group">
                                <span><i class="bi bi-eye"></i></span>
                                <span><i class="bi bi-heart"></i></span>
                                <span><i class="bi bi-rocket-takeoff"></i></span>
                            </div>
                        </div>
                        <div class="content-card-product">
                            <div class="stars">
                                ${renderStars(producto.estrellas)}
                            </div>
                            <h3>${producto.nombre}</h3>
                            <span class="add-cart"><i class="bi bi-basket"></i></span>
                            <a href="http://localhost/proyecto/src/vendor/mercadopago.php" class="btn btn-danger rounded-pill px-3" role="button">Comprar ahora</a>
                            <p class="price">$${producto.precio} <span>$${producto.precio * (1 - producto.descuento / 100)}</span></p>
                        </div>
                    </div>
                `;
                productosContainer.innerHTML += productCard;
            });
        })
        .catch(error => console.error('Error al obtener los productos:', error));
});

function renderStars(estrellas) {
    let starHTML = '';
    for (let i = 0; i < 5; i++) {
        if (i < estrellas) {
            starHTML += '<i class="bi bi-star-fill"></i>';
        } else {
            starHTML += '<i class="bi bi-star"></i>';
        }
    }
    return starHTML;
}
