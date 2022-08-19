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

