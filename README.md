# TrashTracker 🗑️

O TrashTracker é uma solução web completa para o monitoramento inteligente de lixeiras. O projeto nasceu para otimizar a coleta de lixo, fornecendo dados em tempo real tanto para cidadãos quanto para as entidades gestoras (como prefeituras), visando economizar tempo, combustível e reduzir a emissão de CO₂.

A plataforma web permite que usuários cadastrados visualizem o nível de preenchimento das lixeiras em um dashboard dinâmico e participem de um fórum comunitário. Administradores têm acesso a um painel de controle para gerenciar usuários, lixeiras e posts do fórum.

## ✨ Funcionalidades Principais

  * **Dashboard Interativo:** Visualização de dados históricos e em tempo real do nível das lixeiras, com integração direta com a API do Thingspeak.
      * Filtros por dia.
      * Alternância entre gráficos de barra e de linha (step).
      * Exibição do status atual (Vazio, Normal, Cheio) e última atualização.
      * Exportação de dados para CSV.
  * **Sistema de Usuários:**
      * Cadastro de novos usuários com seleção de avatar.
      * Login e autenticação de sessão.
  * **Fórum Comunitário:**
      * Usuários logados podem criar novos posts (tópicos) no fórum.
      * Visualização de todos os posts da comunidade.
  * **Painel de Administração (`admin.php`):**
      * **Gerenciamento de Usuários:** Visualizar, pesquisar, editar e excluir usuários cadastrados.
      * **Gerenciamento de Lixeiras:** Cadastrar e excluir lixeiras (esta funcionalidade parece estar ligada a uma tabela SQL, `lixeiras`, embora o dashboard principal puxe dados da API).
      * **Gerenciamento do Fórum:** Visualizar e excluir qualquer postagem do fórum.
  * **Páginas Institucionais:**
      * **Sobre:** Apresenta a motivação do projeto e a equipe de colaboradores.
      * **Porque Nós?:** Destaca os diferenciais do projeto, como o dashboard público, o fórum e os benefícios (economia de combustível, redução de CO₂).

## 🛠️ Tecnologias Utilizadas

  * **Backend:** PHP
  * **Frontend:** HTML5, CSS3, JavaScript (ES6+)
  * **Banco de Dados:** MySQL (utilizado para usuários e fórum)
  * **Visualização de Dados:** Chart.js
  * **Coleta de Dados (IoT):** API do Thingspeak

## 🚀 Configuração e Instalação

1.  **Banco de Dados:**

      * Certifique-se de que possui um servidor MySQL em execução.
      * Configure as credenciais de conexão (host, usuário, senha, nome do banco) no arquivo `db.php`. O padrão atual é:
        ```php
        $host = "localhost";
        $user = "root";
        $pass = "trashtrack";
        $db   = "trashtrack";
        ```
      * Importe a estrutura do banco de dados e os dados iniciais (usuário admin) executando o arquivo `trashtrack.sql` no seu servidor MySQL.

2.  **Servidor Web:**

      * Clone ou copie este repositório para a raiz do seu servidor web (ex: Apache, NGINX).
      * Certifique-se de que o servidor tem suporte a PHP.

3.  **Acesso:**

      * Acesse o `index.php` pelo seu navegador.
      * **Usuário Administrador Padrão (do `trashtrack.sql`):**
          * **Usuário:** `admin`
          * **Senha:** `admin123`

## 📁 Estrutura do Repositório (Simplificada)

```
/
├── css/                  # Arquivos de estilo (dashboard, index, login, etc.)
│   ├── dashboard.css
│   ├── index.css
│   ├── login.css
│   └── ...
├── js/                   # Arquivos JavaScript
│   ├── dashboard.js      # Lógica principal do dashboard (Chart.js, API Thingspeak)
│   ├── cadastro.js       # Lógica do carrossel de avatar
│   └── ...
├── avatares/             # Imagens de avatar para usuários
│   ├── avatar1.png
│   └── ...
├── images/               # Imagens gerais do site (logos, fotos dos colaboradores, etc.)
│
├── index.php             # Página inicial
├── sobre.php             # Página "Sobre"
├── porque.php            # Página "Porque Nós?"
├── dashboard.php         # Dashboard do usuário (requer login)
├── forum.php             # Fórum (requer login)
│
├── login.php             # Página de login
├── cadastro.php          # Página de cadastro
├── logout.php            # Script de logout
├── processa_post.php     # Script que recebe os dados do fórum
│
├── admin.php             # Painel de controle do Administrador
├── dashboardAdmin.php    # Dashboard (versão admin)
├── forumAdmin.php        # Fórum (versão admin)
│
├── db.php                # Configuração da conexão com o banco de dados
├── trashtrack.sql        # Estrutura do banco de dados (Tabelas: usuarios, forum, lixeiras)
├── sitemap.xml           # Mapa do site para SEO
└── robots.txt            # Regras para crawlers (bloqueia admin, login, etc.)
```