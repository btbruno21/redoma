let min = document.getElementById("min");
let max = document.getElementById("max");
let minInput = document.getElementById("min-input");
let maxInput = document.getElementById("max-input");
let track = document.querySelector(".slider-track");

function updatePreco() {
  let minVal = parseInt(min.value);
  let maxVal = parseInt(max.value);

  // Impede que se cruzem
  if (minVal > maxVal - 1) {
    minVal = maxVal - 1;
    min.value = minVal;
  }
  if (maxVal < minVal + 1) {
    maxVal = minVal + 1;
    max.value = maxVal;
  }

  // Atualiza inputs
  minInput.value = minVal;
  maxInput.value = maxVal;

  // Atualiza faixa colorida
  let percent1 = (minVal / min.max) * 100;
  let percent2 = (maxVal / max.max) * 100;
  track.style.left = percent1 + "%";
  track.style.width = (percent2 - percent1) + "%";
}

// Atualiza sliders quando digita nos inputs
minInput.addEventListener("input", () => {
  let val = parseInt(minInput.value);
  if (val >= parseInt(max.value)) val = parseInt(max.value) - 1;
  if (val < parseInt(min.min)) val = parseInt(min.min);
  min.value = val;
  updatePreco();
});

maxInput.addEventListener("input", () => {
  let val = parseInt(maxInput.value);
  if (val <= parseInt(min.value)) val = parseInt(min.value) + 1;
  if (val > parseInt(max.max)) val = parseInt(max.max);
  max.value = val;
  updatePreco();
});

// Inicializa faixa e inputs
updatePreco();