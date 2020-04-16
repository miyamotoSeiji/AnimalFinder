# Animal Finder

Animal Finder é um aplicativo web para cadastro de animais de estimação perdidos, onde o dono do animal perdido se cadastra e informa os dados do seu pet.

Todos os pets informados aparecem na página principal do aplicativo, caso alguém tenha notícias sobre algum pet exposto, poderá comunicar ao dono seu nome e telefone para que seja feito o contato.

Este projeto foi desenvolvido exclusivamente como parte do processo seletivo para uma vaga de desenvolvedor.

A documentação com as informações da atividade pode ser encontrada na pasta raiz desse repositório como "Novo Teste - Ruby.pdf".

O Backlog utilizado para o desenvolvimento deste aplicativo também pode ser encontrado na raíz desse repositório como "Backlog AnimalFinder.xlsx

## Instalação

Para o desenvolvimento desse projeto foi utilizado o pacote de servidores XAMPP na versão v3.2.1 utilizando os modulos MySQL e Apache, juntamente com o framework CakePHP na versão 2.10.19, Bootstrap na versão 4.4.1 e também o conjunto Font Awesome em seu kit gratuito.
Todas as ferramentas utilizadas no projeto são distribuidas de forma livre e grátuita.

Após a instalação do XAMPP é necessário criar o banco de dados relacional, para isso é preciso criar a base de dados "animal_finder" em localhost, em seguida rodar o script localizado neste repositório em: AnimalFinder/app/Config/Schema/00-metadata.sql

Após a configuração do banco de dados é preciso clonar este repositório ( https://github.com/miyamotoSeiji/AnimalFinder.git ) na pasta "htdocs" localizada dentro do diretório de instalação do XAMPP.

Para ter acesso ao aplicativo em servidor local, acesse pelo navegador: http://localhost/AnimalFinder/

## Manual de utilização

O sistema tem o propósito de atender dois tipos de usuario especificos:

- O usuário que encontrou algum animal de estimação perdido e está a procura de seu dono. Neste tutorial será chamado de "Anjo".
- O usuário que perdeu seu animal de estimação e está a procura do mesmo. Nesse tutorial será chamado de "Dono".

Os animais de estimação são uma entidade a parte. Nesse tutorial serão chamados de "pet"

Para cada um dos usuários as funcionalidades são distintas:

### Anjo

O Anjo ao acessar o aplicativo tem acesso a visualização dos cartões informativos de todos os pets perdidos.

Caso existam muitos pets perdidos (9+), o sistema vai gerar a paginação para navegação no final da página.

Cada cartão informativo possui:

- Foto do pet
- Nome
- Idade
- Informações Extras (Caracteristicas únicas e ou forma em que se perdeu)
- Cidade onde se perdeu
- Estado da cidade onde se perdeu
- Status, para o Anjo só serão apresentados os cartões dos animais com status "Perdido"
- Botão "Encontrei!"

#### Botão "Encontrei!"

Caso o Anjo tenha notícias ou tenha localizado o pet, que tenha seu cartão apresentado no aplicativo, basta que ele clique no botão "Encontrei!". Ao clicar o Anjo será direcionado para uma página contendo todas informações do pet.

Além das informações, haverão dois campos para preenchimento:

- Nome, onde o Anjo deverá informar seu nome
- Telefone, onde o Anjo deverá informar o seu telefone para que o Dono possa entrar em contato

Após o preenchimento das informações basta clicar no botão "Comunicar achado", ao clicar o status do pet será alterado para "Comunicado".

Caso o Anjo tenha se confundido com as informações e não tenha de fato informações sobre o paradeiro do pet, ele pode cancelar a ação clicando no botão "Voltar, dessa forma ele retornará para a página principal do aplicativo.

### Dono

O Dono ao acessar o aplicativo também poderá visualizar todos os pets perdidos, caso queira pode desempenhar as mesmas funções que um Anjo. Mas para poder Cadastrar um pet perdido é necessário que ele se cadastre no aplicativo.

Para realizar o cadastro, basta que ele clique no botão "Cadastrar" localizado no menu superior à direita. Caso já possua um cadastro basta clicar no botão "Entrar" que fica logo ao lado.

#### Botão "Cadastrar"

Ao clicar nesse botão o dono será redirecionado para a página de cadastro onde serão requeridas as seguintes informações:

- Nome
- E-mail
- Telefone
- Senha

Após o preenchimento das informações, basta clicar no botão "Cadastrar", em seguida o dono será redirecionado para a página de login.

Caso não queria realizar ou concluir o cadastro, basta clicar no botão "Voltar", para retornar a página principal.

#### Botão "Entrar"

Ao clicar no botão "Entrar", o dono será redirecionado para a página de login, onde deverá informar o seguintes dados:

- E-mail
- Senha

Após informar esses dados o dono será redirecionado para a página principal do dono.

Caso o dono não queira fazer o login no aplicativo, basta clicar no botão "Voltar".

#### Página principal do dono

Nesta página serão apresentados todos os pets cadastrados por esse dono independente do seu Status. Bem como todas as ações possíveis com relação as informações dos pets.

Na primeira vez que o dono faz o login no aplicativo, por não haver nenhum pet cadastrado, será exibido uma área onde será disponibilizado o botão "Cadastrar animal perdido". Mesmo após o registro do primeiro pet, esse botão se manterá visivel para oa dono na página principal.

##### Botão "Cadastrar animal perdido"

Ao clicar nesse botão o dono será redirecionado para a página de cadastro do pet, onde será necessário informar os seguintes dados:

- Foto recente do pet
- Nome do pet
- Idade do pet
- Cidade onde o pet se perdeu
- Estado da cidade onde o pet se perdeu
- Informações auxiliares, onde o dono poderá informar caracteristicas únicas do pet e a forma como ele se perdeu

Após o cadastro basta que o dono clique no botão "Cadastrar" ou caso queira voltar para a página principal, basta clicar no botão "Voltar"

##### Cartão de informações do pet 

Na página principal, são exibidos todos os cartões de informação dos pets. 

Para cada cartão de informações do pet haveram três ações possíveis:

- Alterar dados, Onde o dono poderá modificar as informações relacionadas ao seu pet
- "Encontrei", ao clicar o status do pet será alterado para "Encontrado"
- "BOAS NOVAS!", quando este botão está presente no cartão, significa que algum Anjo tem informações sobre o pet, ao clicar nele o dono poderá visualiar o nome e telefone do Anjo

##### Menu superior botão do Dono

No menu superior, após o login haverá o botão do usuário, "Olá 'Dono'", ao clicar nele será mostrado duas opções:

- Alterar meus dados, onde o dono poderá realizar alterações nas suas informações
- Sair, ao clicar o dono sairá do sistema e retornará para a página de login

## Utilização da API para consulta de pets perdidos

Foi criada uma função no Animals controller para servir como API REST, que retorna todos os pets perdidos cadastrados no bancode dados.

Para utiliza-la basta acessar o endereço referente ao controller + apiConsulta + .json, em localhost ficaria assim:

"localhost/AnimalFinder/animals/apiConsulta.json"

O retorno será parecido com o exemplo abaixo:


    {
        "animaisPerdidos": [
            {
                "Animal": {
                    "id": "1",
                    "dono_id": "1",
                    "foto": "fotototó.jpg",
                    "nome": "totó",
                    "idade": "1",
                    "info": "Cachorro caramelo de focinho preto, estava passeando na rua e não voltou mais",
                    "cidade": "Mar\u00edlia",
                    "estado": "SP",
                    "status": "Perdido",
                    "anjo_nome": "Teste anjo",
                    "anjo_telefone": "(14) 996330891",
                    "created": "2020-04-16 04:53:22",
                    "modified": "2020-04-16 16:17:39",
                    "deleted": null
                },
                "Dono": {
                    "id": "1",
                    "nome": "Teste1",
                    "email": "teste1@t.com",
                    "telefone": "(14)996330892",
                    "password": "81dc9bdb52d04dc20036dbd8313ed055",
                    "created": "2020-04-15 13:34:59",
                    "modified": "2020-04-15 14:33:56",
                    "deleted": null
                }
            }
        ]
    }


## Issues e Melhorias

Este projeto foi desenvolvido exclusivamanente como processo seletivo para a vaga de desenvolvedor, devido ao prazo estabelecido e falta de experiência, nem todas as funcionalidades estão funcionando 100%

Listarei nessa seção os problemas encontrados e melhorias que podem ser feitas.

+ Issues
	+ Validação no campo foto da entidade Animal, a validação para este campo não está funcionando, permitindo que o Dono realize a inclusão de qualquer tipo de arquivo, além de imagens
+ Melhorias	
	+ As mensagens de notificação poderiam desaparecer após alguns segundos, liberando espaço em tela
	+ Utilização do dropzone.js no upload de imagens, dessa forma, além de facilitar o carregamento da foto, seria possível ter um preview da imagem
	+ Melhorias visuais, tanto nos formulários quanto nas páginas principais, foi utilizado o bootstrap, mas não foi possível aproveitar todo seu potêncial

## Considerações finais

Gostaria de agradecer pela oportunidade de mostrar um parte do meu conhecimento em programação, é claro que eu gostaria que o prazo fosse maior, mas entendo que na vida real nem sempre temos esse tempo e que precisamos nos virar com o que temos da melhor forma possível.

Gostei muito de participar desse processo seletivo, reaprendi muitas coisas que há tempos não utilizava e aprendi coisas novas também. Caso tenha tempo, continuarei a desenvolver esse projeto como forma terapêutica, pois acima de tudo foi muito divertido!!! E Também sei que há muito a ser melhorado.

Com certeza independente do resultado, estou muito satisfeito por ter participado, mas é claro que adoraria fazer parte da equipe Yapay.

Novamente muito obrigado!!!

