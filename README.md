# Sobre o projeto

Desafio desenvolvedor back-end: 
- Utilizando o Laravel cria uma API rest, A Loja ABC LTDA, vende produtos de diferentes nichos. No momento precisamos registrar a venda de celulares.

# Passo a Passo de Utilização

### 1 - Clone o Repositorio

```
https://github.com/erickcordeiroa/adoorei-test
```

### 2 - Crie o arquivo .env

```
cp .env.example .env
```

### 3 - Atualize as variáveis de ambiente do arquivo .env

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=adoorei
DB_USERNAME=root
DB_PASSWORD=root
```

### 4 - Suba os containers do projeto

```
docker-compose up -d
```

### 5 - Acessar o container

```
docker exec -it "nomedocontainer" bash
```
Lembre-se de trocar o "nomedocontainer" pelo nome que seu docker criou

### 6 - Instalar a dependência do projeto

```
composer install
```

### 7 - Gerar a key do projeto Laravel
```
php artisan key:generate
```

### 8 - Executar as migrate
```
php artisan migrate
```

### 9 - Executar o Seed de produtos
```
php artisan db:seed ProductSeeder
```

#### Acessar o projeto

- O projeto já vai estar disponível em https://localhost:8000/api

- O arquivo contendo as informações da api (rotas) esta na raiz do projeto com o nome de insomnia_adoorei.json, basta importa-lo para o seu insomnia e realizar os testes.

## Plus do projeto

- Também existe no projeto o swagger para realizar a visualização de como deve ser integrada as funcionalidades.
- Link da documentação http://localhost:8000/api/documentation

