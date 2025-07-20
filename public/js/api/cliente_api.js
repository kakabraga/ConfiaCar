// public/js/api/cliente_api.js

const clienteApi = {
    /**
     * Retorna a URL para buscar a lista de clientes. Usado pelo Grid.js.
     * (Mantido caso você mude de ideia ou para referência, mas não será usado no modo `data`)
     */
    getFetchUrlForGrid() {
        return "../Controller/ClienteController.php?action=fetch";
    },

    /**
     * **NOVA FUNÇÃO:** Busca todos os clientes do servidor.
     * @returns {Promise<Array<Object>>} - Um array de objetos cliente.
     */
    async fetchClientes() {
        const response = await fetch("../Controller/ClienteController.php?action=fetch");
        if (!response.ok) {
            const errorBody = await response.text();
            throw new Error(`Erro HTTP ao buscar clientes: ${response.status} - ${errorBody}`);
        }
        return await response.json(); // Espera que o PHP retorne diretamente o array de objetos
    },

    /**
     * Envia dados de cliente para salvar (criar ou atualizar).
     * @param {Object} data - Os dados do cliente (id, nome, cpf, email).
     * @returns {Promise<Object>} - Resposta JSON do servidor.
     */
    async save(data) {
        const response = await fetch("../Controller/ClienteController.php?action=save", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (!response.ok) {
            const errorBody = await response.text();
            throw new Error(`Erro HTTP: ${response.status} - ${errorBody}`);
        }

            return await response.json();
         
    },

    /**
     * Solicita a exclusão de um cliente.
     * @param {number} idCliente - O ID do cliente a ser excluído.
     * @returns {Promise<Object>} - Resposta JSON do servidor.
     */
    async delete(idCliente) {
        const response = await fetch("../Controller/ClienteController.php?action=del", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idCliente })
        });
        if (!response.ok) {
            const errorBody = await response.text();
            throw new Error(`Erro HTTP: ${response.status} - ${errorBody}`);
        }
        return await response.json();
    }
};