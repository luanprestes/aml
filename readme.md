# Teste Técnico Due Diligence

Parabéns! Você foi aprovado para a próxima fase deste processo seletivo!

Nesta próxima fase a ideia é entender seu conhecimento com a nossa Stack. Para facilitar o processo, iremos usar alguns artifícios...
Usaremos o [Json Server](https://www.npmjs.com/package/json-server#getting-started) para criar uma API REST baseado em um arquivo JSON - este arquivo é uma versão da chamada de Espaçonaves do Star Wars disponibilizado pela [API SWAPI](https://swapi.dev/documentation#starships) - a modelagem está neste link.

Para instalar o JSON Server utilize 
~~~
npm install -g json-server
~~~

Para iniciar a API utilize o seguinte comando.
~~~
json-server --watch db.json
~~~

## Desafio CRUD
O seu desafio é uma tela que simula as operações de sistema com PHP. Você tem toda a liberdade de modelar a arquitetura e a solução da maneira que vc achar mais interessante.

Neste desafio, você precisará:
- Criar uma tela de listagem de espaçonaves com a opção de remover item;
- Criar uma tela de edição/adição de novas espaçonaves;

Você tem dois dias para finalizar este desafio. Se tiver alguma dúvida, não hesite em nos procurar! Iremos utilizar o serviço de Servidor Interno do PHP 7.4 para validar o seu projeto, e altere o readme de acordo com o necessário para que nossos avaliadores executem corretamente seu projeto.

Este ZIP tem todas as informações que você precisa e também aguardamos o retorno neste mesmo ZIP. Caso o seu projeto final tenha mais de 10Mb, não será aceito.

# CRUD de Espaçonaves

Este projeto é um sistema de CRUD para gerenciamento de espaçonaves, utilizando Symfony como backend e JSON Server como API REST fake. O projeto permite a listagem, adição, edição e remoção de espaçonaves.

## Tecnologias Utilizadas

- **Symfony 5.4**
- **JSON Server** para simulação da API REST
- **Bootstrap 5** para estilização do front-end
- **PHP 7.4**
- **Composer** para gerenciamento de dependências

## Requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas em seu ambiente de desenvolvimento:

- PHP 7.4
- Composer
- Node.js (para o JSON Server)
- MAMP (opcional, se utilizar para rodar PHP)

## Instalação do Projeto

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/luanprestes/aml.git


### 2. Instale as dependências do PHP:

    Utilize o Composer para instalar as dependências do Symfony:

    ```bash
    composer install

### 3. Instale o JSON Server para simulação da API:

    O JSON Server irá simular uma API REST para gerenciar os dados das espaçonaves. Para instalá-lo globalmente, utilize:

    ```bash
    npm install -g json-server

    Depois, inicie o servidor JSON apontando para o arquivo db.json:

    ```bash
    Copiar código
    json-server --watch db.json

### Funcionalidades

- **Listagem de espaçonaves**: Exibe uma lista de todas as espaçonaves cadastradas no sistema.
- **Criação de espaçonaves**: Formulário para adicionar uma nova espaçonave.
- **Edição de espaçonaves**: Edita as informações de uma espaçonave existente.
- **Remoção de espaçonaves**: Exclui uma espaçonave do sistema.

### Estrutura do Projeto

- **src/Controller**: Contém os controladores responsáveis por lidar com as requisições HTTP.
- **templates/**: Arquivos Twig para renderização das views.
- **public/**: Pasta pública do Symfony, onde ficam os assets e o ponto de entrada do projeto.
- **assets/**: Contém os arquivos CSS e JS do projeto.

### Rotas Principais

- **/space-ships**: Lista todas as espaçonaves.
- **/space-ships/new**: Criação de uma nova espaçonave.
- **/space-ships/{id}**: Detalhes de uma espaçonave específica.
- **/space-ships/{id}/edit**: Edição de uma espaçonave.
- **/space-ships/delete/{id}**: Remoção de uma espaçonave.