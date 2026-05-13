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
    --cor-de-fundo-container-nav: #FCE7C870;
    --cor-fundo-navbar: #C9B59C;
    --cor-botoes-nav: #DCC5B2;
    --fonte-botoes-nav: "Chango, sans-serif";
    --cor-fonte-botoes-nav: black;
}

.navBarContainer {
    display: grid;
    grid-auto-flow: column;
    background-color: var(--cor-de-fundo-container-nav);
    gap:5em;
    max-width: max-content;
    min-width: 100%;
    min-height: 60px;
    justify-content: normal; /* space-around, strecth and normal*/
    
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

.contain, .configBtn {
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

.configBtn {
    width: fit-content;
    
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
      background: #dd7514;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }

.contain:hover, #topBtn:hover{
    background-color: #dea575;
    text-shadow: #fcfbfa;
}

.navBarContainer{
    position: fixed;
    
}

a:not(.contain) {
  
  margin-block: 1px;
  
}


 </style>

<div class="navBarContainer"><img src="favicon.ico">
    <div class="navBarSuperior">
        <a class="contain" href="index.php" >Home</a>
        <a class="contain" href="peixaria.php" >Peixaria</a>
        <a class="contain" href="filmesFavoritos.php" >Filmes</a>
    </div>
    <div class="configBarSuperior">
        <button class="configBtn" type="reset">Limpar campos</button>
        <button class="configBtn"onClick="#">Config.</button>
    </div>
</div>
<hr/>
<a id="topBtn" href="#" >Topo da Página</a>