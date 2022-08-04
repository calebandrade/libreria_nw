    <main >
        <section class="contenedor sobre-nosotros">
            <h2 class="titulo">Nuestras Promociones</h2>
            <div class="contenedor-sobre-nosotros">
                <img src="public/imgs/librerias.jpeg" alt="" class="imagen-about-us">
                <div class="contenido-textos" style="width:48%">
                    <h3><span>1</span>Libros a 50% </h3>
                    <p>Amplia variedad de libros de todos los generos a un 50 % de descuento.</p>
                    <h3><span>2</span>Descuentos a Clientes frecuentes </h3>
                    <p>Nuestros clientes frecuentes en nuestra libreria gozan de muy buenos descuentos ala hora de su compra.</p>
                </div>
            </div>
        </section>
        <section class="portafolio">
            <div class="contenedor">
                <h2 class="titulo">Nuestro Libros</h2>
                <div class="galeria-port">
                    <div class="imagen-port">
                        <img src="public/imgs/img1.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/img2.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/principito.jpeg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/img6.jpeg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/romeoyjulieta.jpeg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/img5.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/img3.jfif" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="public/imgs/piter.jpeg" alt="">
                        <div class="hover-galeria">
                            <img src="public/imgs/icono1.png" alt="">
                            <p style="color:#fff">Libro</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="clientes contenedor">
            <h2 class="titulo">Que dicen nuestros clientes</h2>
            <div class="cards">
                <div class="card">
                    <img src="public/imgs/face1.jpg" alt="">
                    <div class="contenido-texto-card">
                        <h4>Elizabeth</h4>
                        <p>Mejores precio, mejor atencion.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="public/imgs/face2.jpg" alt="">
                    <div class="contenido-texto-card">
                        <h4>Celeste</h4>
                        <p>Es una Libreria con mejor atencion al cliente muy vistosa, se tiene una agradable experiencia.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-services">
            <div class="contenedor">
                <h2 class="titulo">Libro mas vendido</h2>
                <div class="servicio-cont">
                    <div class="servicio-ind">
                        <img src="public/imgs/Dracula.jpeg" alt="">
                        <h3 style="margin:10px;"> Dracula</h3>
                    </div>
                    <div class="servicio-ind">
                        <img src="public/imgs/anillos.jpeg" alt="">
                        <h3 style="margin:10px;">El Señor de los anillos</h3>
                    </div>
                    <div class="servicio-ind">
                        <img src="public/imgs/muj.jpeg" alt="">
                        <h3 style="margin:10px;">Aquellas Mujercitas</h3>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'open sans';
}

.contenedor {
    padding: 60px 0;
    width: 90%;
    max-width: 1000px;
    margin: auto;
    overflow: hidden;
}

.titulo {
    color: #642a73;
    font-size: 30px;
    text-align: center;
    margin-bottom: 60px;
}

/* About us */

main .sobre-nosotros{
    padding: 30px 0 60px 0;
}
.contenedor-sobre-nosotros{
    display: flex;
    justify-content: space-evenly;
}

.imagen-about-us{
    width: 48%;
}

.sobre-nosotros .contenido-textos{
    width: 48%;
}

.contenido-textos h3{
    margin-bottom: 15px;
}

.contenido-textos h3 span{
    background: #4d0686;
    color: #fff;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    width: 30px;
    height: 30px;
    padding: 2px;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, .5);
    margin-right: 5px;
}

.contenido-textos p{
    padding: 0px 0px 30px 15px;
    font-weight: 300;
    text-align: justify;
}

/* Galeria */


.portafolio{
    background: #f2f2f2;
}

.galeria-port{
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
}

.imagen-port{
    width: 24%;
    margin-bottom: 10px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, .5);
}

.imagen-port > img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.hover-galeria{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    transform: scale(0);
    background: hsla(273,91%,27%, 0.7);
    transition: transform .5s;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.hover-galeria img{
    width: 50px;
}

.hover-galeria p{
    color: #fff;
}

.imagen-port:hover .hover-galeria{
    transform: scale(1);
}

/* Clients */

.cards{
    display: flex;
    justify-content: space-evenly;
}

.cards .card{
    background: #4d0686;
    display: flex;
    width: 46%;
    height: 200px;
    align-items: center;
    justify-content: space-evenly;
    border-radius: 5px;
    box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.6);
}

.cards .card img{
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 3px solid #fff;
    border-radius: 50%;
    display: block;
}

.cards .card > .contenido-texto-card{
    width: 60%;
    color: #fff;
}

.cards .card > .contenido-texto-card p{
    font-weight: 300;
    padding-top: 5px;
}

/*  Our team */

.about-services{
    background: #f2f2f2;
    padding-bottom: 30px;
}


.servicio-cont{
    display:flex;
    justify-content: space-between;
    align-items: center;
}

.servicio-ind{
    width: 28%;
    text-align: center;
}

.servicio-ind img{
    width: 90%;
}

.servicio-ind h3{
    margin: 10px 0;
}

.servicio-ind p{
    font-weight: 300;
    text-align: justify;
}

/* footer */

footer{
    background: #414141;
    padding: 60px 0 30px 0;
    margin: auto;
    overflow: hidden;
}

.contenedor-footer{
    display: flex;
    width: 90%;
    justify-content: space-evenly;
    margin: auto;
    padding-bottom: 50px;
    border-bottom: 1px solid #ccc;
}

.content-foo{
    text-align: center;
}

.content-foo h4{
    color: #fff;
    border-bottom: 3px solid #af20d3;
    padding-bottom: 5px;
    margin-bottom: 10px;
}

.content-foo p{
    color: #ccc;
}

.titulo-final{
    text-align: center;
    font-size: 24px;
    margin: 20px 0 0 0;
    color: #9e9797;
}

@media screen and (max-width:900px){
    header{
        background-position: center;
    }

    .contenedor-sobre-nosotros{
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .sobre-nosotros .contenido-textos{
        width: 90%;
    }

    .imagen-about-us{
        width: 90%;
    }

    /* Galeria */

    .imagen-port{
        width: 44%;
    }

    /* Clientes */

    .cards{
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .cards .card{
        width: 90%;
    }

    .cards .card:first-child{
        margin-bottom: 30px;
    }

    /* servicios */

    .servicio-cont{
        justify-content: center;
        flex-direction: column;
    }

    .servicio-ind{
        width: 100%;
        text-align: center;
    }

    .servicio-ind:nth-child(1), .servicio-ind:nth-child(2){
        margin-bottom: 60px;
    }

    .servicio-ind img{
        width: 90%;
    }
}

@media screen and (max-width:500px){
    nav{
        text-align: center;
        padding: 30px 0 0 0;
    }

    nav > a{
        margin-right: 5px;
    }

    .textos-header h1{
        font-size: 35px;
    }

    .textos-header h2{
        font-size: 20px;
    }

    /* ABOUT US */

    .imagen-about-us{
        margin-bottom: 60px;
        width: 99%;
    }

    .sobre-nosotros .contenido-textos{
        width: 95%;
    }

    /* Galeria */

    .imagen-port{
        width: 95%;
    }

    /* Clients */

    .cards .card{
        height: 450px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .cards .card img{
        width: 90px;
        height: 90px;
    }

}
</style>