//para responsividade

document.querySelectorAll('.tabela').forEach(function (tabela) {
  const headers = Array.from(tabela.querySelectorAll('thead th')).map(th => th.innerText.trim());

  tabela.querySelectorAll('tbody tr').forEach(function (linha) {
    linha.querySelectorAll('td').forEach(function (celula, i) {
      if (headers[i]) {
        celula.setAttribute('data-label', headers[i]);
      }
    });
  });
});