<?php
include 'inc/header.php';
include 'classes/regiao.php';
include 'classes/local.php';
$regiao = new Regiao();
$regioes = $regiao->listar();
$local = new Local();
$locais = $local->listar();
?>
<main>
    <form method="POST" action="actions/formularioSubmit.php">
        <section id="nivel-planejamento" class="ativa">
            <div class="orcamento">
                <h1>Faça seu evento com nossos especialistas</h1>
                <p>Compartilhe suas preferências e encontraremos um especialista regional que sabe tudo sobre seu destino para ajudar você a planejar seu evento.</p>
                <h5>Em que estágio de planejamento você está?</h5>
                <div class="opcoes-botoes">
                    <input type="radio" id="evento1" name="nivel_planejamento" value="Claro e definido">
                    <label for="evento1">Claro e definido</label>

                    <input type="radio" id="evento2" name="nivel_planejamento" value="Explorando possibilidades">
                    <label for="evento2">Explorando possibilidades</label>

                    <input type="radio" id="evento3" name="nivel_planejamento" value="Algumas ideias">
                    <label for="evento3">Algumas ideias</label>
                </div>
                <nav class="button">
                    <button type="button" onclick="mostrar('dados-pessoais')">Próximo</button>
                </nav>
            </div>
        </section>

        <section id="dados-pessoais">
            <div class="orcamento">
                <h1>Dados Cadastrais</h1>

                <div class="checkbox-container">
                    <input type="checkbox" id="usar-dados-cadastrados" name="usar_dados_cadastrados" onclick="toggleDadosCadastrados()">
                    <label for="usar-dados-cadastrados">Usar dados já cadastrados</label>
                </div>

                <div id="dados-novos">
                    <div class="input-container">
                        <input type="text" id="nome" name="nome" placeholder=" " required>
                        <label for="nome" class="input-label">Nome Completo</label>
                    </div>
                    <div class="input-container">
                        <input type="text" id="telefone" name="telefone" placeholder=" " required>
                        <label for="telefone" class="input-label">Whatsapp</label>
                    </div>
                    <div class="input-container">
                        <input type="email" id="email" name="email" placeholder=" " required>
                        <label for="email" class="input-label">Email</label>
                    </div>
                </div>

                <div id="dados-cadastrados" style="display:none;">
                    <div class="input-container">
                        <input type="text" id="cpf" name="cpf" placeholder=" ">
                        <label for="cpf" class="input-label">Digite seu CPF</label>
                    </div>
                </div>


                <nav class="button">
                    <button type="button" onclick="mostrar('nivel-planejamento')">Anterior</button>
                    <button type="button" onclick="mostrar('tipo-evento')">Próximo</button>
                </nav>
            </div>
        </section>

        <section id="tipo-evento">
            <div class="orcamento">
                <h1>Tipo de Evento</h1>
                <div class="opcoes-botoes">
                    <input type="radio" id="op1" name="tipo_evento" value="sociais" data-target="campos-sociais">
                    <label for="op1">Eventos Sociais</label>

                    <input type="radio" id="op2" name="tipo_evento" value="corporativos" data-target="campos-corporativos">
                    <label for="op2">Eventos Corporativos</label>
                </div>

                <div id="campos-sociais" class="campos-extra" style="display:none;">
                    <input type="radio" id="soc1" name="evento-social" value="Casamento">
                    <label for="soc1">Casamento</label>

                    <input type="radio" id="soc2" name="evento-social" value="Aniversário">
                    <label for="soc2">Aniversário</label>

                    <input type="radio" id="soc3" name="evento-social" value="Formatura">
                    <label for="soc3">Formatura</label>
                </div>

                <div id="campos-corporativos" class="campos-extra" style="display:none;">
                    <input type="radio" id="corp1" name="evento-corporativo" value="Treinamento">
                    <label for="corp1">Treinamento</label>

                    <input type="radio" id="corp2" name="evento-corporativo" value="Palestra">
                    <label for="corp2">Palestra</label>

                    <input type="radio" id="corp3" name="evento-corporativo" value="Reunião">
                    <label for="corp3">Reunião</label>
                </div>

                <nav class="button">
                    <button type="button" onclick="mostrar('dados-pessoais')">Anterior</button>
                    <button type="button" onclick="mostrar('data-local')">Próximo</button>
                </nav>
            </div>
        </section>

        <section id="data-local">
            <div class="orcamento">
                <h1>Data e Local</h1>
                <div class="date">
                    <div class="input-container">
                        <label for="data-inicial" class="input-label">Data inicial:</label>
                        <input type="date" id="data-inicial" name="data1">
                    </div>

                    <div class="input-container">
                        <label for="data-final" class="input-label">Data final:</label>
                        <input type="date" id="data-final" name="data2">
                    </div>
                </div>

                <div class="orcamento2">
                    <div class="input-container">
                        <select name="id_regiao" id="id_regiao" required>
                            <option value="">Selecione uma região</option>
                            <?php foreach ($regioes as $reg) : ?>
                                <option value="<?php echo htmlspecialchars($reg['id']); ?>">
                                    <?php echo htmlspecialchars($reg['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-container">
                        <select name="local" id="local" required disabled>
                            <option value="">Primeiro, selecione uma região</option>
                        </select>
                    </div>
                </div>
                <nav class="button">
                    <button type="button" onclick="mostrar('tipo-evento')">Anterior</button>
                    <button type="button" onclick="mostrar('orcamento')">Próximo</button>
                </nav>
            </div>
        </section>

        <section id="orcamento">
            <div class="orcamento">
                <h1>Orçamento</h1>
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
                    <button type="button" onclick="mostrar('data-local')">Anterior</button>
                    <button type="button" onclick="mostrar('observacoes')">Próximo</button>
                </nav>
            </div>
        </section>

        <section id="observacoes">
            <div class="orcamento">
                <h2>Quantidade de Pessoas</h2>
                <div class="input-container">
                    <input type="number" id="qnt" name="qnt_pessoas" placeholder=" " required>
                    <label for="qnt" class="input-label">Quantidade de pessoas</label>
                </div>
                <h2>Observações</h2>
                <textarea name="observacoes" rows="8" cols="40" placeholder="Escreva aqui suas observações"></textarea>
                <nav class="button">
                    <button type="button" onclick="mostrar('orcamento')">Anterior</button>
                    <button type="submit">Finalizar</button>
                </nav>
            </div>
        </section>
    </form>
</main>

<script src="js/dadosCliente.js"></script>
<script src="js/cpf.js"></script>
<script src="js/menu.js"></script>
<script src="js/pages.js"></script>
<script src="https://unpkg.com/imask"></script>
<script src="js/telefone.js"></script>
<script src="js/radio.js"></script>
<script src="js/price.js"></script>
<script src="js/buscarLocais.js"></script>

<?php include 'inc/footer.php'; ?>