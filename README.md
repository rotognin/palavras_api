# Palavras API

Essa API consiste em registrar palavras, informando o tipo e um local que esteja relacionado com a palavra.

As rotas para consumo da API seguem abaixo:

Método | Rota | Descrição
---|---|----
GET | /api/palavra | Retorna uma palavra aleatória que esteja ativa
GET | /api/palavra/{palavra} | Caso seja passado uma palavra válida, retorna os dados da palavra
POST | /api/adicionar | Registrar uma palavra. Enviar um JSON com os dados da mesma
DELETE | /api/excluir/{palavra} | Excluir uma palavra. A mesma deve existir no banco
PUT | /api/ativar/{palavra} | Torna uma palavra ativa (pode ser retornada)
PUT | /api/inativar/{palavra} | Tornar uma palavra inativa (não será retornada)

# Cadastrar uma palavra

Para cadastrar uma palavra, é necessário acessar a rota <i>POST /api/adicionar</i> passando o Json abaixo:

```JSON
{
    "palavra": "xxxxxxxxxxx",
    "tipo": "xxxxxxx xxxxx xxxxxx",
    "local": "xxxxxxxxxxxx"
}
```

<b>Importante:</b> a palavra será cadastrada com caracteres minúsculos e não poderá ter espaço. É permitido letras de "a" a "z" e o hífen "-".

# Detalhes técnicos

API desenvolvida usando PHP 7.4.30, Laravel 8 com banco de dados MySQL.

Para baixar o projeto e executar localmente é necessário ter instalados os seguintes programas:

App | Descrição | Site
----|----|----
Composer | Gerenciador de dependências do projeto | [https://getcomposer.org/](https://getcomposer.org/)
Git | Controle de versão do projeto | [https://git-scm.com/](https://git-scm.com/)
PHP | Linguagem de programação do projeto | [https://www.php.net/](https://www.php.net/)

# Procedimentos para instalação local:
- Baixe o projeto em uma pasta
- - Use o comando <code>git clone https://github.com/rotognin/palavras_api.git</code>
- - Será criada a pasta <code>palavras_api</code>
- Acesse a pasta via linha de comando
- Execute o comando: <code>composer update</code> para baixar as dependências do projeto
- Após baixar as dependências, execute os comandos abaixo para gerar o arquivo de configuração do Laravel (.env) e gerar a chave do app:
- - <b>No Windows:</b> <code>copy .env.example .env</code>
- - <b>No Linux:</b> <code>cp .env.example .env</code>
- - <code>php artisan key:generate</code>
- Abra o arquivo .env e configure o acesso ao banco de dados, informando o nome do banco, usuário e senha
- - DB_CONNECTION=mysql
- - DB_HOST=127.0.0.1
- - DB_PORT=3306
- - DB_DATABASE=palavras_api
- - DB_USERNAME=root
- - DB_PASSWORD=pass
- Para gerar as tabelas no banco, execute as migrações usando o comando: <code>php artisan migrate</code>

Após esses passos o projeto já estará disponível localmente para ser utilizado, bastando usar o comando <code>php artisan serve</code> para servir a aplicação, que estará disponível por padrão no endereço <code>localhost:8000</code>