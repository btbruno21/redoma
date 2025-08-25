<?php include 'inc/header.php'; ?>
<section id="nivel-planejamento" class="ativa">
    <div class="orcamento">
        <h1>Faça seu evento com nossos especialistas</h1>
        <p>Compartilhe suas preferências e encontraremos um especialista regional que sabe tudo sobre seu destino para ajudar você a planejar seu evento.</p>
        <h5>Em que estágio de planejamento você está?</h5>
        <div class="opcoes-botoes">
            <input type="radio" id="evento1" name="nivel-planejamento" value="Claro e definido">
            <label for="evento1">Claro e definido</label>

            <input type="radio" id="evento2" name="nivel-planejamento" value="Explorando possibilidades">
            <label for="evento2">Explorando possibilidades</label>

            <input type="radio" id="evento3" name="nivel-planejamento" value="Algumas ideias">
            <label for="evento3">Algumas ideias</label>
        </div>
        <nav class="button">
            <button onclick="mostrar('dados-pessoais')">Próximo</button>
        </nav>
    </div>
</section>

<section id="dados-pessoais">
    <div class="orcamento">
        <h1>Dados Cadastrais</h1>
        <form method="POST" action="formularioSubmit.php">
            <div class="input-container">
                <input type="text" id="nome" name="nome" placeholder=" " required>
                <label for="nome" class="input-label">Nome Completo</label>
            </div>
            <div class="input-container">
                <input type="text" id="telefone" name="telefone" placeholder=" " required>
                <label for="telefone" class="input-label">Whatsapp</label>
            </div>
            <div class="input-container">
                <input type="mail" id="email" name="email" placeholder=" " required>
                <label for="email" class="input-label">Email</label>
            </div>

            <nav class="button">
                <button onclick="mostrar('nivel-planejamento')">Anterior</button>
                <button onclick="mostrar('tipo-evento')">Próximo</button>
                <!-- <button type="submit">Enviar Teste</button> -->
            </nav>
        </form>
    </div>
</section>

<section id="tipo-evento">
    <div class="orcamento">
        <h1>Tipo de Evento</h1>
        <div class="opcoes-botoes">
            <!-- Radios principais -->
            <input type="radio" id="op1" name="tipo-evento" value="sociais" data-target="campos-sociais">
            <label for="op1">Eventos Sociais</label>

            <input type="radio" id="op2" name="tipo-evento" value="corporativos" data-target="campos-corporativos">
            <label for="op2">Eventos Corporativos</label>
        </div>

        <!-- Radios filhos de Sociais -->
        <div id="campos-sociais" class="campos-extra" style="display:none;">
            <input type="radio" id="soc1" name="evento-social" value="Casamento">
            <label for="soc1">Casamento</label>

            <input type="radio" id="soc2" name="evento-social" value="Aniversário">
            <label for="soc2">Aniversário</label>

            <input type="radio" id="soc3" name="evento-social" value="Formatura">
            <label for="soc3">Formatura</label>
        </div>

        <!-- Radios filhos de Corporativos -->
        <div id="campos-corporativos" class="campos-extra" style="display:none;">
            <input type="radio" id="corp1" name="evento-corporativo" value="Treinamento">
            <label for="corp1">Treinamento</label>

            <input type="radio" id="corp2" name="evento-corporativo" value="Palestra">
            <label for="corp2">Palestra</label>

            <input type="radio" id="corp3" name="evento-corporativo" value="Reunião">
            <label for="corp3">Reunião</label>
        </div>

        <nav class="button">
            <button onclick="mostrar('dados-pessoais')">Anterior</button>
            <button onclick="mostrar('data-local')">Próximo</button>
        </nav>
    </div>
</section>

<section id="data-local">
    <div class="orcamento">
        <h1>Data e Local</h1>

        <div class="input-container">
            <label for="data-inicial" class="input-label">Data inicial:</label>
            <input type="date" id="data-inicial" name="data-inicial">
        </div>

        <div class="input-container">
            <label for="data-final" class="input-label">Data final:</label>
            <input type="date" id="data-final" name="data-final">
        </div>

        <nav class="button">
            <button onclick="mostrar('tipo-evento')">Anterior</button>
            <button onclick="mostrar('orcamento')">Próximo</button>
        </nav>
    </div>
</section>

<section id="orcamento">
    <div class="orcamento">
        <h1>Orçamento</h1>
        <!-- <label for="preco">Preço:</label> -->
        <div class="range-container">
            <input type="range" id="min" name="preco-min" min="0" max="49999" value="5000" oninput="updatePreco()">
            <input type="range" id="max" name="preco-max" min="1" max="50000" value="40000" oninput="updatePreco()">
        </div>
        <div class="range-inputs">
            <div class="container">
                <label for="min-input">Mín:</label>
                <input type="number" id="min-input" value="5000" min="0" max="50000">
            </div>

            <div class="container">
                <label for="max-input">Máx:</label>
                <input type="number" id="max-input" value="40000" min="0" max="50000">
            </div>
        </div>
    </div>
    <div class="orcamento2">
        <nav class="button">
            <button onclick="mostrar('data-local')">Anterior</button>
            <button onclick="mostrar('quantidade')">Próximo</button>
        </nav>
    </div>
</section>

<section id="quantidade">
    <div class="orcamento">
        <h1>Quantidade de Pessoas</h1>
        <nav class="button">
            <button onclick="mostrar('orcamento')">Anterior</button>
            <button onclick="mostrar('observacoes')">Próximo</button>
        </nav>
    </div>
</section>

<section id="observacoes">
    <div class="orcamento">
        <h1>Observações</h1>
        <textarea name="observacoes" rows="8" cols="40"></textarea>
        <nav class="button">
            <button onclick="mostrar('quantidade')">Anterior</button>
            <button type="submit">Finalizar</button>
        </nav>
    </div>
</section>

<script src="js/menu.js"></script>
<script src="js/pages.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="js/telefone.js"></script>
<script>
document.querySelectorAll('input[type=radio][name="tipo-evento"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Esconde todos os blocos de radios filhos
        document.querySelectorAll('.campos-extra').forEach(div => div.style.display = 'none');
        // Mostra apenas o vinculado ao radio principal
        const target = this.getAttribute('data-target');
        document.getElementById(target).style.display = 'block';
    });
});
</script>
<script src="js/price.js"></script>

<?php include 'inc/footer.php'; ?>