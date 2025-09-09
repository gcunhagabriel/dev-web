const btnAdd = document.getElementById("btnAdd");
const corpoItens = document.getElementById("corpoItens");
const qtdItens = document.getElementById("qtdItens");
const subtotal = document.getElementById("subtotal");
const valorDesconto = document.getElementById("valorDesconto");
const total = document.getElementById("total");
const desconto = document.getElementById("desconto");

const addItem = function () {
  const produtos = document.getElementById("produto");
  let produto = produtos.options[produtos.selectedIndex].textContent;
  let produtoIdNovo = produtos.options[produtos.selectedIndex].value;
  let preco = document.getElementById("preco").value;
  let jaRegistrado = false;

  for (let i = 0; i < corpoItens.rows.length + 1; i++) {
    let linha = tabelaItens.rows[i];
    let produtoId = linha.cells[0].getAttribute("produtoId");
    let qtdeCell = linha.cells[2];
    let subtotalCell = linha.cells[3];
    let qtde = parseInt(qtdeCell.textContent);

    if (produtoIdNovo === produtoId) {
      qtde++;
      qtdeCell.textContent = qtde;
      subtotalCell.textContent = qtde * preco;
      jaRegistrado = true;
    }
  }

  if (!jaRegistrado) {
    qtde = 1;
    let subtotal = preco * qtde;

    let novaLinha = document.createElement("tr");
    let dados = [produto, preco, qtde, subtotal];
    dados.forEach((valor) => {
      let dado = document.createElement("td");
      dado.textContent = valor;
      dado.setAttribute("produtoId", produtoIdNovo);
      novaLinha.appendChild(dado);
    });
    corpoItens.appendChild(novaLinha);
  }

  atualizarConta();
};

const atualizarConta = function () {
  let novaQtd = 0;
  let novoSub = 0;
  let novoDesc = parseInt(desconto.value);

  for (let i = 0; i < corpoItens.rows.length; i++) {
    let linha = corpoItens.rows[i];
    let precoLinha = parseInt(linha.cells[1].textContent);
    let qtdLinha = parseInt(linha.cells[2].textContent);
    novoSub += precoLinha * qtdLinha;
    novaQtd += parseInt(linha.cells[2].textContent);
  }

  novoDesc = (novoSub * novoDesc) / 100;
  qtdItens.textContent = novaQtd;
  subtotal.textContent = "R$ " + novoSub;
  valorDesconto.textContent = "R$ " + novoDesc;
  total.textContent = "R$ " + (novoSub - novoDesc);
};

document.addEventListener("DOMContentLoaded", function () {
  const produtos = document.getElementById("produto");
  const precoInput = document.getElementById("preco");

  const atualizarPreco = function () {
    const opcao = produtos.options[produtos.selectedIndex];
    precoInput.value = opcao.getAttribute("dataPreco");
  };

  const atualizarDesconto = function () {
    let novoDesc =
      (parseInt(desconto.value) *
        parseInt(subtotal.textContent.replace("R$ ", ""))) /
      100;
    valorDesconto.textContent = "R$ " + novoDesc;
    total.textContent =
      "R$ " + (parseInt(subtotal.textContent.replace("R$ ", "")) - novoDesc);
  };

  atualizarPreco();
  produtos.addEventListener("change", atualizarPreco);
  desconto.addEventListener("change", atualizarDesconto);
});

btnAdd.addEventListener("click", addItem);
