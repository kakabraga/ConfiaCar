// Certifique-se de que fornecedorApi esteja definido e acessível (importado ou global)

async function deleteFornecedor(fornecedorId, fornecedorNome) {
  if (
    !confirm(`Tem certeza que deseja excluir o cliente ${fornecedorNome} ?`)
  ) {
    return; // Usuário cancelou a exclusão
  }

  try {
    const result = await fornecedorApi.delete(fornecedorId);
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

document.addEventListener("DOMContentLoaded", async function () {
  // <--- Adicione 'async' aqui!
  let dados = [];
  try {
    // 1. Use 'await' para esperar a Promise ser resolvida
    const apiResponseData = await fornecedorApi.hasfornecimento();
    // 2. Verifique se a resposta foi bem-sucedida e se contém dados
    if (Array.isArray(apiResponseData)) {
      dados = apiResponseData.map((fornecedor) => [
        fornecedor.id,
        fornecedor.nome,
        fornecedor.cnpj,
        fornecedor.email,
        fornecedor.hasFornecimentos,
      ]);
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
    try {
      array.forEach((element) => {});
      const apiResponseData = await fornecedorApi.hasFornecimento(
        fornecedor.id
      );
    } catch (error) {}
  }

  // ID do div no HTML DEVE ser "fornecedor" (ou mude aqui se for "fornecedores")
  let fornecedoresGridInstance = new gridjs.Grid({
    columns: [
      { id: "id", name: "Id" },
      { id: "nome", name: "Nome" },
      { id: "cnpj", name: "CNPJ" },
      { id: "email", name: "Email" },
      // Você pode adicionar uma coluna de ações aqui, como fez para clientes/funcionários
      {
        name: "Ações",
        sort: false,
        formatter: (cell, row) => {
          // Exemplo de como acessar os dados da linha para um botão
          const fornecedorId = row.cells[0].data; // ID na primeira coluna
          const fornecedorNome = row.cells[1].data; // Nome na segunda coluna
          const fornecedorCnpj = row.cells[2].data; // Cnpj na segunda coluna
          const fornecedorEmail = row.cells[3].data; // Email na segunda coluna
          const temFornecimentos = row.cells[4].data; // Fornecimento na segunda coluna
          const buttonClassesDanger = "btn btn-sm btn-outline-danger me-2";
          const buttonClassesInfo = "btn btn-sm btn-outline-info me-2";
          const buttonClassesSecondary =
            "btn btn-outline-secondary btn-sm me-2";

          // CRIAÇÃO DO BOTÃO DE EXCLUIR USANDO gridjs.h
          const deleteButton = gridjs.h(
            "button",
            {
              // Atributos dinâmicos para o botão de exclusão
              className: temFornecimentos
                ? buttonClassesSecondary
                : buttonClassesDanger,
              title: temFornecimentos
                ? "Fornecedor tem fornecimentos! Não pode excluir."
                : "Excluir Fornecedor",
              // Define a propriedade disabled diretamente aqui
              // Atribui o evento onclick apenas se não tiver fornecimentos
              onclick: temFornecimentos
                ? null
                : () => {
                    // Chame sua função de exclusão aqui
                    deleteFornecedor(fornecedorId, fornecedorNome);
                  },
            },
            "Excluir" // Conteúdo de texto do botão
          );
          const btnEditar = gridjs.h(
            "button",
            {
              className: "btn btn-sm btn-outline-primary me-2",
              onclick: () =>
                alert(
                  fornecedorId +
                    " " +
                    fornecedorNome +
                    " " +
                    fornecedorCnpj +
                    " " +
                    fornecedorEmail
                ),
            },
            "Editar"
          );
          const btnFornecimentos = gridjs.h(
            "a",
            {
              className: temFornecimentos
                ? buttonClassesInfo
                : buttonClassesSecondary,
              href: "./fornecimentos.php?id=" + fornecedorId,
              title: temFornecimentos
                ? "Verificar fornecimentos de: " + fornecedorNome
                : fornecedorNome +" não tem fornecimentos",
            },
            "Fornecimentos"
          );
          return gridjs.h("div", {}, btnEditar, deleteButton, btnFornecimentos);
        },
      },
    ],
    data: dados, // Agora 'dados' terá o array formatado
    search: true, // Habilita a barra de pesquisa
    pagination: { limit: 10, summary: true }, // Habilita paginação
    language: {
      // Tradução básica, se ainda não tiver global
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
  }).render(document.getElementById("fornecedor")); // <--- Certifique-se que o ID no HTML seja "fornecedor" ou mude aqui.
});
