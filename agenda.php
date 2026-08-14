<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login');
}

include 'inc/header2.php';
?>
<main>
    <div id='calendar'>
        <script src="js/calendario.js"></script>
    </div>
    <div class="button-conteiner">
        <a href="dashboard" class="fc-button">Voltar</a>
    </div>
</main>
<?php include 'inc/footer.php' ?>