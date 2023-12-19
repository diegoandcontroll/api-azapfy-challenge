# Controle de Notas Fiscais - Desafio Backend
<p align="center">
  <img src="https://www.azapfy.com.br/wp-content/uploads/2020/07/logo_Prancheta-1-1536x1022.png" width="400" height="200">
</p>
Este projeto é uma API REST para gerenciamento de notas fiscais dos usuários, desenvolvido como parte de um desafio de backend.

## Desafio

O objetivo é desenvolver uma API REST para controle de notas fiscais dos usuários. Principais funcionalidades incluem:

- Endpoints para cadastro e login de usuários
- CRUD para gerenciamento de notas fiscais
- Restrição de acesso às APIs de notas fiscais apenas para usuários autenticados
- Cada nota só pode ser acessada pelo usuário que a criou
- Envio de email para o usuário ao criar uma nota fiscal
- Retornos de response e HTTP status code adequados

## Estrutura da Nota Fiscal

A nota fiscal deve conter campos obrigatórios e passar por validações específicas:

- `numero`: Identificador único do documento (String)
- `valor`: Valor da nota fiscal (Numérico)
- `data_emissao`: Dia da emissão do documento (Data)
- `cnpj_remetente`: Identificador do remetente da nota (String, 9 dígitos, válido, não no futuro)
- `nome_remetente`: Nome do remetente da nota (String, até 100 caracteres)
- `cnpj_transportador`: Identificador do transportador da nota (String, válido)
- `nome_transportador`: Nome do transportador da nota (String, até 100 caracteres)

## Aspectos Principais

- **Arquitetura em Camadas:** Utilização de uma estrutura organizada em camadas como Presentation, Application, Domain e Infrastructure para separar as responsabilidades e facilitar o desenvolvimento e manutenção do código.

- **Princípios SOLID:** Aplicação de alguns princípios do SOLID para garantir um código mais coeso e extensível.

- **Design Patterns:** Utilização de alguns Design Patterns para resolver desafios de design comuns.

## Recomendações

Algumas sugestões para a realização do teste:

- Utilizar Form Request para validações dos campos das APIs
- Implementar camada de transformação dos dados com Api Resources
- Restringir acesso utilizando Polices e/ou Gates
- Utilizar Notifications para envio de emails e coloque-os em fila para disparo assíncrono
- Desenvolver testes automatizados
- Criar documentação da API usando Postman, Swagger ou outras ferramentas de preferência

## Setup do Projeto

Para executar o projeto localmente, siga os passos abaixo:

### Pré-requisitos
- Docker

### Instalação

1. Clone o repositório
2. Configure o ambiente de acordo com o .env.example `cp .env.example .env`
4. Instalar as dependências do composer
   ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
    ```
5. Inicie o projeto com docker `./vendor/bin/sail up`
3. Execute as migrações do banco `./vendor/bin/sail artisan migrate`

## Documentação da API

A documentação completa da API está disponível [aqui](https://documenter.getpostman.com/view/15021592/2s9Ykoc1UX#ae7f71af-f45b-4200-b331-a46497b4f1b5).
