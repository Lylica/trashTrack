document.addEventListener("DOMContentLoaded", () => {
  const carrossel = document.getElementById("carrossel-depoimentos");
  if (!carrossel) return;

  // Clona todos os depoimentos para o efeito infinito
  carrossel.innerHTML += carrossel.innerHTML;

  let posicao = 0;

  function animarCarrossel() {
    posicao -= 0.5; // velocidade, ajuste se quiser mais rápido/lento
    const totalWidth = carrossel.scrollWidth / 2; // metade porque duplicamos os itens

    if (Math.abs(posicao) >= totalWidth) {
      posicao = 0; // reseta para criar loop infinito
    }

    carrossel.style.transform = `translateX(${posicao}px)`;
    requestAnimationFrame(animarCarrossel);
  }

  animarCarrossel();
});
