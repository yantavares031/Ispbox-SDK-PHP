# Ispbox2 SDK / PHP

[![Latest Stable Version](http://poser.pugx.org/ispbox2/sdk/v)](https://packagist.org/packages/ispbox2/sdk)
[![Total Downloads](http://poser.pugx.org/ispbox2/sdk/downloads)](https://packagist.org/packages/ispbox2/sdk)
[![Latest Unstable Version](http://poser.pugx.org/ispbox2/sdk/v/unstable)](https://packagist.org/packages/ispbox2/sdk)

Esta biblioteca prover aos desenvolvedores se comunicar de forma simples e rápida! reduzindo o tempo de integração aos recursos da API do Ispbox

## 💡 Requisitos

- PHP 7.4 ou superior
- URL ou IP do sistema (ex: https://demo2.ispbox.com.br)
- Usuário de acesso do sistema

## 💻 Instalação 

1. Realize o download do [Composer](https://getcomposer.org/doc/00-intro.md) caso não tenha instalado.

2. No diretório do seu projeto, execute em linha de comando
```
$ composer require ispbox2/sdk:dev-master
```

✅ É isso! O SDK do Ispbox2 foi instalado com sucesso.

## 🌟 Codando
  
  ### ⚙️ Configurando SDK
  ```php
    <?php
      require_once("vendor/autoload.php");
      
      Ispbox2\SDK::Configure(URL, USER, PASS);
    ?>
  ```
  | Parâmetro | Tipo | Obritoriedade | Descrição | Exemplo
  |---|---|---|---|---|
  | `URL` | string | obrigatório | URL Base utilizado no seu ERP Ispbox | `https://demo2.ispbox.com.br` |
  | `USER` | string | obrigatório | Login de conta ispbox | `demo` |
  | `PASS` | string | obrigatório | Senha de conta Ispbox | `demo` |

  > **Note** O método `Configure()`  internamente faz um teste de conexão validando a `URL` e as `credenciais`.
  > Caso não obtenha êxito no teste, é lançado uma exceção.

  ## 🔎 Busca de Cliente
  ```php
    <?php
      require_once("vendor/autoload.php");
      use Ispbox2\Clientes;
      use Ispbox2\Enums\Clientes\Sidx;

      Ispbox2\SDK::Configure('https://demo2.ispbox.com.br','demo','demo');

      $cliente = Clientes::findOne(Sidx::CPF, 61200456067);
      if($cliente->exists)
          echo $Cliente->nome;
      else
        //Mensagem / Notificação / Ação
      
      
    ?>
  ```
  ### Método `findOne()`
  | Parâmetro | Tipo | Obritoriedade | Descrição | Exemplo |
  |---|---|---|---|---|
  | `Sidx` | Enum | obrigatório | Chave de referencia, parâmetro que a SDK usará como filtro de busca, podendo ser variados tipos como: | `ID`, `CPF`, `CNPJ` |
  | `Valor` | mixed | obrigatório | Valor a ser buscado, com base na `Sidx` definida | `1` |

  > **Note** O método `findOne()`  retora um objeto do tipo `Cliente` se houver registros encontrados, caso contrario retorna um objeto `Cliente` vazio.
  > Para validar se a busca foi realizada com sucesso, utilize a propriedade `exists` em caso de `true` a busca obteve resultado!, para `false` a busca retornou vazia, logo o cliente não foi encontrado.

  ### Principais propriedades do objeto `Cliente`
  
  | Propriedade | Tipo  | Descrição |
  |---|---|---|
  | `id` | string | ID referente ao cadastro do cliente no sistema |
  | `nome` | string | retorna nome completo do cliente |
  | `dataCadastro` | string | ID referente ao cadastro do cliente no sistema |
  | `telefone` | string | retorna nome completo do cliente |
  | `celular` | string | ID referente ao cadastro do cliente no sistema |
  | `email` | string | retorna nome completo do cliente |
  | `emailSecundario` | string | ID referente ao cadastro do cliente no sistema |
  | `exists` | bool | retorna se o cadastro existe ou não |
  | `Endereco` | object | Contém todos os dados de endereço do cadastro como, `logradouro`, `numero`, `bairro`, `cep`  e etc...|

##  Projeto em Desenvolvimento 

## ❤️ Support 

## 🏻 License 
```
Apache License 2.0
Para mais informações, veja o arquivo de LICENÇA.
```