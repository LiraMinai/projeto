<?php

// ======================================================
// INGLÊS
// ======================================================


// ------------------------------------------------------
// CONTEÚDOS
// ------------------------------------------------------

$sql = <<<SQL
INSERT IGNORE INTO conteudo
(idConteudo, idMateria, nomeConteudo, explicacaoConteudo)
VALUES

(9, 2, 'Verb To Be',
'O verbo TO BE é um dos verbos mais importantes da língua inglesa. Ele pode significar SER ou ESTAR, dependendo do contexto.

No presente, suas principais formas são:

AM: utilizado com I.
Exemplo: I am a student.

IS: utilizado com HE, SHE e IT.
Exemplo: She is happy.

ARE: utilizado com YOU, WE e THEY.
Exemplo: They are students.

Forma afirmativa:
I am
You are
He is
She is
It is
We are
They are

O verbo to be pode ser usado para falar sobre identidade, características, estados e localização.'),

(10, 2, 'Personal Pronouns',
'Os pronomes pessoais são utilizados para representar pessoas, animais ou coisas sem precisar repetir seus nomes.

I = eu

YOU = você / vocês

HE = ele

SHE = ela

IT = ele/ela para objetos, animais ou situações

WE = nós

THEY = eles / elas

Exemplo:
Maria is a student.
She is a student.

Nesse exemplo, SHE substitui o nome Maria.'),

(11, 2, 'Simple Present',
'O Simple Present é utilizado principalmente para falar sobre hábitos, rotinas, fatos e situações que acontecem com frequência.

Exemplos:

I study every day.
Eu estudo todos os dias.

They play soccer.
Eles jogam futebol.

Com HE, SHE e IT, geralmente acrescentamos S ao verbo.

I work.
She works.

I play.
He plays.

Alguns verbos possuem alterações específicas, como:

go → goes
study → studies
watch → watches.'),

(12, 2, 'Simple Past',
'O Simple Past é utilizado para falar sobre ações que aconteceram e terminaram no passado.

Nos verbos regulares, normalmente acrescentamos ED.

PLAY → PLAYED
WORK → WORKED
STUDY → STUDIED

Exemplo:
I studied yesterday.
Eu estudei ontem.

Alguns verbos são irregulares e não seguem essa regra.

GO → WENT
EAT → ATE
SEE → SAW
HAVE → HAD

Exemplo:
I went to school yesterday.
Eu fui à escola ontem.'),

(13, 2, 'Present Continuous',
'O Present Continuous é utilizado para falar sobre ações que estão acontecendo no momento da fala ou em um período atual.

A estrutura básica é:

SUJEITO + VERBO TO BE + VERBO COM ING

Exemplos:

I am studying.
Eu estou estudando.

She is reading.
Ela está lendo.

They are playing.
Eles estão jogando.

O verbo principal recebe ING, enquanto o verbo to be muda de acordo com o sujeito.'),

(14, 2, 'Vocabulary',
'Vocabulary significa vocabulário. Aprender vocabulário é importante para compreender textos e se comunicar em inglês.

Algumas palavras básicas:

HOUSE = casa
SCHOOL = escola
BOOK = livro
TEACHER = professor(a)
STUDENT = estudante
FRIEND = amigo(a)
WATER = água
FOOD = comida
DOG = cachorro
CAT = gato

Também é importante aprender palavras relacionadas a situações do cotidiano, como escola, família, comida, lugares e atividades.'),

(15, 2, 'Reading Comprehension',
'Reading comprehension significa interpretação de texto.

Para compreender um texto em inglês, não é necessário conhecer todas as palavras. É possível utilizar o contexto para entender a ideia geral.

Algumas estratégias importantes:

IDENTIFICAR O TEMA: descubra sobre o que o texto fala.

PROCURAR PALAVRAS CONHECIDAS: palavras parecidas com o português ou que você já conhece podem ajudar.

OBSERVAR O CONTEXTO: analise as palavras ao redor de um termo desconhecido.

IDENTIFICAR INFORMAÇÕES IMPORTANTES: procure nomes, lugares, datas e ações.

O objetivo é compreender a mensagem principal do texto, e não necessariamente traduzir cada palavra.')
SQL;

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Conteúdos de Inglês cadastrados.</p>";
} else {
    echo "<p>❌ Erro nos conteúdos de Inglês: " . mysqli_error($conexao) . "</p>";
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

(26, 9,
'Complete the sentence: "I ___ a student."',
'am',
'is',
'are',
'be',
1, 1, 'Fácil', 10),

(27, 9,
'Complete: "She ___ happy."',
'am',
'are',
'is',
'be',
3, 1, 'Fácil', 10),

(28, 9,
'Which sentence is correct?',
'They is students.',
'They are students.',
'They am students.',
'They be students.',
2, 1, 'Fácil', 10),

(29, 9,
'What is the correct form of the verb to be with "we"?',
'am',
'is',
'are',
'be',
3, 1, 'Fácil', 10),

(30, 10,
'Which pronoun means "ela" in English?',
'He',
'She',
'They',
'We',
2, 1, 'Fácil', 10),

(31, 10,
'Which pronoun means "nós" in English?',
'I',
'They',
'We',
'You',
3, 1, 'Fácil', 10),

(32, 10,
'Complete: "Maria is my friend. ___ is very nice."',
'He',
'She',
'They',
'We',
2, 1, 'Fácil', 10),

(33, 11,
'Choose the correct sentence:',
'She play soccer every day.',
'She plays soccer every day.',
'She playing soccer every day.',
'She played soccer every day.',
2, 1, 'Médio', 15),

(34, 11,
'Which sentence is in the Simple Present?',
'I am studying now.',
'She studies every day.',
'They studied yesterday.',
'He will study tomorrow.',
2, 1, 'Fácil', 10),

(35, 11,
'Complete: "He ___ to school every day."',
'go',
'going',
'goes',
'went',
3, 1, 'Médio', 15),

(36, 12,
'What is the past form of "play"?',
'plays',
'playing',
'played',
'play',
3, 1, 'Fácil', 10),

(37, 12,
'What is the past form of "go"?',
'goed',
'went',
'goes',
'going',
2, 1, 'Fácil', 10),

(38, 12,
'Which sentence is in the Simple Past?',
'I go to school every day.',
'She is studying now.',
'They played soccer yesterday.',
'He plays soccer every week.',
3, 1, 'Fácil', 10),

(39, 13,
'Complete: "I ___ studying now."',
'is',
'are',
'am',
'be',
3, 1, 'Fácil', 10),

(40, 13,
'Which sentence is in the Present Continuous?',
'She studies every day.',
'She studied yesterday.',
'She is studying now.',
'She will study tomorrow.',
3, 1, 'Médio', 15),

(41, 14,
'What does "book" mean?',
'Casa',
'Livro',
'Escola',
'Professor',
2, 1, 'Fácil', 10),

(42, 14,
'What does "teacher" mean?',
'Estudante',
'Amigo',
'Professor(a)',
'Livro',
3, 1, 'Fácil', 10),

(43, 14,
'What does "water" mean?',
'Comida',
'Água',
'Casa',
'Gato',
2, 1, 'Fácil', 10),

(44, 15,
'What does "Reading Comprehension" mean?',
'Produção de texto',
'Interpretação de texto',
'Gramática',
'Pronúncia',
2, 1, 'Fácil', 10),

(45, 15,
'When reading an English text, what can help you understand an unknown word?',
'Ignoring the entire text.',
'Looking at the context.',
'Translating only the title.',
'Reading only the last sentence.',
2, 1, 'Médio', 15)
SQL;

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Questões de Inglês cadastradas.</p>";
} else {
    echo "<p>❌ Erro nas questões de Inglês: " . mysqli_error($conexao) . "</p>";
}

?>