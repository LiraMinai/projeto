(() => {
    const canvas = document.getElementById("avatarHud");
    const dados = window.dadosAvatar;

    if (!canvas || !dados) {
        return;
    }

    const ctx = canvas.getContext("2d");
    ctx.imageSmoothingEnabled = false;

    const CAMINHO_IMAGENS =
    (window.caminhoAvatar || "") + "pixelArt/";

    const cabelosPermitidos = [
        "cabeloCrespo",
        "cabeloCurto",
        "cabeloMedio",
        "cabeloLongo",
        "cabeloRaspado",
        "cabeloRaspadoLateral"
    ];

    const roupasSuperioresPermitidas = [
        "camisaAmarela",
        "camisaAzul",
        "camisaBranca",
        "camisaPreta",
        "camisaRoxa",
        "camisaVerde",
        "camisaVermelha",
        "camisetaAmarela",
        "camisetaAzul",
        "camisetaBranca",
        "camisetaPreta",
        "camisetaRoxa",
        "camisetaVerde",
        "camisetaVermelha"
    ];

    const roupasInferioresPermitidas = [
        "bermudaAzul",
        "bermudaBranca",
        "bermudaMarrom",
        "bermudaPreta",
        "calcaAzul",
        "calcaBranca",
        "calcaMarrom",
        "calcaPreta"
    ];

    const sapatosPermitidos = [
        "sapatoAzul",
        "sapatoBranco",
        "sapatoMarrom",
        "sapatoVermelho",
        "sapatoPreto"
    ];

    const arquivos = {
        corpo: "corpo.png",
        corpoContorno: "corpoContorno.png",
        olhos: "olhos.png",
        pupila: "pupila.png"
    };

    if (dados.vitiligo) {
        arquivos.vitiligo = "vitiligo.png";
    }

    if (cabelosPermitidos.includes(dados.cabelo)) {
        arquivos.cabelo = dados.cabelo + ".png";
        arquivos.cabeloContorno = dados.cabelo + "Contorno.png";
    }

    if (roupasSuperioresPermitidas.includes(dados.roupaSuperior)) {
        arquivos.roupaSuperior = dados.roupaSuperior + ".png";
    }

    if (roupasInferioresPermitidas.includes(dados.roupaInferior)) {
        arquivos.roupaInferior = dados.roupaInferior + ".png";
    }

    if (sapatosPermitidos.includes(dados.sapato)) {
        arquivos.sapato = dados.sapato + ".png";
    }

    if (dados.heterocromia) {
        arquivos.pupilaDireita = "pupilaDireita.png";
    }

    function carregarImagem(arquivo) {
        return new Promise((resolve, reject) => {
            const imagem = new Image();

            imagem.onload = () => resolve(imagem);
            imagem.onerror = () => reject(
                new Error("Não foi possível carregar: " + arquivo)
            );

            imagem.src = CAMINHO_IMAGENS + arquivo;
        });
    }

    function pintarImagem(imagem, cor) {
        const temporario = document.createElement("canvas");

        temporario.width = imagem.width;
        temporario.height = imagem.height;

        const contextoTemporario = temporario.getContext("2d");
        contextoTemporario.imageSmoothingEnabled = false;

        contextoTemporario.drawImage(imagem, 0, 0);
        contextoTemporario.globalCompositeOperation = "source-in";
        contextoTemporario.fillStyle = cor;
        contextoTemporario.fillRect(
            0,
            0,
            temporario.width,
            temporario.height
        );

        contextoTemporario.globalCompositeOperation = "source-over";

        return temporario;
    }

    async function desenharAvatar() {
        const imagens = {};

        for (const [nome, arquivo] of Object.entries(arquivos)) {
            imagens[nome] = await carregarImagem(arquivo);
        }

        const escala = 6;
        const tamanho = 56 * escala;
        const x = (canvas.width - tamanho) / 2;
        const y = (canvas.height - tamanho) / 2;

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        ctx.drawImage(
            imagens.fundo,
            0,
            0,
            canvas.width,
            canvas.height
        );

        const corpoColorido = pintarImagem(
            imagens.corpo,
            dados.corPele || "#F8DCC8"
        );

        ctx.drawImage(corpoColorido, x, y, tamanho, tamanho);
        ctx.drawImage(imagens.corpoContorno, x, y, tamanho, tamanho);

        if (imagens.vitiligo) {
            ctx.drawImage(imagens.vitiligo, x, y, tamanho, tamanho);
        }

        if (imagens.cabelo) {
            const cabeloColorido = pintarImagem(
                imagens.cabelo,
                dados.corCabelo || "#3B2A1A"
            );

            ctx.drawImage(cabeloColorido, x, y, tamanho, tamanho);
            ctx.drawImage(
                imagens.cabeloContorno,
                x,
                y,
                tamanho,
                tamanho
            );
        }

        if (imagens.roupaInferior) {
            ctx.drawImage(
                imagens.roupaInferior,
                x,
                y,
                tamanho,
                tamanho
            );
        }

        if (imagens.roupaSuperior) {
            ctx.drawImage(
                imagens.roupaSuperior,
                x,
                y,
                tamanho,
                tamanho
            );
        }

        if (imagens.sapato) {
            ctx.drawImage(imagens.sapato, x, y, tamanho, tamanho);
        }

        ctx.drawImage(imagens.olhos, x, y, tamanho, tamanho);

        const olhoEsquerdo = pintarImagem(
            imagens.pupila,
            dados.corOlhoEsquerdo || "#3B82F6"
        );

        ctx.drawImage(olhoEsquerdo, x, y, tamanho, tamanho);

        if (imagens.pupilaDireita) {
            const olhoDireito = pintarImagem(
                imagens.pupilaDireita,
                dados.corOlhoDireito || "#10B981"
            );

            ctx.drawImage(olhoDireito, x, y, tamanho, tamanho);
        }
    }

    desenharAvatar().catch((erro) => {
        console.error("Erro ao exibir o avatar:", erro);
    });
})();