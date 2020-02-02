<center><h1 style="color: #51619e;">DiscordOauth.php</h1></center>

### Objetivo deste repositório.

Bom, andei desenvolvendo por longo tempo php a anos atrás, como fui para outra linguagem como (JavaScript), acabei esquecendo
vários conceitos da linguagem em si, por conta de eu ter focado muito em JS, então eu decidi fazer esta mini-ferramenta, com intuito
de dar uma agilizada para aqueles que querem oauth2 do discord em php, inclusive desenvolvedores de habbo gosta disso, então
trouxe essa solução para rever alguns conceitos de php e treinar meus conhecimentos na linguagem em si, como eu parei a 3 anos atrás,
    testei se eu ainda conseguia me ldiar bem a linguagem (até que deu certo), mas é aquele ditado né "O conhecimento nunca é tirado e ninguém
nunca conseguirá tirar de tu." façam um bom aproveito desta ferramenta, qualquer dúvida estou aí.

### Como utiliza-lo

Bom primeiramente para você poder utilizar a ferramenta é preciso efetuar algumas configurações, segue o codeblock logo abaixo
instruindo.

    1- Crie um arquivo chamado config.php e depois coloque este seguinte código instruindo logo abaixo.
```php
<?php 
//==============CONFIGURAÇÃO DO SITE================
$config['url_server'] = ''; // url do site para utilizar em reridicionamentos
// ============CONFIGURAÇÃO DISCORD API==============
$config['discord_uri'] = ''; // uri de reridicionamento do oauth2 que você encontra em discord developer
$config['discord_client_id'] =''; // id da sua aplicação client no discord developer.
$config['discord_client_secret'] = ''; // client secret do seu discord developer
$config['discord_version'] = ''; // versão da api do discord (opcional).
// ==========CONFIGURAÇÃO DISCORD OAUTH2=============
// codificação em 64bits
$config['btoa_discord'] = $config['discord_client_id'].':'.$config['discord_client_secret']; 
// link da api do discord
$config['discord_api'] = 'https://discordapp.com/api/'; 
//====================================================
// link do oauth2 da api
$config['discord_oauth'] = 'https://discordapp.com/api/oauth2/'; 
//======================================================
$config['discord_oauth_link'] = $config['discord_oauth'].'token?client_id='.$config['discord_client_id'].'&redirect_uri='.$config['discord_uri'];
//===============================================================
$config['discord_auth'] = ''; // url do oauth2 do discord que se encontra em discord developer.
?>
```
    **OBS:** Não irei explicar muita coisa como funciona a pagina discord developer, talvez eu faça vídeo disso.

### Instâncias.

São funções que possui cada um deles determinada funções que são 

    - `new Api()` : Instância responsável pelas requisições para api do discord
        - Função: `<Api>->authenticate()` // função responsável pela autenticação do usuário entre seu site ele irá retornar resposta
        - Função: `<Api>->authenticate(<$session>)` // função responsável por puxar informações do usuário assim que autenticar ele.
        - Função: `<Api>->guilds(<$session>)` // funções responsável por listar os servidores do usuário (preciso de permissão de ver servidores).
    - `new Discord()`: Instância responsável pela autenticação com discord.

### Exemplo:

```php
    require_once './lib/class.discord.php';
    require_once 'config.php';
    // Quando o usuário for autenticar, será reridicionado para discord para poder permitir entregar suas informações para o site
    // Logo depois irá retornar um valor atribuido do GET chamado "code" Ex : http://localhost/login.php?code=kdsasdJAJDSDJDJasmds82
    if(isset($_GET['code'])){ // code é uma chave para requisitar para api do discord é preciso ser dessa forma "code".
        $discord = new Discord($config);
        // autenticando com discord, esta função é obrigatória, ele retorna um Objeto
        $result = $discord->authenticate(); 
        // requisitando ao discord que quero informações do usuário que ele permitiu.
        $resultUser = $discord->author($result); // pegando o valor atribuido que foi retornado como objeto.
        echo 'Username:'.$resultUser->username.'\n ID:'.$resultUser->id;
        // Caso queira ver o que mais retorna basta acessar: https://discordapp.com/developers/docs/topics/oauth2
    } else header('Location: /index.php'); // caso não tenha requisição code é reridicionado para a pagina principal.
```
- Imagem [Clique aqui](https://prnt.sc/qwazb3)
### Conclusão
Bom é algo bem bobo que até me ajudou a me dar uma clareada melhor ainda, quando você pratica algo novamente você certamente
irá amadurecer mais e aperfeiçoar seu código, faça de bom uso deste código e você pode requisitar um pull request caso queira melhora-lo.

Mais informações sobre Oauth2 Discord em : [Clique aqui](https://discordapp.com/developers/docs/topics/oauth2).
