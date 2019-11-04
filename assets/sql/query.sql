CREATE TABLE usuarios
(
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  sobrenome VARCHAR(150) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL,
  cep VARCHAR(15),
  rua VARCHAR(100),
  complemento VARCHAR(100),
  bairro VARCHAR(100),
  cidade VARCHAR(100),
  estado VARCHAR(100),
  PRIMARY KEY(id)
);

CREATE TABLE pedidos
(
  id INT NOT NULL AUTO_INCREMENT,
  quantidade INT NOT NULL,
  valor DOUBLE(9,2) NOT NULL,
  usuario_id INT NOT NULL,
  produto_id INT NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE categorias
(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE produtos
(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    preco DOUBLE(9,2) NOT NULL,
    descricao VARCHAR(1000) NOT NULL,
    caracteristicas VARCHAR(500) NOT NULL,
    imagem VARCHAR(150) NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY(id)
);

ALTER TABLE pedidos ADD CONSTRAINT fk_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
ALTER TABLE pedidos ADD CONSTRAINT fk_produtos FOREIGN KEY (produto_id) REFERENCES produtos(id);
ALTER TABLE produtos ADD CONSTRAINT fk_categorias FOREIGN KEY (categoria_id) REFERENCES categorias(id);

INSERT INTO categorias (nome) VALUES
('Filmes'),
('Jogos'),
('Livros'),
('Revistas');

INSERT INTO produtos (nome, preco, descricao, caracteristicas, imagem, categoria_id) VALUES
(
    'O Senhor dos Aneis: A Sociedade do Anel',
    49.90,
    'Numa terra fantástica e única, chamada Terra-Média, um hobbit (seres de estatura entre 80 cm e 1,20 m, com pés peludos e bochechas um pouco avermelhadas) recebe de presente de seu tio o Um Anel, um anel mágico e maligno que precisa ser destruído antes que caia nas mãos do mal. Para isso o hobbit Frodo (Elijah Woods) terá um caminho árduo pela frente, onde encontrará perigo, medo e personagens bizarros. Ao seu lado para o cumprimento desta jornada aos poucos ele poderá contar com outros hobbits, um elfo, um anão, dois humanos e um mago, totalizando 9 pessoas que formarão a Sociedade do Anel.',
    '
    <p class="db-features"><strong>Lançamento </strong>2001</p>
    <p class="db-features"><strong>Duração:</strong> 2:58 min</p>
    <p class="db-features"><strong>Diretor:</strong> Peter Jackson</p>
    <p class="db-features"><strong>Distribuidora:</strong> Warner Home Video</p>
    <p class="db-features"><strong>Saga:</strong> Terra média</p>
    ',
    'o-senhor-dos-aneis-a-sociedade-do-anel',
    1
),
(
    'O Senhor dos Aneis: As Duas Torres',
    49.90,
    'Após a captura de Merry (Dominic Monaghan) e Pippy (Billy Boyd) pelos orcs, a Sociedade do Anel é dissolvida. Enquanto que Frodo (Elijah Wood) e Sam (Sean Astin) seguem sua jornada rumo à Montanha da Perdição para destruir o Um Anel, Aragorn (Viggo Mortensen), Legolas (Orlando Bloom) e Gimli (John Rhys-Davies) partem para resgatar os hobbits sequestrados.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2002</p>
    <p class="db-features"><strong>Duração:</strong> 2h59</p>
    <p class="db-features"><strong>Direção:</strong> Peter Jackson</p>
    <p class="db-features"><strong>Distribuidora:</strong> WARNER BROS.</p>
    <p class="db-features"><strong>Saga:</strong> Terra média</p>
    ',
    'o-senhor-dos-aneis-as-duas-torres',
    1
),
(
    'O Senhor dos Aneis: o Retorno do Rei',
    49.90,
    'Sauron planeja um grande ataque a Minas Tirith, capital de Gondor, o que faz com que Gandalf (Ian McKellen) e Pippin (Billy Boyd) partam para o local na intenção de ajudar a resistência. Um exército é reunido por Theoden (Bernard Hill) em Rohan, em mais uma tentativa de deter as forças de Sauron. Enquanto isso Frodo (Elijah Wood), Sam (Sean Astin) e Gollum (Andy Serkins) seguem sua viagem rumo à Montanha da Perdição, para destruir o Um Anel.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2003</p>
    <p class="db-features"><strong>Duração:</strong> 3h21</p>
    <p class="db-features"><strong>Direção:</strong> Peter Jackson</p>
    <p class="db-features"><strong>Distribuidora:</strong> WARNER BROS.</p>
    <p class="db-features"><strong>Saga:</strong> Terra Média</p>
    ',
    'o-senhor-dos-aneis-o-retorno-do-rei',
    1
),
(
    'Alien: O Oitavo Passageiro',
    39.90,
    'Uma nave espacial, ao retornar para Terra, recebe estranhos sinais vindos de um asteróide. Ao investigarem o local, um dos tripulantes é atacado por um estranho ser. O que parecia ser um ataque isolado se transforma em um terror constante, pois o tripulante atacado levou para dentro da nave o embrião de um alienígena, que não para de crescer e tem como meta matar toda a tripulação.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1979</p>
    <p class="db-features"><strong>Duração:</strong> 1h56min</p>
    <p class="db-features"><strong>Direção:</strong> Ridley Scott</p>
    <p class="db-features"><strong>Distribuidora:</strong> Fox Film do Brasil</p>
    <p class="db-features"><strong>Saga:</strong> Alien</p>
    ',
    'alien-o-oitavo-passageiro',
    1
),
(
    'Aliens: O Resgate',
    39.90,
    'Depois de um sono de cinquenta e sete anos, Ellen Ripley (Sigourney Weaver), a única sobrevivente da tragédia espacial, descobre que o local onde tudo ocorreu com sua nave foi colonizado por humanos. Inicialmente relutante, ela aceita retornar para enfrentar seu pior pesadelo e tentar salvar as setenta famílias que lá habitam.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1986</p>
    <p class="db-features"><strong>Duração:</strong> 2h17min</p>
    <p class="db-features"><strong>Direção:</strong> James Cameron</p>
    <p class="db-features"><strong>Distribuidora:</strong> DISNEY/BUENA VISTA</p>
    <p class="db-features"><strong>Saga:</strong> Aliens</p>
    ',
    'aliens-o-resgate',
    1
);

INSERT INTO produtos (nome, preco, descricao, caracteristicas, imagem, categoria_id) VALUES
(
    'The Last of Us',
    99.90,
    'Joel, um sobrevivente das zonas de quarentena, em guerra com o que sobrou dos militares e sobreviventes - que apesar da lei marcial imposta, atua no mercado negro da cidade, contrabandeando armas. Encarregado de levar Ellie, uma menina de quatorze anos de idade, com coragem além do comum, a um local designado em troca de armas, sem saber, o que começa como uma simples tarefa para entregar Ellie para outra zona de quarentena, logo se transforma em uma profunda jornada que irá mudar para sempre a vida dos dois.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2014</p>
    <p class="db-features"><strong>Plataforma:</strong> PS4</p>
    <p class="db-features"><strong>Desenvolvedora:</strong> Naughty Dog</p>
    <p class="db-features"><strong>Saga:</strong> The Last of Us</p>
    ',
    'the-last-of-us',
    2
),
(
    'The Elder Scrolls: Skyrim',
    79.90,
    'Vencedor de mais de 200 prêmios de Jogo do Ano, Skyrim Special Edition traz a fantasia épica à vida em detalhes impressionantes. A edição especial inclui o jogo aclamado pela crítica e add-ons com todos os novos recursos, como a arte remasterizada e efeitos, raios volumétricos, profundidade dinâmica de campo, reflexões de espaço, e muito mais. Skyrim Special Edition também traz o poder dos mods de PC para consoles. Novas missões, ambientes, personagens, diálogo, armaduras, armas e mais. Com Mods, não há limites para o que você pode experimentar.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2011</p>
    <p class="db-features"><strong>Plataforma:</strong> PS4</p>
    <p class="db-features"><strong>Desenvolvedora:</strong> Bethesda Game Studios</p>
    <p class="db-features"><strong>Saga:</strong> The Elder Scrolls</p>
    ',
    'the-elder-scrolls-skyrim',
    2
),
(
    'God of War (2018)',
    99.90,
    'Após se vingar dos deuses do Olimpo, Kratos agora vive como um mortal nas terras dos Deuses Nórdicos e monstros. É neste mundo inóspito e terrível que ele deve lutar para sobreviver… e ensinar o seu filho a fazer o mesmo.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2018</p>
    <p class="db-features"><strong>Plataforma:</strong> PS4</p>
    <p class="db-features"><strong>Desenvolvedora:</strong> SIE Santa Monica Studio</p>
    <p class="db-features"><strong>Saga:</strong> God of War</p>
    ',
    'god-of-war-2018',
    2
),
(
    'Rainbow Six: Siege',
    109.90,
    'Tom Clancys Rainbow Six Siege para Playstation 4 é a continuação da aclamada série de games FPS (tiro em primeira pessoa) da Ubisoft, baseada na literatura do autor norte americano Tom Clancy. O jogo retrata com fidelidade e gráficos incríveis o cotidiano da guerra entre agentes contra terroristas, e permite que você trave combates intensos em curta distância, em ambientes diversos bem trabalhados, que são verdadeiros campos de guerra para aprimorar mira, camuflagem, táticas FPS, trabalho em equipe e muita destruição.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2015</p>
    <p class="db-features"><strong>Plataforma:</strong> PS4</p>
    <p class="db-features"><strong>Desenvolvedora:</strong> Ubisoft Montreal</p>
    <p class="db-features"><strong>Saga:</strong> Tom Clancys</p>
    ',
    'rainbow-six-siege',
    2
),
(
    'Alien: Isolation',
    89.90,
    'Descubra o verdadeiro significado do medo em Alien: Isolation, um jogo de sobrevivência de horror que possui uma atmosfera constantemente temerosa e de perigo mortal. Quinze anos após os eventos de Alien, a filha de Ellen Ripley, Amanda, entra em uma batalha ensandecida pela sobrevivência com o objetivo de desvendar a verdade por trás do desaparecimento de sua mãe.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2014</p>
    <p class="db-features"><strong>Plataforma:</strong> PS4</p>
    <p class="db-features"><strong>Desenvolvedora:</strong> The Creative Assembly</p>
    <p class="db-features"><strong>Saga:</strong> Alien</p>
    ',
    'alien-isolation',
    2
);

INSERT INTO produtos (nome, preco, descricao, caracteristicas, imagem, categoria_id) VALUES
(
    'O Pequeno Príncipe',
    29.90,
    'A história começa com o narrador descrevendo suas recordações, em que aos 6 anos de idade fez um desenho de uma jiboia que havia engolido um elefante. Quando perguntava o que os adultos viam em seu desenho, todos eles achavam que o garoto havia desenhado um chapéu. Ao corrigir as pessoas sobre seu desenho, era sempre respondido que precisava de hobby mais sério e maduro. O narrador então lamenta a falta de criatividade demonstrada pelos adultos.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1943</p>
    <p class="db-features"><strong>Escritor:</strong> Antoine de Saint-Exupéry</p>
    <p class="db-features"><strong>Editora:</strong> Editora Agir</p>
    <p class="db-features"><strong>Páginas:</strong> 93</p>
    ',
    'o-pequeno-principe',
    3
),
(
    'O Menino do Pijama Listrado',
    39.90,
    'A história se passa durante o período do Holocausto, tendo como personagem principal, Bruno, filho de um militar alemão, que tem 8 anos e não sabe nada sobre o Holocausto e os horrores que aconteciam com os judeus. Também não faz ideia que seu país está em guerra com boa parte da Europa, e muito menos que sua família está envolvida no conflito. Na verdade, Bruno sabe apenas que foi obrigado a abandonar a espaçosa casa em que vivia em Berlim, perto de seus avós e a mudar-se para uma região isolada, onde ele não tem ninguém para brincar e nem nada para fazer. Da janela do quarto, Bruno pode ver uma cerca, e além dela centenas de pessoas vestidas de "pijama", que sempre o deixavam com frio na barriga. Em um de seus passeios Bruno conhece Shmuel, um garoto do outro lado da cerca, que curiosamente tem a mesma idade que ele.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2006</p>
    <p class="db-features"><strong>Escritor:</strong> John Boyne</p>
    <p class="db-features"><strong>Editora:</strong> Companhia das Letras</p>
    <p class="db-features"><strong>Páginas:</strong> 192</p>
    ',
    'o-menino-do-pijama-listrado',
    3
),
(
    'Jogos Vorazes',
    59.90,
    'Na abertura dos Jogos Vorazes, a organização não recolhe os corpos dos combatentes caídos e dá tiros de canhão até o final. Cada tiro, um morto. Onze tiros no primeiro dia. Treze jovens restaram, entre eles, Katniss. Para quem os tiros de canhão serão no dia seguinte?... Após o fim da América do Norte, uma nova nação chamada Panem surge. Formada por doze distritos, é comandada com mão de ferro pela Capital. Uma das formas com que demonstra seu poder sobre o resto do carente país é com Jogos Vorazes, uma competição anual transmitida ao vivo pela televisão, em que um garoto e uma garota de doze a dezoito anos de cada distrito são selecionados e obrigados a lutar até a morte! Para evitar que sua irmã seja a mais nova vítima do programa, Katniss se oferece para participar em seu lugar. Vinda do empobrecido Distrito 12, ela sabe como sobreviver em um ambiente hostil.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2010</p>
    <p class="db-features"><strong>Escritor:</strong> Suzanne Collins</p>
    <p class="db-features"><strong>Editora:</strong> Rocco</p>
    <p class="db-features"><strong>Páginas:</strong> 400</p>
    ',
    'jogos-vorazes',
    3
),
(
    'Em Chamas',
    59.90,
    'Depois da improvável e inusitada vitória de Katniss Everdeen e Peeta Mellark nos últimos Jogos Vorazes, algo parece ter mudado para sempre em Panem. Aqui e ali, distúrbios e agitações dão sinais de que uma revolta é iminente. Katniss e Peeta, representantes do paupérrimo Distrito 12, não apenas venceram os Jogos, mas ridicularizaram o governo e conseguiram fazer todos - incluindo o próprio Peeta - acreditarem que são um casal apaixonado. A confusão na cabeça de Katniss não é menor do que a das ruas. Em meio ao turbilhão, ela pensa cada vez mais em seu melhor amigo, o jovem caçador Gale, mas é obrigada a fingir que o romance com Peeta é real. Já o governo parece especialmente preocupado com a influência que os dois adolescentes vitoriosos - transformados em verdadeiros ídolos nacionais - podem ter na população. Por isso, existem planos especiais para mantê-los sob controle, mesmo que isso signifique forçá-los a lutar novamente.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2011</p>
    <p class="db-features"><strong>Escritor:</strong> Suzanne Collins</p>
    <p class="db-features"><strong>Editora:</strong> Rocco</p>
    <p class="db-features"><strong>Páginas:</strong> 416</p>
    ',
    'em-chamas',
    3
),
(
    'A Esperança',
    59.90,
    'FINALMENTE A SUBMISSÃO DARÁ LUGAR À LIBERDADE. SERÁ? Depois de sobreviver duas vezes à crueldade de uma arena projetada para destruí-la, Katniss acreditava que não precisaria mais lutar. Mas as regras do jogo mudaram: com a chegada dos rebeldes do lendário Distrito 13, enfim é possível organizar uma resistência. Começou a revolução. A coragem de Katniss nos jogos fez nascer a esperança em um país disposto a fazer de tudo para se livrar da opressão. E agora, contra a própria vontade, ela precisa assumir seu lugar como símbolo da causa rebelde. Ela precisa virar o Tordo.O sucesso da revolução dependerá de Katniss aceitar ou não essa responsabilidade. Será que vale a pena colocar sua família em risco novamente? Será que as vidas de Peeta e Gale serão os tributos exigidos nessa nova guerra?Acompanhe Katniss até o fim deste thriller, numa jornada ao lado mais obscuro da alma humana, em uma luta contra a opressão e a favor da esperança.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2012</p>
    <p class="db-features"><strong>Escritor:</strong> Suzanne Collins</p>
    <p class="db-features"><strong>Editora:</strong> Rocco</p>
    <p class="db-features"><strong>Páginas:</strong> 420</p>
    ',
    'a-esperança',
    3
);
INSERT INTO produtos (nome, preco, descricao, caracteristicas, imagem, categoria_id) VALUES
(
    'Piada Mortal',
    49.90,
    'Tudo começa quando o Batman, analisando a espiral de violência que permeava o contato de ambos, ao longo dos anos, e prevendo que isso poderia levar um ou ambos á morte, vai ao Asilo Arkham tentar dialogar com seu inimigo. Ao interrogá-lo, descobre que na verdade, o Joker fugiu mais uma vez do sanatório. Fora da prisão, o coringa arquiteta um plano para mostrar a todos o que a loucura, por mais simples que seja, pode fazer com um homem.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1988</p>
    <p class="db-features"><strong>Editora:</strong> Panini</p>
    <p class="db-features"><strong>Autor:</strong> Alan Moore</p>
    <p class="db-features"><strong>Ilustrador:</strong> Brian Bolland e John Higgins</p>
    ',
    'piada-mortal',
    4
),
(
    'Watchmen',
    109.90,
    'O ano é 1985. Os estados unidos são uma nação totalitária e fechada, isolada do resto do mundo. A presença de arsenais nucleares e dos chamados super-heróis mantém um certo equilíbrio entre as forças do planeta. Até que o relógio do fim do mundo começa a marchar para a meia-noite e a raça humana para um abismo sem-fim. A sombria e inigualável trama tem início com ilusões paranoicas do supostamente insano herói rorschach, um dos watchmen que patrulhavam os eua décadas atrás. Mas ele estaria realmente insano ou na verdade teria descoberto uma sórdida conspiração para assassinar super-heróis -- ou, pior ainda, milhões de civis inocentes?',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1897</p>
    <p class="db-features"><strong>Editora:</strong> Panini</p>
    <p class="db-features"><strong>Autor:</strong> Alan Moore</p>
    <p class="db-features"><strong>Ilustrador:</strong>	Dave Gibbons e John Higgins</p>
    ',
    'watchmen',
    4
),
(
    'A Ascensão de Thanos',
    109.90,
    'Na tentativa de atender aos desígnios de sua amada senhora, a Morte, Thanos traça um grandioso estratagema para subjugar as misteriosas entidades cósmicas conhecidas como Anciões e se apoderar das seis Joias do Infinito, artefatos que detêm o controle sobre todos os aspectos do universo. Ao reuni-las, o Titã Louco torna-se o ser mais poderoso do Universo Marvel. Com tamanho poder em mãos, Thanos extingue metade da vida no universo apenas para agradar sua adorada musa. E isso é só o começo. Se não for detido logo, o insano vilão niilista pode usar sua recém-adquirida onipotência para causar o fim do todo o espaço e o tempo. Uma épica saga cósmica que revolucionou a Casa das Ideias, com roteiros de Jim Starlin (A Morte do Capitão Marvel) e arte de Ron Lim e George Pérez. Este volume de 372 páginas reúne as edições The Thanos Quest 1-2 e Infinity Gauntlet 1-6.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 2018</p>
    <p class="db-features"><strong>Editora:</strong> Panini</p>
    <p class="db-features"><strong>Autor:</strong> Jim Starlin</p>
    <p class="db-features"><strong>Ilustrador:</strong> Ron Lim e George Pérez</p>
    ',
    'a-ascensao-de-thanos',
    4
),
(
    'Batman: Uma Morte em Família',
    69.90,
    'Era 1988, véspera do 50º aniversário do Batman, e os fãs tiveram uma oportunidade como nenhuma outra: decidir o destino de um personagem. Os leitores tinham a possibilidade de votar em dois desfechos para a história: manter inalterado o status de Batman e Robin, a Dupla Dinâmica, ou retornar o Homem-Morcego ao que era no início de sua carreira, um solitário e taciturno combatente do crime. A votação aconteceu, os resultados foram contabilizados e a escolha foi feita! Após sua maior derrota, Jason Todd – o Robin – foi assassinado pelo Coringa e Batman tornou-se uma vez mais o solitário protetor de Gotham City. Mas quais seriam as ramificações de uma tragédia como essa? O Cavaleiro das Trevas passaria a ser um vigilante mais dedicado à sua luta por justiça ou perderia o rumo, incapaz de se recuperar de uma derrota dessas?',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1988</p>
    <p class="db-features"><strong>Editora:</strong> Panini</p>
    <p class="db-features"><strong>Autor:</strong> Jim Starlin</p>
    <p class="db-features"><strong>Ilustrador:</strong> George Pérez e Jim Aparo</p>
    ',
    'batman-uma-morte-em-familia',
    4
),
(
    'Batman: O Cavaleiro das Trevas',
    159.90,
    'Escrita e desenhada por Frank Miller, a história, mostrando um Cavaleiro das Trevas envelhecido e amargurado voltando à ativa após anos de aposentadoria, ultrapassou as fronteiras do que se convencionava considerar "histórias em quadrinhos", estabelecendo novos parâmetros, tanto em narrativa como em temática, e influenciando tudo o que veio depois. Em 2001, Miller voltou a o distópico mundo criado por ele há quinze anos e deu continuidade ao clássico em uma nova minissérie, "O Cavaleiro das Trevas 2". O material, como não poderia deixar de ser, foi um sólido sucesso de vendas. Agora, esses dois marcos das HQs estão em um único volume, com acabamento de luxo e repleto de extras exclusivos, incluindo uma introdução escrita pelo autor, a proposta de Miller para o projeto original e um sem-número de esboços.',
    '
    <p class="db-features"><strong>Lançamento:</strong> 1986</p>
    <p class="db-features"><strong>Editora:</strong> Panini</p>
    <p class="db-features"><strong>Autor:</strong> Frank Miller</p>
    <p class="db-features"><strong>Ilustrador:</strong> Klaus Janson e Linn Varley.</p>
    ',
    'batman-o-cavaleiro-das-trevas',
    4
);
