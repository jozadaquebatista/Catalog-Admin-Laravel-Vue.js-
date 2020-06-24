# Product Admin (Laravel + Vue.js)
Uma aplicação para um teste FullStack

### Objetivo
Desenvolver uma aplicação para gestão de produtos, que deverá conter:
- visualização dos produtos
- adição de novos produtos com possibilidade de adição de fotografias
- edição de produto
- definição do o status de um produto(pendente, análise, aprovado, reprovado)
- autenticação para administrador, usuário normal e para as chamadas de API
- níveis de permissão(autorização)
- filtragem de produtos (front-end + back-end)

### Nesse projeto foi utilizado
- [x] **Sqlite** - Utilizei para tornar mais simples para avaliação
- [x] **PHP 7.4**
- [x] **Laravel Framework 7**
- [x] **Vue.js 2.0**
    - [x] Vue Router
    - [x] Vuex
    - [x] Vuetify
- [x] **Axios**
- [x] **Croppa**

### Executar Servidor
Basta executar os comandos a baixo em ordem
1) **php artisan migrate** = realiza as migrações para o database.sqlite, localizado em datatabase/database.sqlite
2) **php artisan db:seed** = pré popula o banco de dados com informações de produtos "**fakes**"
3) **php artisan serve** = inicia o servidor

### Compilação dos Componentes Vue.js
Para compilar os componentes, basta executar o comando abaixo em algum terminal::
1) **npm run watch** = compila os arquivos componentes do vue.js e faz um bundle de tudo


## Resultado Final

### Login
<kbd>
    
![Login Screen](https://raw.githubusercontent.com/jozadaquebatista/Catalog-Admin-Laravel-Vue.js-/master/cover/screen1.PNG)

</kbd>
---------

### Tela inicial
<kbd>

![Listagem dos Produtos](https://raw.githubusercontent.com/jozadaquebatista/Catalog-Admin-Laravel-Vue.js-/master/cover/screen2.PNG)

</kbd>
---------

### Cadastro de Produto
<kbd>

![Cadastro de Produto](https://raw.githubusercontent.com/jozadaquebatista/Catalog-Admin-Laravel-Vue.js-/master/cover/screen3.PNG)

</kbd>
