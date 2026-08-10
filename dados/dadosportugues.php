<?php

// ======================================================
// PORTUGUÊS
// ======================================================


// ------------------------------------------------------
// CONTEÚDOS
// ------------------------------------------------------

$sql = <<<SQL
INSERT IGNORE INTO conteudo
(idConteudo, idMateria, nomeConteudo, explicacaoConteudo)
VALUES

(1, 1, 'Classes Gramaticais',
'As classes gramaticais são grupos que classificam as palavras de acordo com a função que elas desempenham na língua.

SUBSTANTIVO: palavra que dá nome a pessoas, animais, objetos, lugares, sentimentos, ideias e outros elementos. Exemplos: estudante, cachorro, escola e felicidade.

VERBO: indica uma ação, estado ou fenômeno da natureza. Exemplos: estudar, correr, ser, estar e chover.

ADJETIVO: caracteriza ou atribui uma qualidade a um substantivo. Exemplos: bonito, inteligente, rápido e azul.

PRONOME: substitui ou acompanha um substantivo. Exemplos: eu, você, ele, meu e aquele.

ADVÉRBIO: modifica o sentido de um verbo, adjetivo ou outro advérbio, indicando circunstâncias como tempo, lugar, modo ou intensidade. Exemplos: ontem, aqui, rapidamente e muito.'),

(2, 1, 'Verbos',
'Os verbos são palavras que indicam ações, estados, mudanças de estado ou fenômenos da natureza.

AÇÃO: correr, estudar, escrever.

ESTADO: ser, estar, parecer.

FENÔMENO DA NATUREZA: chover, nevar, trovejar.

Os verbos também podem indicar diferentes tempos.

PRESENTE: indica algo que acontece atualmente. Exemplo: Eu estudo.

PASSADO: indica algo que já aconteceu. Exemplo: Eu estudei.

FUTURO: indica algo que ainda acontecerá. Exemplo: Eu estudarei.'),

(3, 1, 'Figuras de Linguagem',
'Figuras de linguagem são recursos utilizados para tornar uma mensagem mais expressiva, criativa ou intensa.

METÁFORA: estabelece uma comparação indireta entre elementos. Exemplo: "Aquele menino é um leão." A ideia é que o menino é corajoso, e não que ele seja literalmente um leão.

COMPARAÇÃO: compara dois elementos utilizando palavras como "como", "tal qual" ou "assim como". Exemplo: "Ela é forte como um leão."

HIPÉRBOLE: apresenta um exagero proposital para enfatizar uma ideia. Exemplo: "Estou morrendo de fome."

IRONIA: apresenta uma ideia que pode ter sentido diferente ou contrário ao que as palavras literalmente dizem. Exemplo: dizer "Que ótimo!" quando algo deu muito errado.

PERSONIFICAÇÃO: atribui características ou ações humanas a animais, objetos ou elementos da natureza. Exemplo: "O vento cantava durante a noite."

ANTÍTESE: aproxima palavras ou ideias de sentidos opostos. Exemplo: "O amor e o ódio podem aparecer juntos."

EUFEMISMO: utiliza uma expressão mais suave para tratar de uma situação desagradável ou difícil. Exemplo: "Ele partiu" em vez de "Ele morreu."'),

(4, 1, 'Interpretação de Texto',
'A interpretação de texto consiste em compreender as informações e ideias apresentadas em um texto.

INFORMAÇÕES EXPLÍCITAS: aparecem claramente no texto.

INFORMAÇÕES IMPLÍCITAS: precisam ser compreendidas por meio da interpretação.

IDEIA PRINCIPAL: representa o assunto ou mensagem central do texto.

CONTEXTO: representa a situação em que o texto foi produzido.

Para interpretar um texto, é importante observar o título, as palavras utilizadas, as informações apresentadas e a relação entre as diferentes partes do texto.'),

(5, 1, 'Concordância Verbal',
'Concordância verbal é a relação entre o verbo e o sujeito da oração.

O verbo deve concordar com o sujeito em número e pessoa.

Exemplo no singular:
O aluno estudou para a prova.

Exemplo no plural:
Os alunos estudaram para a prova.

Quando o sujeito está no plural, normalmente o verbo também deve estar no plural.

Exemplo:
As meninas chegaram cedo.'),

(6, 1, 'Funções da Linguagem',
'As funções da linguagem representam diferentes objetivos que uma mensagem pode ter.

REFERENCIAL: transmite informações e fatos. É comum em notícias e textos informativos.

EMOTIVA: destaca sentimentos e opiniões do emissor.

CONATIVA: procura influenciar ou convencer o receptor. É comum em propagandas e campanhas.

FÁTICA: tem como objetivo estabelecer ou manter a comunicação. Exemplo: "Alô? Está me ouvindo?"

POÉTICA: valoriza a forma da mensagem, explorando palavras e recursos expressivos.

METALINGUÍSTICA: utiliza a linguagem para explicar a própria linguagem. Um dicionário é um exemplo.'),

(7, 1, 'Gêneros Textuais',
'Gêneros textuais são formas de texto utilizadas em diferentes situações de comunicação.

NOTÍCIA: apresenta informações sobre acontecimentos.

RECEITA: apresenta instruções para preparar algo.

PROPAGANDA: procura divulgar ou promover um produto, serviço ou ideia.

CRÔNICA: geralmente apresenta situações do cotidiano com uma abordagem reflexiva ou humorística.

ARTIGO DE OPINIÃO: apresenta o posicionamento do autor sobre determinado assunto.

CARTA: utilizada para estabelecer comunicação entre pessoas.'),

(8, 1, 'Variação Linguística',
'A língua portuguesa apresenta diferentes formas de uso dependendo da região, do grupo social, da situação e do contexto.

VARIAÇÃO REGIONAL: ocorre quando pessoas de diferentes regiões utilizam palavras ou expressões diferentes.

VARIAÇÃO SOCIAL: está relacionada aos diferentes grupos sociais.

VARIAÇÃO HISTÓRICA: acontece porque a língua muda ao longo do tempo.

VARIAÇÃO SITUACIONAL: depende do contexto. Em uma situação formal, por exemplo, podemos utilizar uma linguagem diferente daquela usada em uma conversa com amigos.

A existência de diferentes formas de falar não significa que uma pessoa não saiba português. É importante compreender o contexto em que cada variedade linguística é utilizada.')
SQL;

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Conteúdos de Português cadastrados.</p>";
} else {
    echo "<p>❌ Erro nos conteúdos de Português: " . mysqli_error($conexao) . "</p>";
}


// ------------------------------------------------------
// QUESTÕES
// ------------------------------------------------------

$sql = <<<SQL
INSERT IGNORE INTO questao
(idQuestao, idConteudo, enunciadoQuestao,
opcao1Questao, opcao2Questao, opcao3Questao, opcao4Questao,
respostaCorretaQuestao, statusQuestao, classificacaoQuestao, xpQuestao)
VALUES

(1, 1,
'Qual das alternativas apresenta um substantivo?',
'Correr',
'Escola',
'Rapidamente',
'Bonito',
2, 1, 'Fácil', 10),

(2, 1,
'Qual das alternativas apresenta um verbo?',
'Casa',
'Estudar',
'Bonito',
'Azul',
2, 1, 'Fácil', 10),

(3, 1,
'Na frase "O cachorro correu no parque", qual palavra é um substantivo?',
'Correu',
'Cachorro',
'No',
'Rapidamente',
2, 1, 'Fácil', 10),

(4, 1,
'Qual alternativa apresenta um adjetivo?',
'Inteligente',
'Estudar',
'Casa',
'Ontem',
1, 1, 'Fácil', 10),

(5, 2,
'Na frase "Maria estudou para a prova", qual é o verbo?',
'Maria',
'Prova',
'Estudou',
'Para',
3, 1, 'Fácil', 10),

(6, 2,
'Qual frase apresenta um verbo no passado?',
'Eu estudo todos os dias.',
'Eu estudarei amanhã.',
'Eu estudei ontem.',
'Eu estudo agora.',
3, 1, 'Médio', 15),

(7, 2,
'Qual alternativa apresenta apenas verbos?',
'Correr, estudar, escrever',
'Casa, escola, livro',
'Bonito, rápido, inteligente',
'Ontem, hoje, amanhã',
1, 1, 'Fácil', 10),

(8, 3,
'A frase "Estou morrendo de fome" apresenta qual figura de linguagem?',
'Metáfora',
'Ironia',
'Hipérbole',
'Antítese',
3, 1, 'Fácil', 10),

(9, 3,
'Na frase "Ela é forte como um leão", qual figura de linguagem aparece?',
'Comparação',
'Metáfora',
'Eufemismo',
'Ironia',
1, 1, 'Fácil', 10),

(10, 3,
'Na frase "O vento cantava durante a noite", qual figura de linguagem foi utilizada?',
'Antítese',
'Personificação',
'Hipérbole',
'Comparação',
2, 1, 'Médio', 15),

(11, 3,
'Aquele menino é um leão. Qual figura de linguagem foi utilizada?',
'Comparação',
'Metáfora',
'Eufemismo',
'Ironia',
2, 1, 'Médio', 15),

(12, 3,
'Qual figura de linguagem aproxima palavras ou ideias de sentidos opostos?',
'Metáfora',
'Antítese',
'Personificação',
'Hipérbole',
2, 1, 'Fácil', 10),

(13, 4,
'O que é uma informação explícita em um texto?',
'Uma informação que não aparece no texto.',
'Uma informação que pode ser encontrada claramente no texto.',
'Uma opinião criada pelo leitor.',
'Uma informação que contradiz o texto.',
2, 1, 'Fácil', 10),

(14, 4,
'O que representa a ideia principal de um texto?',
'Uma informação sem importância.',
'O assunto ou mensagem central do texto.',
'A última palavra do texto.',
'O nome do autor.',
2, 1, 'Fácil', 10),

(15, 5,
'Na frase "Os alunos estudaram para a prova", por que o verbo está no plural?',
'Porque o verbo sempre deve estar no plural.',
'Porque o sujeito "Os alunos" está no plural.',
'Porque a palavra "prova" está no singular.',
'Porque toda frase precisa ter verbo no plural.',
2, 1, 'Fácil', 10),

(16, 5,
'Qual frase apresenta concordância verbal correta?',
'Os alunos estudou.',
'As meninas chegou cedo.',
'O professor explicaram a matéria.',
'Os estudantes estudaram para a prova.',
4, 1, 'Fácil', 10),

(17, 6,
'Qual função da linguagem tem como principal objetivo transmitir informações e fatos?',
'Emotiva',
'Referencial',
'Poética',
'Conativa',
2, 1, 'Médio', 15),

(18, 6,
'Qual função da linguagem busca convencer ou influenciar o receptor?',
'Conativa',
'Fática',
'Referencial',
'Metalinguística',
1, 1, 'Médio', 15),

(19, 6,
'Qual função da linguagem está relacionada à expressão dos sentimentos do emissor?',
'Poética',
'Referencial',
'Emotiva',
'Fática',
3, 1, 'Médio', 15),

(20, 6,
'Um dicionário é um exemplo de uso de qual função da linguagem?',
'Emotiva',
'Conativa',
'Metalinguística',
'Fática',
3, 1, 'Médio', 15),

(21, 7,
'Qual gênero textual tem como principal objetivo informar sobre acontecimentos?',
'Receita',
'Notícia',
'Propaganda',
'Carta',
2, 1, 'Fácil', 10),

(22, 7,
'Qual gênero textual geralmente apresenta uma opinião sobre determinado assunto?',
'Artigo de opinião',
'Receita',
'Manual de instruções',
'Lista de compras',
1, 1, 'Fácil', 10),

(23, 7,
'Qual é o principal objetivo de uma propaganda?',
'Contar uma história fictícia.',
'Apresentar uma receita.',
'Divulgar ou promover um produto, serviço ou ideia.',
'Relatar uma experiência pessoal.',
3, 1, 'Fácil', 10),

(24, 8,
'O que caracteriza uma variação linguística regional?',
'O uso da língua muda de acordo com a região.',
'O idioma muda completamente.',
'A pessoa deixa de falar português.',
'A língua passa a ter apenas palavras estrangeiras.',
1, 1, 'Fácil', 10),

(25, 8,
'A linguagem utilizada em uma conversa entre amigos pode ser diferente daquela utilizada em uma situação formal. Isso representa uma variação:',
'Histórica',
'Regional',
'Situacional',
'Geográfica',
3, 1, 'Médio', 15)
SQL;

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Questões de Português cadastradas.</p>";
} else {
    echo "<p>❌ Erro nas questões de Português: " . mysqli_error($conexao) . "</p>";
}

?>