<?php include 'inc/header.php'; ?>
  <main>
    <div class="banner">

      <div class="carousel-slide active">
        <img src="img/12.png" alt="">
      </div>
      
      <div class="carousel-slide">
        <img src="img/13.png" alt="">
      </div>
      
      <div class="carousel-slide">
        <img src="img/14.png" alt="">
      </div>

      <div class="carousel-slide">
        <img src="img/15.png" alt="">
      </div>
      
      <!-- Indicadores -->
      <div class="carousel-dots">
        <span class="dot active" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
      </div>
    </div>

    <!-- serviços -->
    <div class="servico">
      <div class="title">
        <h1>Uma curadoria de eventos feita por quem entende</h1>
      </div>
    <img src="img/Estrelinhas (Direita).svg" class="estrela2">
    <img src="img/Estrelinhas (Esquerda).svg" class="estrela1">
    
      <div class="servico-imagens">
        <div class="card-servico">
          <img src="img/Eventos 1.png" alt="Evento social">
          <h1>Eventos Sociais</h1>
          <h3>Aniversários, batizados, casamentos</h3>
        </div>
        <div class="card-servico">
          <img src="img/Eventos 2.png" alt="Evento corporativo">
          <h1>Eventos Corporativos</h1>
          <h3>Confraternizações, inaugurações, workshops</h3>
        </div>
      </div>
    </div>
    
    <img src="img/Borda Preta.svg" class="borda">

    <!-- como funciona -->
     <div class="funciona">
        <div class="column">
          <h1>Como funciona</h1>
          <h3>Na Redoma, unimos os melhores fornecedores de eventos em um só lugar.</h3>
          <h3>Nosso processo foi pensado para que você tenha segurança, qualidade e agilidade, sem precisar gastar tempo pesquisando ou correndo riscos</h3>
        </div>
        <div class="column">
          <div class="number"><h2>1</h2></div>
          <div class="topicos">
            <h4>Você nos conta sobre o seu evento</h4>
            <p>Preencha nosso formulário online com informações como tipo de evento, data, local e estilo desejado.</p>
          </div>
          <div class="number"><h2>2</h2></div>
          <div class="topicos">
            <h4>Nós fazemos a curadoria</h4>
            <p>Selecionamos fornecedores confiáveis e alinhados ao seu perfil, avaliando qualidade, preço e compatibilidade com o seu projeto.</p>
          </div>
          <div class="number"><h2>3</h2></div>
          <div class="topicos">
            <h4>Você recebe as melhores opções</h4>
            <p>Apresentamos um portfólio de fornecedores recomendados e seus contatos, para que você possa orçar.</p>
          </div>
          <div class="number"><h2>4</h2></div>
          <div class="topicos">
            <h4>Acompanhamos até a entrega</h4>
            <p>Após a sua escolha, seguimos monitorando prazos e alinhamentos até a entrega.</p>
          </div>
        </div>
     </div>

    <!-- filtro -->
    <div class="filtro">
      <p><b>Com a Redoma, você não precisa procurar:</b>  já filtramos para você o que há de melhor no mercado, garantindo que cada detalhe do seu evento seja impecável.</p>
      <img src="img/Eventos Vetor.svg">
    </div>
    <img src="img/Borda Vinho.svg" class="borda">

    <!-- matchmaker -->
    <div class="match">
      <div class="column">
      <h1>Matchmaker Redoma</h1>
      </div>
      <div class="column">
        <h3>Com a tecnologia da Redoma, conectamos você aos fornecedores ideais para o seu evento.</h3>
        <p>Conte-nos sobre a sua ocasião, suas preferências e prioridades — em poucos passos, você recebe uma lista personalizada com os parceiros mais indicados para tornar seu evento realidade.</p>
        <a href="formulario.php">Planejar meu evento</a>
      </div>
    </div>

    <!-- onde estamos -->
    <div class="onde" id="onde">
      <div class="column">
        <h1>Onde estamos</h1>
        <h3>A Redoma conecta fornecedores e clientes em diferentes regiões do Brasil.</h3>
        <p>Nosso atendimento é estruturado de forma regional, garantindo que cada evento seja planejado com profissionais próximos de você, que conhecem bem sua cidade e oferecem soluções sob medida para o seu caso.</p>
      </div>
      <div class="column">
        <img src="img/mapa.png">
      </div>
    </div>

    <!-- duvidas -->
     <div class="duvida">
        <h1>Dúvidas</h1>
        <div class="duvidas">
          <h3>Dúvida 1</h3>
          <p>Lorem ipsum dolor sit amet</p>
        </div>
        <div class="duvidas">
          <h3>Dúvida 2</h3>
          <p>Lorem ipsum dolor sit amet</p>
        </div>
        <div class="duvidas">
          <h3>Dúvida 3</h3>
          <p>Lorem ipsum dolor sit amet</p>
        </div>
     </div>

  <main>

  <script src="js/menu.js"></script>
  <script src="js/carousel.js"></script>

<?php include 'inc/footer.php'; ?>