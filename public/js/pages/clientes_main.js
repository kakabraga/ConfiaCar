// public/js/pages/clientes_main.js

// 'clienteApi' (de cliente-api.js) e 'ClienteFormModal' (de cliente-form-modal.js)
// são consideradas variáveis globais aqui, pois são carregadas antes no HTML.
// O mesmo vale para 'gridjs' (da biblioteca Grid.js).

let clientesGridInstance; // Variável para armazenar a instância do Grid.js
let clienteFormModalInstance; // Variável para armazenar a instância do modal de formulário

/**
 * Recarrega os dados da tabela Grid.js.
 * Essa função agora buscará TODOS os dados novamente do servidor.
 */
async function refreshGrid() {
  try {
    // 1. Busca os dados brutos (array de objetos) da API
    const apiResponseData = await clienteApi.fetchClientes(); // Nova função no clienteApi para buscar dados

    if (Array.isArray(apiResponseData)) {
      // 2. Mapeia o array de OBJETOS para um array de ARRAYS
      const mappedDataForGrid = apiResponseData.map((cliente) => [
        cliente.id,
        cliente.nome,
        cliente.cpf,
        cliente.email,
      ]);

      console.log(
        "2. Dados MAIPEADOS (array de arrays) para o formato do Grid.js para refresh:",
        mappedDataForGrid
      );

      // 3. Atualiza os dados da instância existente do Grid.js
      if (clientesGridInstance) {
        clientesGridInstance
          .updateConfig({
            data: mappedDataForGrid, // Atualiza a propriedade 'data' diretamente
          })
          .forceRender(); // Força a re-renderização do grid
      } else {
        console.error("Instância do Grid.js não encontrada para atualização.");
      }
    } else {
      console.error(
        "Erro no refreshGrid: Resposta inesperada do servidor. Esperado um ARRAY de clientes.",
        apiResponseData
      );
      if (clientesGridInstance) {
        clientesGridInstance.updateConfig({ data: [] }).forceRender(); // Limpa o grid em caso de erro
      }
    }
  } catch (error) {
    console.error("Erro ao buscar dados para refresh do Grid:", error);
    alert("Ocorreu um erro ao atualizar os dados da tabela.");
    if (clientesGridInstance) {
      clientesGridInstance.updateConfig({ data: [] }).forceRender(); // Limpa o grid em caso de erro
    }
  }
}

/**
 * Lógica para excluir um cliente.
 * @param {number} idCliente - ID do cliente a ser excluído.
 * @param {string} nomeCliente - Nome do cliente para a confirmação.
 */
async function excluirCliente(idCliente, nomeCliente) {
  if (
    !confirm(
      `Tem certeza que deseja excluir o cliente ${nomeCliente} (ID: ${idCliente})?`
    )
  ) {
    return; // Usuário cancelou a exclusão
  }

  try {
    // Chamada à API para excluir o cliente
    const result = await clienteApi.delete(idCliente);

    if (result.response) {
      alert("Cliente excluído com sucesso! ✅");
      await refreshGrid(); // Atualiza a tabela após a exclusão
    } else {
      alert(
        `Erro ao excluir cliente: ${result.message || "Erro desconhecido."}`
      );
    }
  } catch (error) {
    console.error("Erro na requisição de exclusão:", error);
    alert(`Ocorreu um erro: ${error.message}.`);
  }
}

// --- Lógica Principal de Inicialização da Página ---

// Garante que o script só execute após o DOM estar completamente carregado
document.addEventListener("DOMContentLoaded", async function () {
  // Adicionado 'async' aqui
  // 1. Inicializar o Modal de Formulário (se o elemento HTML existir)
  const clienteFormModalElement = document.getElementById("clienteFormModal");
  if (clienteFormModalElement) {
    // Passa a API de cliente e a função de refresh do grid para o modal.
    // Isso permite que o modal chame a API para salvar e atualize o grid após o salvamento.
    clienteFormModalInstance = new ClienteFormModal(
      "clienteFormModal", // ID do elemento modal Bootstrap
      "form_cliente", // ID do formulário dentro do modal
      clienteApi, // O objeto com os métodos da API (save, delete, etc.)
      refreshGrid // A função para atualizar o grid
    );
  }

  // --- Nova lógica para carregar os dados ANTES de inicializar o Grid.js ---
  let initialData = [];
  try {
    const apiResponseData = await clienteApi.fetchClientes(); // Chamar a nova função aqui
    if (Array.isArray(apiResponseData)) {
      initialData = apiResponseData.map((cliente) => [
        cliente.id,
        cliente.nome,
        cliente.cpf,
        cliente.email,
      ]);
      console.log("Dados iniciais mapeados para o Grid.js:", initialData);
    } else {
      console.error(
        "Erro na carga inicial de dados: Resposta inesperada do servidor.",
        apiResponseData
      );
    }
  } catch (error) {
    console.error("Erro ao carregar dados iniciais dos clientes:", error);
    alert(
      "Não foi possível carregar os dados iniciais dos clientes. Verifique o console para detalhes."
    );
  }

  // 2. Inicializar o Grid.js para exibir a tabela de clientes
  clientesGridInstance = new gridjs.Grid({
    columns: [
      { id: "id", name: "Id" },
      { id: "nome", name: "Nome", sort: true },
      { id: "cpf", name: "CPF" },
      { id: "email", name: "Email" },
      {
        name: "Ações",
        formatter: (cell, row) => {
          // Acessa os dados da célula usando 'row.cells[index].data'
          const idCliente = row.cells[0].data;
          const nomeCliente = row.cells[1].data;
          const cpfCliente = row.cells[2].data;
          const emailCliente = row.cells[3].data;

          const btnEditar = gridjs.h(
            "button",
            {
              className: "btn btn-sm btn-outline-primary me-2",
              onClick: () =>
                clienteFormModalInstance.show("update", {
                  id: idCliente,
                  nome: nomeCliente,
                  cpf: cpfCliente,
                  email: emailCliente,
                }),
            },
            "Editar"
          );

          const btnExcluir = gridjs.h(
            "button",
            {
              className: "btn btn-sm btn-outline-danger",
              onClick: () => excluirCliente(idCliente),
            },
            "Excluir"
          );
          return gridjs.h("div", {}, btnEditar, btnExcluir);
        },
      },
    ],

    data: initialData,
    language: {
      search: { placeholder: "Pesquisar fornecedores..." },
      pagination: {
        previous: "Anterior",
        next: "Próximo",
        showing: "Mostrando",
        results: "resultados",
        to: "a",
        of: "de",
      },
      loading: "Carregando...",
      noRecordsFound: "Nenhum fornecedor encontrado",
      error: "Ocorreu um erro ao carregar os dados.",
    },
    search: true, // Habilita a barra de pesquisa (agora no lado do cliente)
    pagination: { limit: 10, summary: true }, // Habilita paginação (agora no lado do cliente)
  }).render(document.getElementById("cliente")); // Renderiza o grid no elemento com ID "clientes"

  // 3. Listener para o Botão "Adicionar Cliente"
  const btnAdicionarCliente = document.getElementById("btn-adicionar-cliente");
  if (btnAdicionarCliente) {
    btnAdicionarCliente.addEventListener("click", () => {
      // Abre o modal de formulário no modo de criação (sem dados pré-preenchidos)
      clienteFormModalInstance.show("create");
    });
  }
});
