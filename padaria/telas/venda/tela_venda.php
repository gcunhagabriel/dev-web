<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tela de Venda de Produto</title>
  <style>
    :root {
      --bg: #0f172a;       /* slate-900 */
      --panel: #111827;    /* gray-900 */
      --muted: #1f2937;    /* gray-800 */
      --text: #e5e7eb;     /* gray-200 */
      --subtext: #9ca3af;  /* gray-400 */
      --accent: #22c55e;   /* green-500 */
      --accent-2: #3b82f6; /* blue-500 */
      --danger: #ef4444;   /* red-500 */
      --ring: #60a5fa55;
      --radius: 16px;
    }
    * { box-sizing: border-box; }
    body { margin: 0; background: linear-gradient(180deg, #0b1222, #0f172a); font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; color: var(--text); }

    .container { max-width: 1100px; margin: 32px auto; padding: 0 16px; }
    .card { background: radial-gradient(1200px 600px at -10% -30%, #0b1324, transparent), var(--panel); border: 1px solid #1f2937; border-radius: var(--radius); box-shadow: 0 10px 30px #00000066; overflow: hidden; }
    .card-header { padding: 20px 24px; border-bottom: 1px solid #1f2937; display: flex; align-items: center; justify-content: space-between; }
    .title { font-size: 20px; font-weight: 700; letter-spacing: .3px; }
    .subtitle { color: var(--subtext); font-size: 14px; }
    .card-body { padding: 24px; display: grid; gap: 20px; }

    .grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 16px; }
    .col-6 { grid-column: span 6; }
    .col-4 { grid-column: span 4; }
    .col-3 { grid-column: span 3; }
    .col-12 { grid-column: span 12; }

    label { display: block; font-size: 12px; color: var(--subtext); margin-bottom: 6px; }
    select, input[type="number"], input[type="date"], input[type="text"] {
      width: 100%; padding: 10px 12px; border-radius: 12px; border: 1px solid #293548; background: #0b1222; color: var(--text);
      outline: none; transition: box-shadow .15s ease, border-color .15s ease;
    }
    select:focus, input:focus { box-shadow: 0 0 0 4px var(--ring); border-color: #3b82f6; }

    .toolbar { display: flex; gap: 10px; align-items: center; justify-content: flex-end; }
    .btn { border: 1px solid #334155; background: #121a2b; color: var(--text); padding: 10px 14px; border-radius: 12px; cursor: pointer; font-weight: 600; transition: transform .05s ease, background .2s ease, border-color .2s ease; }
    .btn:hover { background: #0b1222; border-color: #475569; }
    .btn:active { transform: translateY(1px); }
    .btn-primary { background: linear-gradient(180deg, #1d4ed8, #1e40af); border-color: #1d4ed8; }
    .btn-primary:hover { background: linear-gradient(180deg, #2563eb, #1d4ed8); }
    .btn-accent { background: linear-gradient(180deg, #16a34a, #15803d); border-color: #16a34a; }
    .btn-accent:hover { background: linear-gradient(180deg, #22c55e, #16a34a); }
    .btn-danger { background: #2a1111; border-color: #7f1d1d; color: #fecaca; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 10px; width: 40px; }

    table { width: 100%; border-collapse: collapse; overflow: hidden; border-radius: 12px; }
    thead th { text-align: left; font-size: 12px; color: var(--subtext); font-weight: 600; padding: 12px; background: #0b1222; border-bottom: 1px solid #1f2937; }
    tbody td { padding: 10px 12px; border-bottom: 1px solid #182033; }

    .right { text-align: right; }
    .mono { font-variant-numeric: tabular-nums; font-feature-settings: "tnum"; }

    .footer { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between; padding: 12px 0 6px; }
    .totais { display: flex; gap: 18px; align-items: baseline; }
    .totais .valor { font-size: 24px; font-weight: 800; }

    .badge { padding: 6px 10px; border-radius: 999px; background: #0b1222; border: 1px solid #1f2937; color: var(--subtext); font-size: 12px; }

    @media (max-width: 880px) {
      .col-6 { grid-column: span 12; }
      .col-4 { grid-column: span 12; }
      .col-3 { grid-column: span 6; }
    }
  </style>
  <script src="cadastro_venda.js" defer></script>
</head>
<body>
  <?php
    require_once __DIR__ . "/../../service/funcionario.service.php";
    require_once __DIR__ . "/../../service/cliente.service.php";
    require_once __DIR__ . "/../../service/produto.service.php";
    require_once __DIR__ . "/../../service/venda.service.php";
    $venda = "";
    if(isset($_GET["id"]))
      $venda = pegaVendaPeloId($_GET["id"]);
  ?>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div>
          <div class="title">Nova Venda</div>
          <div class="subtitle">Selecione funcionário, cliente e adicione itens</div>
        </div>
        <div class="badge" id="ordemNumero">Pedido #—</div>
      </div>

      <div class="card-body">
        <!-- Cabeçalho da venda -->
        <div class="grid">
          <div class="col-6">
            <label for="funcionario">Funcionário</label>
            <select id="funcionario" required>
              <?php
                $funcionarios = listarTodosFuncionarios();
                foreach($funcionarios as $funcionario){
                  echo "<option value='".$funcionario->id."'>".$funcionario->nome."</option>";
                }
              ?>
            </select>
          </div>
          <div class="col-6">
            <label for="cliente">Cliente</label>
            <select id="cliente" required>
              <?php
                $clientes = listarTodosClientes();
                foreach($clientes as $cliente){
                  echo "<option value='".$cliente->id."'>".$cliente->nome."</option>";
                }
              ?>
            </select>
          </div>
          <div class="col-6">
            <label for="produto">Produto</label>
            <select id="produto" required>
              <?php
                $produtos = listarTodosProdutos();
                foreach($produtos as $produto){
                  echo "<option value='{$produto->id}' dataPreco='{$produto->preco}'>{$produto->nome}</option>";
                }
              ?>
              <input type="hidden" id="preco">
            </select>
          </div>
          <div class="col-3">
            <label for="dataVenda">Data</label>
            <input type="date" id="dataVenda" />
          </div>
          <div class="col-3">
            <label for="formaPgto">Forma de Pagamento</label>
            <select id="formaPgto">
              <option value="pix">PIX</option>
              <option value="dinheiro">Dinheiro</option>
              <option value="debito">Débito</option>
              <option value="credito">Crédito</option>
            </select>
          </div>
          <div class="col-3">
            <label for="desconto">Desconto (%)</label>
            <input type="number" id="desconto" min="0" max="100" step="0.01" value="0" />
          </div>
          <div class="col-3">
            <label for="obs">Observações</label>
            <input type="text" id="obs" placeholder="Opcional" />
          </div>
        </div>

        <!-- Itens da venda -->
        <div class="toolbar">
          <button id="btnAdd" class="btn btn-accent btn-icon" title="Adicionar item (Ctrl + +)">+</button>
        </div>

        <div style="overflow-x:auto;">
          <table id="tabelaItens" aria-label="Tabela de itens da venda">
            <thead>
              <tr>
                <th style="width: 44%">Produto</th>
                <th style="width: 14%" class="right">Preço</th>
                <th style="width: 14%" class="right">Qtde</th>
                <th style="width: 16%" class="right">Subtotal</th>
                <th style="width: 12%" class="right">Ações</th>
              </tr>
            </thead>
            <tbody id="corpoItens">
              <!-- Linhas adicionadas dinamicamente -->
            </tbody>
          </table>
        </div>

        <div class="footer">
          <div class="totais">
            <span class="badge">Itens: <span id="qtdItens">0</span></span>
            <span class="badge">Subtotal: <span id="subtotal" class="mono">R$ 0.00</span></span>
            <span class="badge">Desconto: <span id="valorDesconto" class="mono">R$ 0.00</span></span>
            <span class="valor mono">Total: <span id="total">R$ 0.00</span></span>
          </div>
          <div class="toolbar">
            <button id="btnLimpar" class="btn">Limpar</button>
            <button id="btnSalvar" class="btn btn-primary">Salvar</button>
            <button id="btnFinalizar" class="btn btn-accent">Finalizar Venda</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
