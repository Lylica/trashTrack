 


  
    function mostrarSecao(secao) {
      const secoes = document.querySelectorAll('.secao-admin');
      secoes.forEach(s => s.classList.remove('active'));
      document.getElementById(secao).classList.add('active');
    }

    function toggleNovaLixeira() {
      const form = document.getElementById('form-nova-lixeira');
      form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function editarUsuario(id, nome, usuario, email, tipo){
      document.getElementById('form-editar').style.display = 'block';
      document.getElementById('edit-id').value = id;
      document.getElementById('edit-nome').value = nome;
      document.getElementById('edit-usuario').value = usuario;
      document.getElementById('edit-email').value = email;
      document.getElementById('edit-tipo').value = tipo;
      // rolar para o formulário
      document.getElementById('form-editar').scrollIntoView({behavior: "smooth"});
    }

    function verDepoimentos(usuario){
      mostrarSecao('depoimentos');
      const linhas = document.querySelectorAll('#tabela-depoimentos tr.dep-row');
      linhas.forEach(l => l.style.display = l.dataset.usuario === usuario ? '' : 'none');
    }
 