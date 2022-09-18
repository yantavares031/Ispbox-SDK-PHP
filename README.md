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
`composer require ispbox2/sdk` para PHP 7.4 ou superior.

3. Copy the access_token in the [credentials](https://www.mercadopago.com/mlb/account/credentials) section of the page and replace YOUR_ACCESS_TOKEN with it.

That's it! Mercado Pago SDK has been successfully installed.

## 🌟 Getting Started
  
  Simple usage looks like:
  
```php
  <?php
    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

    MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN"); // Either Production or SandBox AccessToken

    $payment = new MercadoPago\Payment();
    
    $payment->transaction_amount = 141;
    $payment->token = "YOUR_CARD_TOKEN";
    $payment->description = "Ergonomic Silk Shirt";
    $payment->installments = 1;
    $payment->payment_method_id = "visa";
    $payment->payer = array(
      "email" => "larue.nienow@email.com"
    );

    $payment->save();

    echo $payment->status;
  ?>
```

## 📚 Documentation 

Visit our Dev Site for further information regarding:
 - Payments APIs: [Spanish](https://www.mercadopago.com.ar/developers/es/guides/payments/api/introduction/) / [Portuguese](https://www.mercadopago.com.br/developers/pt/guides/payments/api/introduction/)
 - Mercado Pago checkout: [Spanish](https://www.mercadopago.com.ar/developers/es/guides/payments/web-payment-checkout/introduction/) / [Portuguese](https://www.mercadopago.com.br/developers/pt/guides/payments/web-payment-checkout/introduction/)
 - Web Tokenize checkout: [Spanish](https://www.mercadopago.com.ar/developers/es/guides/payments/web-tokenize-checkout/introduction/) / [Portuguese](https://www.mercadopago.com.br/developers/pt/guides/payments/web-tokenize-checkout/introduction/)

Check [our official code reference](https://www.mercadopago.com.br/developers/pt/docs/sdks-library/server-side) to explore all available functionalities.

## ❤️ Support 

If you require technical support, please contact our support team at [developers.mercadopago.com](https://developers.mercadopago.com)

## 🏻 License 

```
MIT license. Copyright (c) 2018 - Mercado Pago / Mercado Libre 
For more information, see the LICENSE file.
```
