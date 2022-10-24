# Ispbox2 SDK / PHP

[![Latest Stable Version](http://poser.pugx.org/ispbox2/sdk/v)](https://packagist.org/packages/ispbox2/sdk)
[![Latest Unstable Version](http://poser.pugx.org/ispbox2/sdk/v/unstable)](https://packagist.org/packages/ispbox2/sdk)

Esta biblioteca prover aos desenvolvedores se comunicar de forma simples e rápida! reduzindo o tempo de integração aos recursos da API do Ispbox.
Lembrando que esta SDK foi desenvolvida utilzando como base a API [`ispbox-ajax-requests`](https://github.com/duoboxbr/ispbox-ajax-requests) API

## 🗒️ Sumário
- [Instalação](#-instalação)
- [Configurando SDK](#%EF%B8%8F-configurando-sdk)
- [Busca de cliente](#-busca-de-cliente)
  - [▷ Método `findOne`](#-método-findone)
- [Busca de contratos / Planos contratados](#-busca-de-contratos--planos-contratados)
  - [▷ Método `Take`](#-método-take)
  - [▷ Método `takeAny`](#-método-takeany)
  - [▷ Método `toList`](#-método-tolist)
    - [Buscando todos os contratos do cliente por Tipo](#-buscando-todos-os-contratos-do-cliente-por-tipo)
    - [Buscando todos os contratos do cliente por Status](#-buscando-todos-os-contratos-do-cliente-por-status)


## 💡 Requisitos

- PHP 7.4 ou superior
- URL ou IP do sistema (ex: https://demo2.ispbox.com.br)
- Usuário de acesso do sistema

## 💻 Instalação 

1. Realize o download do [Composer](https://getcomposer.org/doc/00-intro.md) caso não tenha instalado.

2. No diretório raiz do seu projeto, execute em linha de comando
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
  | Parâmetro | Tipo | Requisito | Descrição | Exemplo
  |---|---|---|---|---|
  | `URL` | string | obrigatório | URL Base utilizado no seu ERP Ispbox | `https://demo.ispbox.com.br` |
  | `USER` | string | obrigatório | Login de conta ispbox | `admin` |
  | `PASS` | string | obrigatório | Senha de conta Ispbox | `password` |

  > **Note** O método `Configure()`  internamente faz um teste de conexão validando a `URL` e as `credenciais`.
  > Caso não obtenha êxito no teste, é lançado uma exceção.

  ## 🔎 Busca de Cliente

  ### ▷ Método `findOne()`
  ```php
    <?php
      require_once("vendor/autoload.php");
      use Ispbox2\Clientes;
      use Ispbox2\Enums\Clientes\Sidx;

      Ispbox2\SDK::Configure('https://demo.ispbox.com.br','admin','password');

      $cliente = Clientes::findOne(Sidx::CPF, 61200456067);
      if($cliente->exists)
          echo $cliente->nome;
      else
        //Mensagem / Notificação / Ação
    ?>
  ```

  > **Note** O método `findOne()` é um método estático de busca que retora um objeto do tipo `Cliente` se houver registros encontrados, caso contrario retorna um objeto `Cliente` vazio.
  > Para validar se a busca foi realizada com sucesso, utilize a propriedade `exists` em caso de `true` a busca obteve resultado!, para `false` a busca retornou vazia, logo o cliente não foi encontrado.
  
  | Parâmetro | Tipo | Requisito | Descrição | Exemplo |
  |---|---|---|---|---|
  | `Sidx` | Enum | obrigatório | Chave de referencia, parâmetro que a SDK usará como filtro de busca, podendo ser variados tipos como: | `ID`, `CPF`, `CNPJ` |
  | `Valor` | mixed | obrigatório | Valor a ser buscado, com base na `Sidx` definida |  |

  ### Principais propriedades do objeto `Cliente`
  #### Em caso de `Pessoa Física` as propriedades são:
  
  | Propriedade | Tipo  | Descrição |
  |---|---|---|
  | `id` | string | ID referente ao cadastro do cliente no sistema |
  | `nome` | string | retorna nome completo do cliente |
  | `dataCadastro` | string | data em que foi cadastrado |
  | `telefone` | string | contato de telefone |
  | `celular` | string | contato de celular |
  | `email` | string | email principal|
  | `emailSecundario` | string | email secundario |
  | `exists` | bool | retorna se o cadastro existe ou não |
  | `Endereco` | object | Contém todos os dados de endereço do cadastro como, `logradouro`, `numero`, `bairro`, `cep`  e etc...|
  | `nomePai` | string | retorna nome do Pai |
  | `nomeMae` | string | retorna nome do Mãe |
  | `profissao` | string | retorna profissão do cliente |
  | `rg` | string | retorna a numerção do documento RG |
  | `cpf` | string | retorna a numerção do documento CPF |
  
  #### Em caso de `Pessoa Jurídica` as propriedades são:
  
  | Propriedade | Tipo  | Descrição |
  |---|---|---|
  | `id` | string | ID referente ao cadastro do cliente no sistema |
  | `nomeFantasia` | string | retorna nome completo da empresa |
  | `dataCadastro` | string | data em que foi cadastrado |
  | `telefone` | string | contato de telefone |
  | `celular` | string | contato de celular |
  | `email` | string | email principal|
  | `emailSecundario` | string | email secundario |
  | `exists` | bool | retorna se o cadastro existe ou não |
  | `Endereco` | object | Contém todos os dados de endereço do cadastro como, `logradouro`, `numero`, `bairro`, `cep`  e etc...|
  | `responsavel` | string | retorna nome da pessoa responsável / proprietario(a) da empresa |
  | `inscricaoEstadual` | string | retorna numeração da inscrição no estado |
  | `cnpj` | string | retorna a numerção do documento CNPJ |

  ## 📝 Busca de Contratos / Planos contratados
  ```php
    <?php
      require_once("vendor/autoload.php");
      use Ispbox2\Clientes;
      use Ispbox2\Contratos;
      use Ispbox2\Enums\Clientes\Sidx;

      Ispbox2\SDK::Configure('https://demo.ispbox.com.br','admin','password');

      $cliente   = Clientes::findOne(Sidx::CPF, '61200456067');
      if(!$cliente->exists)
            //Messagem de erro caso o cliente não seja valido

      $contratos = new Contratos($cliente);
  ```
  > **Note** A Classe `Contratos` é um objeto de busca que retora contratos (sejam eles de TELEFONIA ou de INTERNET) aderidos por determinado cliente válido, que é requisitado como `parametro obrigatório` do método Construtor da classe. Para filtrar informações do contrato utilize os métodos em seguida....

  ### Principais propriedades do objeto `Contrato`
  
  | Propriedade | Tipo  | Descrição |
  |---|---|---|
  | `id` | int | ID do contrato |
  | `clienteId` | int | ID do cliente que contém o contrato |
  | `plano` | string | Plano contratatado |
  | `valor` | float | Valor mensal do contrato |
  | `dataInstalacao` | string | data em que o serviço foi ativado |
  | `planoStatus` | string | Status do plano... Liberado, bloqueado, susp..|
  | `planoStatusEnum` | enum | Enum para comparação |
  | `active` | bool | retorna se serviço está ativo (true), ou aguardando ativação (false) |

  ### ▷ Método `Take()`
  ```php
    <?php
      ...
      use Ispbox2\Enums\Contratos\Tipo;
      ...
      $contratos = new Contratos($cliente);
      $contratos->Take(Tipo::Internet);
  ```
  
  > **Note** O método `Take()` é um método de busca que retora um objeto do tipo `Contrato` se houver registros encontrados, caso contrario retorna um objeto `Contrato` vazio.
  > O método `Take()` retorna somente um unico registro, por padrão se o segundo paramtro `id` não for passado... ele sempre retornara o primeiro contrato do cliente de acordo com o tipo escolhido. Porém caso queira retornar um contrato especifico é necessário passar o `id` do contrato como segundo parametro da função.

  | Parâmetro | Tipo | Requisito | Descrição | Exemplo |
  |---|---|---|---|---|
  | `Tipo de contrato` | Enum | obrigatório | Identificador que indicara o tipo de contrato a ser solicitado podendo ser: | `Tipo::Internet` ou `Tipo::Telefonia` |
  | `id` | int | opcional | Refere-se a um contrato especifico do cliente, com base no `Tipo de contrato` definido | Por padrão é 0 |

  ### ▷ Método `takeAny()`
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);
        $contratos->takeAny(35);
  ```
  > **Note** O método `takeAny()` é um método de busca que retorna um objeto do tipo `Contrato` somente com base no `id` informado. 

  | Parâmetro | Tipo | Requisito | Descrição | Exemplo |
  |---|---|---|---|---|
  | `id` | int | obrigatório | Refere-se a ao id de contrato especifico do cliente |  |

  ### ▷ Método `toList()`
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);
        $contratos->toList();
  ```
  > **Note** O método `toList()` é um método de busca que retorna um `array` contendo todos os `Contratos` do cliente 

  | Parâmetro | Tipo | Requisito | Descrição | Exemplo |
  |---|---|---|---|---|
  | `Tipo` | Enum | opcional | Refere-se ao tipo de contrato (INTERNET ou TELEFONIA) |  |
  | `Status` | Enum | opcional | Refere-se ao status do do serviço |  |
  
  #### ▷ Buscando todos os contratos do cliente por Tipo
  > **Note** Retorna array com todos os contratos sem distinção de status, apenas filtrando pelo tipo do contrato.
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);

        $contratos->toList(Tipo::Internet); // Retorna array com todos os contratos de internet do cliente
        $contratos->toList(Tipo::Telefonia); // Retorna array com todos os contratos de internet do cliente
  ```
  #### ▷ Buscando todos os contratos do cliente por Status
  > **Note** Retorna array com todos os contratos sem distinção de tipo, apenas filtrando pelo status do contrato.
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);

        $contratos->toList(null, Status::Liberado); // Retorna array com todos os contratos liberado do cliente
        $contratos->toList(null, Tipo::Bloqueado); // Retorna array com todos os contratos Bloqueado do cliente
        $contratos->toList(null, Tipo::ContratoSuspenso); // Retorna array com todos os contratos suspensos do cliente
        $contratos->toList(null, Tipo::SuspensoParcial); // Retorna array com todos os contratos suspensos parcialemnte do cliente
  ```
  ## 💲 Busca de Boletos
  ```php
    <?php
      require_once("vendor/autoload.php");
      use Ispbox2\Clientes;
      use Ispbox2\Contratos;
      use Ispbox2\Enums\Clientes\Sidx;

      Ispbox2\SDK::Configure('https://demo.ispbox.com.br','admin','password');

      $cliente   = Clientes::findOne(Sidx::CPF, '61200456067');
      if(!$cliente->exists)
            //Messagem de erro caso o cliente não seja valido

      $contratos = new Contratos($cliente);
      $contratoInternet = $contratos->Take(Tipo::Internet);

      $boletos = new Boletos($contratoInternet);
  ```
  > **Note** A Classe `Boletos` é um objeto de busca que retora boletos (sejam eles de Mensalidades ou Avulsos) vinculado á um serviço do cliente, que é requisitado como `parametro obrigatório` do método Construtor da classe.

  ### ▷ Método `takeAll()`
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);
        $contratos->toList();
  ```
  > **Note** O método `takeAll()` é um método de busca que retorna um `array` contendo todos os `Boletos` do cliente 

  | Parâmetro | Tipo | Requisito | Descrição | Exemplo |
  |---|---|---|---|---|
  | `Tipo` | Enum | opcional | Refere-se ao tipo de contrato (INTERNET ou TELEFONIA) |  |
  | `Status` | Enum | opcional | Refere-se ao status do do serviço |  |
  
  #### ▷ Buscando todos os contratos do cliente por Tipo
  > **Note** Retorna array com todos os contratos sem distinção de status, apenas filtrando pelo tipo do contrato.
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);

        $contratos->toList(Tipo::Internet); // Retorna array com todos os contratos de internet do cliente
        $contratos->toList(Tipo::Telefonia); // Retorna array com todos os contratos de internet do cliente
  ```
  #### ▷ Buscando todos os contratos do cliente por Status
  > **Note** Retorna array com todos os contratos sem distinção de tipo, apenas filtrando pelo status do contrato.
  ```php
      <?php
        ...
        use Ispbox2\Enums\Contratos\Tipo;
        ...
        $contratos = new Contratos($cliente);

        $contratos->toList(null, Status::Liberado); // Retorna array com todos os contratos liberado do cliente
        $contratos->toList(null, Tipo::Bloqueado); // Retorna array com todos os contratos Bloqueado do cliente
        $contratos->toList(null, Tipo::ContratoSuspenso); // Retorna array com todos os contratos suspensos do cliente
        $contratos->toList(null, Tipo::SuspensoParcial); // Retorna array com todos os contratos suspensos parcialemnte do cliente
  ```

##  Projeto em Desenvolvimento 

## 🏻 License 
```
Apache License 2.0
Para mais informações, veja o arquivo de LICENÇA.
```