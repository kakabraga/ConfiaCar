const urlFornecedor = "../Controller/FornecedorController.php?action=";

const fornecedorApi = {
  /**
   * Retorna a URL para buscar a lista de clientes. Usado pelo Grid.js.
   * (Mantido caso você mude de ideia ou para referência, mas não será usado no modo `data`)
   */

  /**
   * **NOVA FUNÇÃO:** Busca todos os clientes do servidor.
   * @returns {Promise<Array<Object>>} - Um array de objetos cliente.
   * @param {number} fornecedorId
   */
  async fetchFornecedor() {
    const response = await fetch(urlFornecedor + "fetch");
    if (!response.ok) {
      const errorBody = await response.text();
      throw new Error(
        `Erro HTTP ao buscar clientes: ${response.status} - ${errorBody}`
      );
    }
    return await response.json();
  },

  async delete(fornecedorId) {
    const response = await fetch(urlFornecedor + "del", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ fornecedorId }),
    });
    if (!response.ok) {
      const errorBody = await response.text();
      throw new Error(`Erro HTTP: ${response.status} - ${errorBody}`);
    }
    return await response.json();
  },
  /*
   * Envia dados de cliente para salvar (criar ou atualizar).
   * @param {Object} data - Os dados do cliente (id, nome, cpf, email).
   * @returns {Promise<Object>}; - Resposta JSON do servidor.
   */
  // async save(data) {
  //   const response = await fetch(url);
  // },

  async save(data) {
    const response = await fetch(urlFornecedor + "save", {
      method: "POST",
      header: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    });
    if (!response.ok) {
      const errorBody = await response.text();
      throw new Error(`Erro HTTP: ${response.status} - ${errorBody}`);
    }

    return await response.json();
  },

  async hasfornecimento() {
    const response = await fetch(urlFornecedor + "dep");
    if (!response.ok) {
      const errorBody = await response.text();
      throw new Error(
        `Erro HTTP ao buscar clientes: ${response.status} - ${errorBody}`
      );
    }
    return await response.json();
  },
};
