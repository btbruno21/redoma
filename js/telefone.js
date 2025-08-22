document.addEventListener('DOMContentLoaded', function() {
  var telefone = document.getElementById('telefone');
  if (!telefone) return;

  telefone.value = '+55 ';

  var maskOptions = {
    mask: [
      { mask: '+598 000-000-00', ddi: '598'}, // Uruguai
      { mask: '+595 (000) 000-000', ddi: '595'}, // Paraguai
      { mask: '+351 0 000 000 000', ddi: '351' }, // Portugal
      { mask: '+57 (000) 000-0000', ddi: '57'}, // Colômbia
      { mask: '+56 0 0000 0000', ddi: '56'}, // Chile
      { mask: '+55 (00) 00000-0000', ddi: '55'}, // Brasil
      { mask: '+54 (000) 00-000-0000', ddi: '54'}, // Argentina
      { mask: '+49 00 0000 0000', ddi: '49' }, // Alemanha
      { mask: '+44 0 0000 000000', ddi: '44' }, // Reino Unido
      { mask: '+39 0 0000 0000', ddi: '39' }, // Itália
      { mask: '+34 0 0000 0000', ddi: '34' }, // Espanha
      { mask: '+33 0 00 00 00 00', ddi: '33' }, // França
      { mask: '+1 (000) 000-0000', ddi: '1'}, // EUA/Canadá

      // fallback genérico: aceita qualquer DDI + até 14 dígitos
      { mask: '+0[00] 00000000000000', ddi: 'generico' }
    ],
    dispatch: function(appended, dynamicMasked) {
      var valorTexto = dynamicMasked.value + appended;
      var prefixo = valorTexto.split(' ')[0].replace('+', ''); // DDI digitado

      // confirma DDI quando houver espaço ou 3 dígitos
      if (valorTexto.includes(' ') || prefixo.length === 3) {
        var mask = dynamicMasked.compiledMasks.find(m => m.ddi === prefixo);
        if (mask) {
          return mask; // máscara específica encontrada
        }
      }

      // fallback sempre cobre os não cadastrados
      return dynamicMasked.compiledMasks.find(m => m.ddi === 'generico');
    }
  };

  IMask(telefone, maskOptions);
});