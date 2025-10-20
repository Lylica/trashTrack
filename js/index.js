 
    document.addEventListener("DOMContentLoaded", () => {
        const wrapper = document.getElementById("carrossel-wrapper");
        const carrossel = document.getElementById("carrossel-depoimentos");
        if (!carrossel || !wrapper) return;

        // duplica os depoimentos para loop infinito
        const clone = carrossel.innerHTML;
        carrossel.innerHTML += clone;

        let posicao = 0;
        const velocidade = 0.5;

        // calcula largura total incluindo gap final
        const totalWidth = carrossel.scrollWidth / 2 + 20;

        function animarCarrossel() {
            posicao -= velocidade;
            if (Math.abs(posicao) >= totalWidth) {
                posicao = 0;
            }
            carrossel.style.transform = `translateX(${posicao}px)`;
            requestAnimationFrame(animarCarrossel);
        }

        animarCarrossel();
    });
  