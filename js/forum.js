document.addEventListener('DOMContentLoaded', function() {
    const btnForm = document.getElementById('btn-form');
    const form = document.querySelector('.form-section form');

    // inicia escondido
    form.style.display = 'none';

    btnForm.addEventListener('click', () => {
        if (form.style.display === 'none') {
            form.style.display = 'flex';
            btnForm.textContent = 'Cancelar';
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            form.style.display = 'none';
            btnForm.textContent = '+ Adicionar postagem';
        }
    });
});
