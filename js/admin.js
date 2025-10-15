 function mostrarSecao(secao) {
      document.querySelectorAll('.secao-admin').forEach(div => div.style.display = 'none');
      document.getElementById(secao).style.display = 'block';
    }

    function editarUsuario(id, nome, usuario, email, tipo){
      document.getElementById('form-editar').style.display = 'block';
      document.getElementById('edit-id').value = id;
      document.getElementById('edit-nome').value = nome;
      document.getElementById('edit-usuario').value = usuario;
      document.getElementById('edit-email').value = email;
      document.getElementById('edit-tipo').value = tipo;
      window.scrollTo(0,document.body.scrollHeight);
    }

    function toggleNovaLixeira(){
      const form = document.getElementById('form-nova-lixeira');
      form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function verDashboard(id){
      alert('Abrir dashboard da lixeira ID: ' + id);
    }

    function verDepoimentos(usuario) {
      mostrarSecao('depoimentos'); // Abre a seção
      const linhas = document.querySelectorAll('#tabela-depoimentos .dep-row');
      linhas.forEach(linha => {
        if (linha.getAttribute('data-usuario') === usuario) {
          linha.style.display = '';
        } else {
          linha.style.display = 'none';
        }
      });
    }