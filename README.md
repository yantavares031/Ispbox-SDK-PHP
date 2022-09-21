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
`composer require ispbox2/sdk:dev-master` para PHP 7.4 ou superior.

É isso! O SDK do Ispbox2 foi instalado com sucesso.

## 🌟 Codando
  
  O uso simples se parece com:
  
```php
  <?php
    require_once("vendor/autoload.php");
    use Ispbox2\Enums\Sidx;
    use Ispbox2\Clientes;
    use Ispbox2\Contratos;

    Ispbox2\SDK::Configure('https://demo2.ispbox.com.br','demo','demo');

    $cliente   = Clientes::findOne(Sidx::ID, '1');
    $contratos = new Contratos($cliente);

    echo $cliente->nome;
  ?>
```

## 📚 Projeto em Desenvolvimento 

## ❤️ Support 

## 🏻 License 
```
Apache License 2.0
Para mais informações, veja o arquivo de LICENÇA.
```