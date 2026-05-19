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
    --cor-botoes-nav: var(--color-300);
    --fonte-botoes-nav: "Chango, sans-serif";
    --cor-fonte-botoes-nav: black;
}
/* a barra de navegação que fica no topo de todas as páginas */
.navBarContainer {
    display: grid;
    grid-auto-flow: column;
    background-color: var(--cor-de-fundo-container-nav.5);
    gap:5em;
    max-width: max-content;
    min-width: 100%;
    min-height: 1.6em;
    justify-content: stretch; /* bons: space-around, stretch e normal*/
    
}

.navBarSuperior {
    max-width: 100dvw;
    min-width: 50dvw;
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



.contain { /* a classe contain é basicamente os botões de navegação da barra. e.g. "Publicações" */
    border: 2px solid black;
    flex-wrap: wrap;
    text-decoration: none;
    font-size: 1.7em;
    height: 70%;
    width: 16vw;
    min-width: fit-content;
    color: var(--cor-fonte-botoes-nav, black);
    background-color: var(--cor-botoes-nav);
    border-radius: 15px;
    justify-content: space-around;
    align-content: space-evenly;
    display: inline-flex;
    padding-inline: 0.3em;
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
    background-color: var(--color-200);
    text-shadow: var(--color-100);
    color: var(--cor-fonte-claro)
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
        <a class="contain" href="index.php" >Principal</a>
        <a class="contain" href="publicacoes.php" >Gerir Publicações</a>
        <a class="contain" href="divulgacoes.php" >Gerir Divulgações</a>
    </div>
</div>
<hr/>
<a id="topBtn" href="#" >Topo da Página</a>