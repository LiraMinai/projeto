<?php

// ======================================================
// ESPANHOL
// ======================================================

$resultado = $conexao->query("
    SHOW COLUMNS FROM conteudo LIKE 'explicacaoConteudo'
");

if ($resultado->num_rows == 0) {
    $conexao->query("ALTER TABLE conteudo ADD explicacaoConteudo TEXT");
} else {
    // garante que a coluna comporta os textos longos
    $conexao->query("ALTER TABLE conteudo MODIFY COLUMN explicacaoConteudo TEXT");
}

// ------------------------------------------------------
// CONTEÚDOS
// ------------------------------------------------------

$sql = <<<SQL



INSERT INTO conteudo
(idConteudo, idMateria, nomeConteudo, explicacaoConteudo)
VALUES

(16, '3', 'El alfabeto y la pronunciación',
'O alfabeto espanhol é formado por 27 letras, incluindo a letra Ñ, que não existe no alfabeto português. Apesar de os dois idiomas compartilharem muitas letras, existem diferenças importantes na pronúncia de algumas delas.

A letra Ñ representa um som próprio do espanhol e aparece em palavras como niño (menino), mañana (amanhã) e español (espanhol). Já a letra H não é pronunciada, como acontece nas palavras hola (olá), hablar (falar) e hermano (irmão).

A letra J costuma apresentar um som forte, como em jardín (jardim) e jugar (brincar). A pronúncia de algumas letras também pode variar de acordo com a região. Por exemplo, o som de LL pode ser semelhante ao da letra Y em muitas variedades do espanhol.

Outra característica importante é que a pronúncia nem sempre funciona exatamente como em português. Por isso, ouvir falantes do idioma, ler palavras em voz alta e prestar atenção aos sons são boas maneiras de desenvolver a compreensão e a pronúncia. Com a prática, fica mais fácil reconhecer as palavras e entender conversas em espanhol.'),

(17, '3', 'Saludos y despedidas',
'Os cumprimentos e as despedidas são expressões utilizadas diariamente para iniciar e encerrar conversas. Em espanhol, essas expressões variam de acordo com o horário, a situação e o grau de intimidade entre as pessoas.

Entre os cumprimentos mais comuns estão hola (olá), buenos días (bom dia), buenas tardes (boa tarde) e buenas noches (boa noite). Normalmente, usamos buenos días pela manhã, buenas tardes à tarde e buenas noches à noite. A expressão hola pode ser utilizada em diferentes momentos do dia.

Para perguntar como alguém está, podemos dizer ¿cómo estás?, em situações informais, ou ¿cómo está usted?, em situações mais formais. A escolha depende da pessoa com quem estamos conversando.

As despedidas também possuem diferentes formas. Podemos utilizar adiós (adeus), hasta luego (até logo), hasta mañana (até amanhã) e nos vemos (a gente se vê). A expressão hasta mañana é adequada quando esperamos encontrar a pessoa novamente no dia seguinte.

Conhecer essas expressões ajuda a participar de conversas simples, cumprimentar pessoas e se comunicar em situações cotidianas, como na escola, em viagens e em encontros com falantes de espanhol.'),

(18, '3', 'Pronombres personales',
'Os pronomes pessoais são palavras utilizadas para indicar quem realiza uma ação ou de quem estamos falando. Eles são importantes para construir frases e compreender quem participa de uma conversa.

Em espanhol, os principais pronomes pessoais são yo (eu), tú (tu/você), él (ele), ella (ela), usted (forma de tratamento), nosotros e nosotras (nós), vosotros e vosotras (vocês, principalmente na Espanha), ellos e ellas (eles e elas) e ustedes (vocês).

Cada pronome está relacionado a determinadas formas verbais. Por exemplo, Yo estudio español significa Eu estudo espanhol. Já Ella habla inglés significa Ela fala inglês. Nos dois casos, o pronome indica quem realiza a ação.

O uso de tú é comum em situações informais. Usted é utilizado em diversas situações formais ou para demonstrar respeito. Na Espanha, vosotros e vosotras são usados frequentemente para falar informalmente com várias pessoas. Na América Latina, ustedes é a forma mais comum para se dirigir a um grupo.

Uma característica interessante do espanhol é que o pronome pode ser omitido quando a conjugação do verbo deixa claro quem realiza a ação. Assim, Yo hablo español e Hablo español podem transmitir a mesma informação. O pronome pode ser utilizado para dar ênfase ou evitar ambiguidades.'),

(19, '3', 'Artículos y sustantivos',
'Os substantivos são palavras que nomeiam pessoas, animais, objetos, lugares, sentimentos e ideias. Alguns exemplos em espanhol são estudiante (estudante), perro (cachorro), libro (livro), escuela (escola) e amistad (amizade).

Os artigos acompanham os substantivos e ajudam a indicar se estamos falando de algo específico ou não. Eles são divididos em definidos e indefinidos. Os artigos definidos são el, la, los e las, equivalentes a o, a, os e as. Podemos observar seu uso em el libro (o livro), la casa (a casa) e los estudiantes (os estudantes).

Os artigos indefinidos são un, una, unos e unas, equivalentes a um, uma, uns e umas. Alguns exemplos são un amigo (um amigo), una mochila (uma mochila) e unas flores (algumas flores).

Em espanhol, os substantivos possuem gênero gramatical, masculino ou feminino, e número, singular ou plural. Muitos substantivos terminados em -o são masculinos, enquanto muitos terminados em -a são femininos. Entretanto, existem exceções, como el día (o dia) e la mano (a mão).

Para formar o plural, normalmente acrescentamos -s às palavras terminadas em vogal, como casa e casas. Nas palavras terminadas em consoante, geralmente acrescentamos -es, como papel e papeles. Aprender a combinar artigos e substantivos ajuda a construir frases mais claras e gramaticalmente corretas.'),

(20, '3', 'Género y número de los adjetivos',
'Os adjetivos são palavras utilizadas para descrever características de pessoas, animais, objetos e lugares. Eles podem indicar tamanho, aparência, personalidade, estado ou outras qualidades. Alguns exemplos em espanhol são pequeño (pequeno), bonito (bonito), alto (alto), inteligente (inteligente) e feliz (feliz).

Em espanhol, os adjetivos geralmente concordam com o substantivo em gênero e número. Isso significa que a forma do adjetivo pode mudar de acordo com o substantivo que está sendo descrito.

Por exemplo, podemos dizer niño pequeño (menino pequeno) e niña pequeña (menina pequena). No plural, as formas passam a ser niños pequeños e niñas pequeñas. Nesse caso, o adjetivo muda para concordar com o gênero e o número do substantivo.

Muitos adjetivos terminados em -o formam o feminino com a terminação -a, como alto e alta. Para formar o plural, geralmente acrescentamos -s quando a palavra termina em vogal, como bonito e bonitos.

Entretanto, nem todos os adjetivos mudam de forma no feminino. Palavras como inteligente e feliz podem ser utilizadas tanto para o masculino quanto para o feminino. Por exemplo: un estudiante inteligente e una estudiante inteligente.

Observar a concordância entre substantivos e adjetivos é essencial para descrever pessoas e objetos corretamente. A leitura de frases e a prática com exemplos ajudam a reconhecer essas diferenças.'),

(21, '3', 'Verbos ser, estar y tener',
'Os verbos ser, estar e tener são muito utilizados em espanhol. Apesar de algumas semelhanças com o português, cada um possui funções específicas, e escolher o verbo adequado depende do significado da frase.

O verbo ser pode indicar identidade, profissão, origem e características. Por exemplo, Soy estudiante significa Sou estudante, e Ella es brasileña significa Ela é brasileira. Também podemos utilizá-lo para apresentar características, como em El edificio es grande (O edifício é grande).

O verbo estar é utilizado principalmente para indicar localização, estados e situações. Na frase Estoy en casa, o significado é Estou em casa. Em Estoy cansado, a ideia é Estou cansado. A escolha entre ser e estar depende do contexto e daquilo que queremos expressar.

Já o verbo tener significa ter e pode indicar posse, idade e algumas sensações. Por exemplo, Tengo un libro significa Tenho um livro, e Tengo quince años significa Tenho quinze anos. A expressão Tengo hambre significa Estou com fome, embora sua tradução literal seja Tenho fome.

Esses verbos apresentam conjugações diferentes. No presente, temos yo soy, tú eres e él es para o verbo ser; yo estoy, tú estás e él está para estar; e yo tengo, tú tienes e él tiene para tener.

Aprender as conjugações e observar exemplos em frases completas facilita a compreensão. Esses três verbos são essenciais para apresentações pessoais, descrições e conversas do cotidiano.'),

(22, '3', 'Presente de indicativo',
'O presente do indicativo é utilizado para falar de ações que acontecem no momento, hábitos, rotinas e fatos gerais. Ele aparece frequentemente em conversas sobre estudos, trabalho, família, preferências e atividades diárias.

Por exemplo, Estudio español todos los días significa Estudo espanhol todos os dias. A frase Mi hermano trabaja por la mañana significa Meu irmão trabalha pela manhã. Nos dois casos, os verbos expressam ações ou hábitos no presente.

Os verbos regulares em espanhol são divididos em três grupos, de acordo com a terminação do infinitivo: -ar, -er e -ir. Para conjugá-los, retiramos a terminação do infinitivo e acrescentamos a terminação correspondente à pessoa.

O verbo hablar (falar), por exemplo, é conjugado como yo hablo, tú hablas, él habla, nosotros hablamos e ellos hablan. O verbo comer (comer) fica yo como, tú comes, él come, nosotros comemos e ellos comen. Já o verbo vivir (viver) fica yo vivo, tú vives, él vive, nosotros vivimos e ellos viven.

As terminações mudam conforme o sujeito. Por isso, é importante observar quem realiza a ação para escolher a forma correta do verbo. Por exemplo, decimos yo hablo, mas ellos hablan.

Existem também verbos irregulares, que apresentam alterações na conjugação. Um exemplo é tener, que fica yo tengo e tú tienes. Conhecer as regras gerais e praticar os verbos em frases completas ajuda a expressar ações e hábitos com mais segurança.'),

(23, '3', 'Comprensión e interpretación de textos',
'A compreensão e a interpretação de textos são habilidades importantes para entender mensagens escritas em espanhol. Elas permitem identificar o assunto de um texto, localizar informações e compreender o que o autor deseja transmitir.

Uma boa estratégia é começar pelo título e observar as palavras que já conhecemos. Muitas vezes, o título apresenta uma pista sobre o tema principal. Também é útil prestar atenção às palavras que aparecem várias vezes e às informações apresentadas em cada parágrafo.

Não é necessário conhecer todas as palavras para compreender um texto. O contexto pode ajudar a descobrir o significado aproximado de termos desconhecidos. Por exemplo, se um texto menciona uma escuela (escola), profesores (professores), estudiantes (estudantes) e clases (aulas), podemos deduzir que o assunto está relacionado à educação.

Durante a leitura, podemos procurar informações como quem participa da situação, onde ela acontece, quando ocorre e qual é o objetivo do texto. Algumas produções têm a intenção de informar, outras contam histórias, descrevem situações ou procuram convencer o leitor.

Também é importante diferenciar uma informação apresentada diretamente no texto de uma conclusão que precisamos deduzir. Essa habilidade é útil para responder a perguntas de interpretação e compreender mensagens que não estão totalmente explícitas.

Ler diálogos, notícias, anúncios, contos e outros textos em espanhol ajuda a ampliar o vocabulário e reconhecer diferentes formas de expressão. Com a prática, torna-se mais fácil identificar as ideias principais e compreender o sentido geral sem traduzir cada palavra.' )

ON DUPLICATE KEY UPDATE
    idMateria = VALUES(idMateria),
    nomeConteudo = VALUES(nomeConteudo),
    explicacaoConteudo = VALUES(explicacaoConteudo)

SQL;

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Conteúdos de Espanhol cadastrados.</p>";
} else {
    echo "<p>❌ Erro nos conteúdos de Espanhol: " . mysqli_error($conexao) . "</p>";
}

// ------------------------------------------------------
// QUESTÕES
// ------------------------------------------------------


$sql = <<<SQL

-- =============================================
-- ESPANHOL: QUESTÕES
-- =============================================

INSERT INTO questao
(idQuestao, idConteudo, enunciadoQuestao,
 opcao1Questao, opcao2Questao, opcao3Questao,
 opcao4Questao, respostaCorretaQuestao,
 statusQuestao, classificacaoQuestao, xpQuestao)
VALUES

-- CONTEÚDO 16: ALFABETO Y PRONUNCIACIÓN

(46, 16, '¿Qué letra representa un sonido propio del español?',
'La letra B',
'La letra Ñ',
'La letra M',
'La letra T',
2, 'ativa', 'Fácil', 10),

(47, 16, '¿Cuál de estas palabras tiene una H que no se pronuncia?',
'Hola',
'Casa',
'Mesa',
'Libro',
1, 'ativa', 'Fácil', 10),

(48, 16, '¿Qué palabra contiene la letra Ñ?',
'Perro',
'Gato',
'Niño',
'Libro',
3, 'ativa', 'Médio', 15),

-- CONTEÚDO 17: SALUDOS Y DESPEDIDAS

(49, 17, '¿Qué expresión se utiliza normalmente por la mañana?',
'Buenas noches',
'Buenos días',
'Hasta mañana',
'Adiós',
2, 'ativa', 'Fácil', 10),

(50, 17, '¿Cuál es una forma de despedirse?',
'Hola',
'Buenos días',
'Hasta luego',
'Buenas tardes',
3, 'ativa', 'Fácil', 10),

(51, 17, '¿Qué saludo es adecuado por la noche?',
'Buenas noches',
'Buenos días',
'Buenas tardes',
'Hasta mañana',
1, 'ativa', 'Médio', 15),

-- CONTEÚDO 18: PRONOMBRES PERSONALES

(52, 18, '¿Qué pronombre personal corresponde a la primera persona del singular?',
'Tú',
'Él',
'Yo',
'Ella',
3, 'ativa', 'Fácil', 10),

(53, 18, '¿Qué pronombre puede sustituir a María?',
'Nosotros',
'Ella',
'Vosotros',
'Ellos',
2, 'ativa', 'Fácil', 10),

(54, 18, '¿Cuál es un pronombre de primera persona del plural?',
'Yo',
'Tú',
'Él',
'Nosotros',
4, 'ativa', 'Médio', 15),

-- CONTEÚDO 19: ARTÍCULOS Y SUSTANTIVOS

(55, 19, '¿Cuál es el artículo definido de "libro"?',
'La',
'Los',
'El',
'Las',
3, 'ativa', 'Fácil', 10),

(56, 19, '¿Cuál es el plural correcto de "la flor"?',
'Las flores',
'La flores',
'Los flor',
'Unas flor',
1, 'ativa', 'Fácil', 10),

(57, 19, '¿Qué opción contiene un artículo indefinido?',
'El libro',
'La mesa',
'Los perros',
'Una casa',
4, 'ativa', 'Médio', 15),

-- CONTEÚDO 20: GÉNERO Y NÚMERO DE LOS ADJETIVOS

(58, 20, '¿Cuál es la forma correcta para describir a una niña?',
'Niña pequeño',
'Niña pequeña',
'Niña pequeños',
'Niña pequeñas',
2, 'ativa', 'Fácil', 10),

(59, 20, '¿Cuál es el plural de "alto"?',
'Alta',
'Alto',
'Altos',
'Altas',
3, 'ativa', 'Fácil', 10),

(60, 20, '¿Qué adjetivo mantiene la misma forma para masculino y femenino en "un estudiante..." y "una estudiante..."?',
'Pequeño',
'Bonito',
'Inteligente',
'Alto',
3, 'ativa', 'Médio', 15),

-- CONTEÚDO 21: VERBOS SER, ESTAR Y TENER

(61, 21, '¿Qué verbo completa la frase "Yo ___ estudiante"?',
'Está',
'Tengo',
'Soy',
'Eres',
3, 'ativa', 'Fácil', 10),

(62, 21, '¿Qué verbo completa la frase "María ___ en casa"?',
'Es',
'Está',
'Tiene',
'Soy',
2, 'ativa', 'Fácil', 10),

(63, 21, '¿Qué verbo completa la frase "Nosotros ___ dos libros"?',
'Somos',
'Estamos',
'Tenemos',
'Tienen',
3, 'ativa', 'Médio', 15),

-- CONTEÚDO 22: PRESENTE DE INDICATIVO

(64, 22, '¿Cuál es la conjugación correcta de "hablar" con "yo"?',
'Yo hablas',
'Yo habla',
'Yo hablo',
'Yo hablan',
3, 'ativa', 'Fácil', 10),

(65, 22, 'Completa: "Ellos ___ en Madrid". (vivir)',
'Vivo',
'Vives',
'Vivimos',
'Viven',
4, 'ativa', 'Fácil', 10),

(66, 22, 'Completa: "Tú ___ una manzana". (comer)',
'Como',
'Comes',
'Come',
'Comemos',
2, 'ativa', 'Médio', 15),

-- CONTEÚDO 23: COMPRENSIÓN E INTERPRETACIÓN

(67, 23, '¿Qué debemos identificar primero para comprender un texto?',
'El tema principal',
'La última letra',
'El número de páginas',
'El color del papel',
1, 'ativa', 'Fácil', 10),

(68, 23, '¿Qué puede ayudarnos a comprender una palabra desconocida?',
'Ignorar todo el texto',
'El contexto de la frase',
'Leer solamente el título',
'Contar las letras',
2, 'ativa', 'Fácil', 10),

(69, 23, '¿Qué podemos descubrir al interpretar un texto?',
'Únicamente su longitud',
'Solamente el número de palabras',
'Su tema y la intención del autor',
'El color de la pantalla',
3, 'ativa', 'Médio', 15)

ON DUPLICATE KEY UPDATE
    idConteudo = VALUES(idConteudo),
    enunciadoQuestao = VALUES(enunciadoQuestao),
    opcao1Questao = VALUES(opcao1Questao),
    opcao2Questao = VALUES(opcao2Questao),
    opcao3Questao = VALUES(opcao3Questao),
    opcao4Questao = VALUES(opcao4Questao),
    respostaCorretaQuestao = VALUES(respostaCorretaQuestao),
    statusQuestao = VALUES(statusQuestao),
    classificacaoQuestao = VALUES(classificacaoQuestao),
    xpQuestao = VALUES(xpQuestao)

SQL;

if (mysqli_query($conexao, $sql)) {
    echo "<p>✓ Questões de Espanhol cadastradas.</p>";
} else {
    echo "<p>❌ Erro nas questões de Espanhol: " . mysqli_error($conexao) . "</p>";
}

?>