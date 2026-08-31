const CAMINHO_IMAGENS = "pixelArt/";
 
const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d");
 
ctx.imageSmoothingEnabled = false;
 
const fundo = new Image();
const corpo = new Image();
const corpoContorno = new Image();
const vitiligo = new Image();
const olhos = new Image();
const pupila = new Image();
const pupilaDireita = new Image();
 
fundo.src = CAMINHO_IMAGENS + "Fundo.png";
corpo.src = CAMINHO_IMAGENS + "corpo.png";
corpoContorno.src = CAMINHO_IMAGENS + "corpoContorno.png";
vitiligo.src = CAMINHO_IMAGENS + "vitiligo.png";
olhos.src = CAMINHO_IMAGENS + "olhos.png";
pupila.src = CAMINHO_IMAGENS + "pupila.png";
pupilaDireita.src = CAMINHO_IMAGENS + "pupilaDireita.png";
 
const cabelos = {
    nenhum: null,
    cabeloCrespo: new Image(),
    cabeloCurto: new Image(),
    cabeloMedio: new Image(),
    cabeloLongo: new Image(),
    cabeloRaspado: new Image(),
    cabeloRaspadoLateral: new Image()
};
 
const cabelosContorno = {
    nenhum: null,
    cabeloCrespo: new Image(),
    cabeloCurto: new Image(),
    cabeloMedio: new Image(),
    cabeloLongo: new Image(),
    cabeloRaspado: new Image(),
    cabeloRaspadoLateral: new Image()
};
 
const roupasSuperiores = {
    nenhuma: null,
    camisaAmarela: new Image(),
    camisaAzul: new Image(),
    camisaBranca: new Image(),
    camisaPreta: new Image(),
    camisaRoxa: new Image(),
    camisaVerde: new Image(),
    camisaVermelha: new Image(),
    camisetaAmarela: new Image(),
    camisetaAzul: new Image(),
    camisetaBranca: new Image(),
    camisetaPreta: new Image(),
    camisetaRoxa: new Image(),
    camisetaVerde: new Image(),
    camisetaVermelha: new Image()
};
 
const roupasInferiores = {
    nenhuma: null,
    bermudaAzul: new Image(),
    bermudaBranca: new Image(),
    bermudaMarrom: new Image(),
    bermudaPreta: new Image(),
    calcaAzul: new Image(),
    calcaBranca: new Image(),
    calcaMarrom: new Image(),
    calcaPreta: new Image()
};
 
const sapatos = {
    nenhum: null,
    sapatoAzul: new Image(),
    sapatoBranco: new Image(),
    sapatoMarrom: new Image(),
    sapatoVermelho: new Image(),
    sapatoPreto: new Image()
};
 
cabelos.cabeloCrespo.src = CAMINHO_IMAGENS + "cabeloCrespo.png";
cabelos.cabeloCurto.src = CAMINHO_IMAGENS + "cabeloCurto.png";
cabelos.cabeloMedio.src = CAMINHO_IMAGENS + "cabeloMedio.png";
cabelos.cabeloLongo.src = CAMINHO_IMAGENS + "cabeloLongo.png";
cabelos.cabeloRaspado.src = CAMINHO_IMAGENS + "cabeloRaspado.png";
cabelos.cabeloRaspadoLateral.src = CAMINHO_IMAGENS + "cabeloRaspadoLateral.png";
 
cabelosContorno.cabeloCrespo.src = CAMINHO_IMAGENS + "cabeloCrespoContorno.png";
cabelosContorno.cabeloCurto.src = CAMINHO_IMAGENS + "cabeloCurtoContorno.png";
cabelosContorno.cabeloMedio.src = CAMINHO_IMAGENS + "cabeloMedioContorno.png";
cabelosContorno.cabeloLongo.src = CAMINHO_IMAGENS + "cabeloLongoContorno.png";
cabelosContorno.cabeloRaspado.src = CAMINHO_IMAGENS + "cabeloRaspadoContorno.png";
cabelosContorno.cabeloRaspadoLateral.src = CAMINHO_IMAGENS + "cabeloRaspadoLateralContorno.png";
 
roupasSuperiores.camisaAmarela.src = CAMINHO_IMAGENS + "camisaAmarela.png";
roupasSuperiores.camisaAzul.src = CAMINHO_IMAGENS + "camisaAzul.png";
roupasSuperiores.camisaBranca.src = CAMINHO_IMAGENS + "camisaBranca.png";
roupasSuperiores.camisaPreta.src = CAMINHO_IMAGENS + "camisaPreta.png";
roupasSuperiores.camisaRoxa.src = CAMINHO_IMAGENS + "camisaRoxa.png";
roupasSuperiores.camisaVerde.src = CAMINHO_IMAGENS + "camisaVerde.png";
roupasSuperiores.camisaVermelha.src = CAMINHO_IMAGENS + "camisaVermelha.png";
roupasSuperiores.camisetaAmarela.src = CAMINHO_IMAGENS + "camisetaAmarela.png";
roupasSuperiores.camisetaAzul.src = CAMINHO_IMAGENS + "camisetaAzul.png";
roupasSuperiores.camisetaBranca.src = CAMINHO_IMAGENS + "camisetaBranca.png";
roupasSuperiores.camisetaPreta.src = CAMINHO_IMAGENS + "camisetaPreta.png";
roupasSuperiores.camisetaRoxa.src = CAMINHO_IMAGENS + "camisetaRoxa.png";
roupasSuperiores.camisetaVerde.src = CAMINHO_IMAGENS + "camisetaVerde.png";
roupasSuperiores.camisetaVermelha.src = CAMINHO_IMAGENS + "camisetaVermelha.png";
 
roupasInferiores.bermudaAzul.src = CAMINHO_IMAGENS + "bermudaAzul.png";
roupasInferiores.bermudaBranca.src = CAMINHO_IMAGENS + "bermudaBranca.png";
roupasInferiores.bermudaMarrom.src = CAMINHO_IMAGENS + "bermudaMarrom.png";
roupasInferiores.bermudaPreta.src = CAMINHO_IMAGENS + "bermudaPreta.png";
 
roupasInferiores.calcaAzul.src = CAMINHO_IMAGENS + "calcaAzul.png";
roupasInferiores.calcaBranca.src = CAMINHO_IMAGENS + "calcaBranca.png";
roupasInferiores.calcaMarrom.src = CAMINHO_IMAGENS + "calcaMarrom.png";
roupasInferiores.calcaPreta.src = CAMINHO_IMAGENS + "calcaPreta.png";
 
sapatos.sapatoAzul.src = CAMINHO_IMAGENS + "sapatoAzul.png";
sapatos.sapatoBranco.src = CAMINHO_IMAGENS + "sapatoBranco.png";
sapatos.sapatoMarrom.src = CAMINHO_IMAGENS + "sapatoMarrom.png";
sapatos.sapatoVermelho.src = CAMINHO_IMAGENS + "sapatoVermelho.png";
sapatos.sapatoPreto.src = CAMINHO_IMAGENS + "sapatoPreto.png";
 
const seletorOlhos = document.getElementById("eyeColor");
const seletorOlhosDireito = document.getElementById("eyeColorRight");
const menuHeterocromia = document.getElementById("menuHeterocromia");
const seletorCorCabelo = document.getElementById("hairColor");
 
const seletorCorpo = document.getElementById("skinColor");
const checkboxVitiligo = document.getElementById("vitiligo");
const checkboxHeterocromia = document.getElementById("heterocromia");
const seletorCabelos = document.getElementById("cabelos");
const seletorRoupaSuperior = document.getElementById("roupaSuperior");
const seletorRoupaInfeiror = document.getElementById("roupaInferior");
const seletorSapato = document.getElementById("sapatos");
 
// Campos ocultos do formulário PHP — é isso que viaja no POST
// para criarPersonagem.php quando o usuário clica em "Criar personagem".
const campoOcultoCabelo = document.getElementById("campoCabelo");
const campoOcultoCorCabelo = document.getElementById("campoCorCabelo");
const campoOcultoCorOlhoEsquerdo = document.getElementById("campoCorOlhoEsquerdo");
const campoOcultoCorOlhoDireito = document.getElementById("campoCorOlhoDireito");
const campoOcultoHeterocromia = document.getElementById("campoHeterocromia");
const campoOcultoCorPele = document.getElementById("campoCorPele");
const campoOcultoVitiligo = document.getElementById("campoVitiligo");
const campoOcultoRoupaSuperior = document.getElementById("campoRoupaSuperior");
const campoOcultoRoupaInferior = document.getElementById("campoRoupaInferior");
const campoOcultoSapato = document.getElementById("campoSapato");
 
let cabelosSelecionado = "nenhum";
let roupaSuperiorSelecionada = "nenhuma";
let roupaInferiorSelecionada = "nenhuma";
let sapatoSelecionado = "nenhum";
let corOlhos = seletorOlhos.value;
let corOlhosDireito = seletorOlhosDireito.value;
let corCorpo = seletorCorpo.value;
let corCabelo = seletorCorCabelo.value;
 
seletorCabelos.addEventListener("change", () => {
    cabelosSelecionado = seletorCabelos.value;
    desenhar();
});
 
seletorCorCabelo.addEventListener("input", () => {
    corCabelo = seletorCorCabelo.value;
    desenhar();
});
 
seletorRoupaInfeiror.addEventListener("change", () => {
    roupaInferiorSelecionada = seletorRoupaInfeiror.value;
    desenhar();
});
 
seletorRoupaSuperior.addEventListener("change", () => {
    roupaSuperiorSelecionada = seletorRoupaSuperior.value;
    desenhar();
});
 
seletorSapato.addEventListener("change", () => {
    sapatoSelecionado = seletorSapato.value;
    desenhar();
});
 
seletorOlhos.addEventListener("input", () => {
    corOlhos = seletorOlhos.value;
    desenhar();
});
 
seletorOlhosDireito.addEventListener("input", () => {
    corOlhosDireito = seletorOlhosDireito.value;
    desenhar();
});
 
seletorCorpo.addEventListener("change", () => {
    corCorpo = seletorCorpo.value;
    desenhar();
});
 
checkboxVitiligo.addEventListener("change", desenhar);
 
checkboxHeterocromia.addEventListener("change", () => {
    if (checkboxHeterocromia.checked) {
        menuHeterocromia.style.display = "block";
    } else {
        menuHeterocromia.style.display = "none";
    }
    desenhar();
});
 
let imagensParaCarregar = [
    fundo, corpo, corpoContorno, vitiligo, olhos, pupila, pupilaDireita,
    cabelos.cabeloCrespo, cabelos.cabeloCurto, cabelos.cabeloMedio, cabelos.cabeloLongo, cabelos.cabeloRaspado, cabelos.cabeloRaspadoLateral,
    cabelosContorno.cabeloCrespo, cabelosContorno.cabeloCurto, cabelosContorno.cabeloMedio, cabelosContorno.cabeloLongo, cabelosContorno.cabeloRaspado, cabelosContorno.cabeloRaspadoLateral,
    roupasSuperiores.camisaAmarela, roupasSuperiores.camisaAzul, roupasSuperiores.camisaBranca, roupasSuperiores.camisaPreta, roupasSuperiores.camisaRoxa,
    roupasSuperiores.camisaVerde, roupasSuperiores.camisaVermelha, roupasSuperiores.camisetaAmarela, roupasSuperiores.camisetaAzul,
    roupasSuperiores.camisetaBranca, roupasSuperiores.camisetaPreta, roupasSuperiores.camisetaRoxa, roupasSuperiores.camisetaVerde,
    roupasSuperiores.camisetaVermelha, roupasInferiores.bermudaAzul, roupasInferiores.bermudaBranca, roupasInferiores.bermudaMarrom,
    roupasInferiores.bermudaPreta, roupasInferiores.calcaAzul, roupasInferiores.calcaBranca, roupasInferiores.calcaMarrom,
    roupasInferiores.calcaPreta, sapatos.sapatoAzul, sapatos.sapatoBranco, sapatos.sapatoMarrom,
    sapatos.sapatoVermelho, sapatos.sapatoPreto
];
 
let carregadas = 0;
 
imagensParaCarregar.forEach(img => {
    img.onload = () => {
        carregadas++;
        if (carregadas === imagensParaCarregar.length) desenhar();
    };
    img.onerror = () => {
        carregadas++;
        console.warn("Aviso: Falha ao carregar a imagem: " + img.src);
        if (carregadas === imagensParaCarregar.length) desenhar();
    };
});
 
function pintarImagem(imagem, cor) {
    const temp = document.createElement("canvas");
    temp.width = Math.max(imagem.width, 1);
    temp.height = Math.max(imagem.height, 1);
 
    const tctx = temp.getContext("2d");
    tctx.imageSmoothingEnabled = false;
 
    if (imagem.complete && imagem.naturalWidth > 0) {
        tctx.drawImage(imagem, 0, 0);
        tctx.globalCompositeOperation = "source-in";
        tctx.fillStyle = cor;
        tctx.fillRect(0, 0, temp.width, temp.height);
        tctx.globalCompositeOperation = "source-over";
    }
 
    return temp;
}
 
// Atualiza os campos ocultos do formulário com o estado atual do editor.
// Chamada no fim de desenhar(), então toda mudança visual já reflete
// automaticamente no que vai ser enviado no POST.
function sincronizarFormulario() {
    campoOcultoCabelo.value = cabelosSelecionado;
    campoOcultoCorCabelo.value = corCabelo;
    campoOcultoCorOlhoEsquerdo.value = corOlhos;
    campoOcultoCorOlhoDireito.value = corOlhosDireito;
    campoOcultoHeterocromia.value = checkboxHeterocromia.checked ? "1" : "0";
    campoOcultoCorPele.value = corCorpo;
    campoOcultoVitiligo.value = checkboxVitiligo.checked ? "1" : "0";
    campoOcultoRoupaSuperior.value = roupaSuperiorSelecionada;
    campoOcultoRoupaInferior.value = roupaInferiorSelecionada;
    campoOcultoSapato.value = sapatoSelecionado;
}
 
function desenhar() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
 
    const escala = 6;
    const tamanho = 56 * escala;
    const x = (canvas.width - tamanho) / 2;
    const y = (canvas.height - tamanho) / 2;
 
    if (fundo.complete && fundo.naturalWidth > 0) ctx.drawImage(fundo, 0, 0);
 
    const corpoColorido = pintarImagem(corpo, corCorpo);
    ctx.drawImage(corpoColorido, x, y, tamanho, tamanho);
 
    if (corpoContorno.complete && corpoContorno.naturalWidth > 0) {
        ctx.drawImage(corpoContorno, x, y, tamanho, tamanho);
    }
 
    if (checkboxVitiligo.checked && vitiligo.complete && vitiligo.naturalWidth > 0) {
        ctx.drawImage(vitiligo, x, y, tamanho, tamanho);
    }
 
    if (cabelosSelecionado !== "nenhum") {
        const imagemDoCabelo = cabelos[cabelosSelecionado];
        const contornoDoCabelo = cabelosContorno[cabelosSelecionado];
 
        if (imagemDoCabelo && imagemDoCabelo.complete && imagemDoCabelo.naturalWidth > 0) {
            const cabeloColorido = pintarImagem(imagemDoCabelo, corCabelo);
            ctx.drawImage(cabeloColorido, x, y, tamanho, tamanho);
        }
 
        if (contornoDoCabelo && contornoDoCabelo.complete && contornoDoCabelo.naturalWidth > 0) {
            ctx.drawImage(contornoDoCabelo, x, y, tamanho, tamanho);
        }
    }
 
    if (roupaInferiorSelecionada !== "nenhuma") {
        const imagemDaRoupa = roupasInferiores[roupaInferiorSelecionada];
 
        if (imagemDaRoupa && imagemDaRoupa.complete && imagemDaRoupa.naturalWidth > 0) {
            ctx.drawImage(imagemDaRoupa, x, y, tamanho, tamanho);
        }
    }
 
    if (roupaSuperiorSelecionada !== "nenhuma") {
        const imagemDaRoupaS = roupasSuperiores[roupaSuperiorSelecionada];
 
        if (imagemDaRoupaS && imagemDaRoupaS.complete && imagemDaRoupaS.naturalWidth > 0) {
            ctx.drawImage(imagemDaRoupaS, x, y, tamanho, tamanho);
        }
    }
 
    if (sapatoSelecionado !== "nenhum") {
        const imagemDoSapato = sapatos[sapatoSelecionado];
 
        if (imagemDoSapato && imagemDoSapato.complete && imagemDoSapato.naturalWidth > 0) {
            ctx.drawImage(imagemDoSapato, x, y, tamanho, tamanho);
        }
    }
 
    if (olhos.complete && olhos.naturalWidth > 0) {
        ctx.drawImage(olhos, x, y, tamanho, tamanho);
    }
 
    const olhoEsquerdo = pintarImagem(pupila, corOlhos);
    ctx.drawImage(olhoEsquerdo, x, y, tamanho, tamanho);
 
    if (checkboxHeterocromia.checked) {
        const olhoDireito = pintarImagem(pupilaDireita, corOlhosDireito);
        ctx.drawImage(olhoDireito, x, y, tamanho, tamanho);
    }
 
    sincronizarFormulario();
}