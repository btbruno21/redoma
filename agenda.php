<?php include 'inc/header2.php';
session_start();
if (isset($_SESSION)) {
    header('Location: login');
}
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