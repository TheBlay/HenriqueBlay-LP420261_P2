<head>
<link rel="stylesheet" href="style.css">

</head>
<script>localStorage.clear();

const topBtn = document.getElementById('topBtn');

    window.addEventListener("scroll", () => {
        if (document.documentElement.scrollTop > 100) {
            topBtn.style.display = "block";
        } else {
            topBtn.style.display = "none";
        }
        });

    topBtn.addEventListener("click", () => {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
      });
    });

</script>
<style>
:root {
    --cor-de-fundo-container-nav: var(--cor-de-fundo);
    --cor-fundo-navbar: var(--color-500);
    --cor-botoes-nav: var(--color-400);
    --fonte-botoes-nav: "Chango, sans-serif";
    --cor-fonte-botoes-nav: black;
}
/* a barra de navegação que fica no topo de todas as páginas */
.navBarContainer {
    display: grid;
    grid-auto-flow: column;
    background-color: var(--cor-de-fundo-container-nav);
    gap:5em;
    max-width: max-content;
    min-width: 100%;
    min-height: 60px;
    justify-content: stretch; /* bons: space-around, stretch e normal*/
    
}

.navBarSuperior, .configBarSuperior {
    max-width: 100dvh;
    min-width: 50pc;
    flex-wrap: wrap;
    height: 60px;
    border-radius:10px;
    font-family: var(--fonte-botoes-nav);
    background-color: var(--cor-fundo-navbar, #D2C4B4);
    justify-content: space-around;
    align-content: space-around;
    display: flex;
    gap: 5.5em;
    
}

.configBarSuperior {
min-width: max-content;
display: inline-block;
max-width: 30%;
}

.contain {
    border: 2px solid black;
    flex-wrap: wrap;
    text-decoration: none;
    font-size: 1.7em;
    height: 70%;
    width: 14%;
    color: var(--cor-fonte-botoes-nav, black);
    background-color: var(--cor-botoes-nav);
    border-radius: 15px;
    justify-content: space-around;
    align-content: space-evenly;
    display: inline-flex;
}

img {
  border-radius: 5px;
  width: 60px;
  height: 60px;
}

#topBtn {
      position: fixed;
      bottom: 15px;
      right: 15px;
      display: block;
      padding: 10px 15px;
      background: var(--cor-paleta2-4);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }

.contain:hover, #topBtn:hover{
    background-color: var(--color-300);
    text-shadow: var(--color-100);
}

.navBarContainer{
    position: fixed;
}

a:not(.contain) {
  margin-block: 1px;
  
}


 </style>

<div class="navBarContainer"><img src="favicon.png">
    <div class="navBarSuperior">
        <a class="contain" href="index.php" >Home</a>
        <a class="contain" href="peixaria.php" >Peixaria</a>
        <a class="contain" href="filmesFavoritos.php" >Filmes</a>
    </div>
</div>
<hr/>
<a id="topBtn" href="#" >Topo da Página</a>