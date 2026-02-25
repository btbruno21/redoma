const input = document.getElementById('numero');
const casasDecimais = 2;

input.addEventListener('input', () => {
    let valor = input.value.replace(/\D/g, '');

    if (!valor) {
        input.value = '0,00';
        return;
    }
    while (valor.length <= casasDecimais) {
        valor = '0' + valor;
    }

    const inteiro = valor.slice(0, -casasDecimais);
    const decimal = valor.slice(-casasDecimais);

    input.value = `${parseInt(inteiro)},${decimal}`;
});