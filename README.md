# Redoma - Plataforma de Eventos

## Descrição

Redoma é uma plataforma web desenvolvida em PHP que atua como um hub para conectar organizadores de eventos com fornecedores e locais. O sistema oferece funcionalidades para gerenciar produtos, locais, serviços, regiões e usuários, facilitando a curadoria e o planejamento de eventos. A página inicial (`index.php`) apresenta um carrossel de imagens, seções sobre serviços sociais e corporativos, um fluxo de como a plataforma funciona, e áreas para 'Matchmaker Redoma' e 'Onde estamos', além de uma seção de 'Dúvidas'.

## Tecnologias Utilizadas

O projeto Redoma utiliza as seguintes tecnologias, inferidas pela estrutura do código:

*   **Backend:** PHP (com classes para conexão a banco de dados e manipulação de usuários)
*   **Servidor Web:** Apache (inferido pela presença de `.htaccess`)
*   **Banco de Dados:** MySQL (utilizado através da classe `Conexao`)
*   **Frontend:** HTML, CSS, JavaScript (presente nos arquivos `css/`, `js/` e no próprio HTML)

## Estrutura do Projeto

A estrutura de diretórios do projeto é organizada da seguinte forma:

```
redoma/
├── actions/                  # Scripts para ações específicas (e.g., CRUD)
├── classes/                  # Classes PHP para lógica de negócio (e.g., Usuario, Conexao)
├── css/                      # Arquivos de estilo CSS
├── img/                      # Imagens e assets gráficos
├── inc/                      # Inclui arquivos como header e footer
├── js/                       # Arquivos JavaScript para interatividade
├── python/                   # Possíveis scripts Python (não utilizados na funcionalidade principal)
├── .htaccess                 # Regras de reescrita de URL para o Apache
├── adicionarRecursos.php     # Página para adicionar recursos
├── adicionarRegiao.php       # Página para adicionar regiões
├── agenda.php                # Página de agenda
├── cadastroUser.php          # Página de cadastro de usuários
├── dashboard.php             # Painel de controle principal
├── editarAdmin.php           # Página para editar administradores
├── editarFornecedor.php      # Página para editar fornecedores
├── editarLocal.php           # Página para editar locais
├── editarProduto.php         # Página para editar produtos
├── editarRegiao.php          # Página para editar regiões
├── editarServico.php         # Página para editar serviços
├── formulario.php            # Formulário para planejamento de eventos
├── index.php                 # Página inicial da aplicação
├── login.php                 # Página de login
├── perguntas-frequentes.php  # Página de perguntas frequentes
└── teste.php                 # Arquivo de teste
```

## Instalação e Configuração (Genérica)

Para configurar e executar o projeto Redoma, os seguintes passos gerais são necessários:

1.  **Servidor Web:** Configure um servidor web (como Apache) para servir os arquivos PHP do projeto.
2.  **PHP:** Certifique-se de que o PHP esteja instalado e configurado corretamente no seu servidor web.
3.  **Banco de Dados:** Instale e configure um servidor MySQL.
4.  **Colocação do Projeto:** Coloque os arquivos do projeto em um diretório acessível pelo servidor web (e.g., `/var/www/html/redoma`).
5.  **Permissões:** Ajuste as permissões de arquivo e diretório para que o servidor web possa ler e executar os arquivos.
6.  **Configuração do Banco de Dados:**
    *   Crie um banco de dados MySQL (o nome `redoma` é sugerido pela classe `conexao.php`).
    *   Importe o esquema do banco de dados (tabelas e dados iniciais) a partir de um arquivo `.sql` fornecido (não incluído no zip original).
    *   Ajuste as credenciais de conexão no arquivo `classes/conexao.php` conforme seu ambiente MySQL. No arquivo original, as credenciais são `usuario = "root"` e `senha = ""` (vazia).

## Credenciais Padrão (Conexão ao Banco de Dados)

O arquivo `classes/conexao.php` do projeto original define as seguintes credenciais para conexão ao MySQL:

*   **Servidor:** `localhost`
*   **Banco de Dados:** `redoma`
*   **Usuário:** `root`
*   **Senha:** `""` (string vazia)
*   **Porta:** `3306`


## Uso

Após a instalação e configuração adequadas, a aplicação deve estar acessível através do endereço configurado no seu servidor web (e.g., `http://localhost/`). O login pode ser realizado através da página `login.php`.
