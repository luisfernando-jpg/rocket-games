// Seleciona os botões pelo ID
const cadastrarButton = document.getElementById("botaoCadastrar");
const listarButton = document.getElementById("botaoListar");
const atualizarButton = document.getElementById("botaoAtualizar");
const deletarButton = document.getElementById("botaoDeletar");

// Adiciona os eventos de clique
cadastrarButton.addEventListener("click", cadastrarJogo);
listarButton.addEventListener("click", listarJogos);
atualizarButton.addEventListener("click", atualizarJogo);
deletarButton.addEventListener("click", deletarJogo);

function cadastrarJogo() {
  // Aqui você pode adicionar o código para cadastrar o jogo
  alert("Jogo cadastrado com sucesso!");
}

function listarJogos() {
  // Aqui você pode adicionar o código para listar os jogos
  const jogos = [
    { nome: "Jogo 1", descricao: "Descrição do jogo 1" },
    { nome: "Jogo 2", descricao: "Descrição do jogo 2" },
    { nome: "Jogo 3", descricao: "Descrição do jogo 3" },
  ];

  const listaJogos = document.getElementById("listaJogos");
  listaJogos.innerHTML = ""; // Limpa a lista antes de adicionar novos itens

  jogos.forEach((jogo) => {
    const listItem = document.createElement("li");
    listItem.textContent = jogo.nome + " - " + jogo.descricao;
    listaJogos.appendChild(listItem);
  });
}

function atualizarJogo() {
  // Aqui você pode adicionar o código para atualizar o jogo
  alert("Jogo atualizado com sucesso!");
}

function deletarJogo() {
  // Aqui você pode adicionar o código para deletar o jogo
  if (confirm("Você tem certeza que deseja deletar o jogo?")) {
    // Código para deletar o jogo
    alert("Jogo deletado com sucesso!");
  }
}
