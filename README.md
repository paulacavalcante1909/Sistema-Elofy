# Instalando o projeto com docker 

Este projeto contém o frontend (reactJS) e o backend (PHP)

Na pasta raiz rode o seguinte comando

### `docker-compose up`

Abra [http://localhost:3000](http://localhost:3000) e confira o projeto!

# Sem docker

## BACKEND

Utilize o xampp (ou qualquer outro de sua preferência) para rodar o backend

## FRONTEND

Na pasta /frontend rode os seguintes comandos

### `npm install`

### `npm start`

Abra [http://localhost:3000](http://localhost:3000) e confira o projeto!

## talvez seja necessário realizar algumas alterações no arquivo:
/frontend/src/Services/Resquests.js
altere a 'const url' deixando igual a url onde está rodando o backend, por exemplo:

de: http://localhost:8080/
para: http://localhost/Sistema-Elofy/backend/

## confira o arquivo:
/backend/env.conf
alterando os dados para os dados do seu banco


