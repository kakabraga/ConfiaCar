class ClienteFormModal {
  constructor(modalId, formId, clienteApi, refreshGridCallback) {
    this.modalElement = document.getElementById(modalId);
    if (!this.modalElement) {
      console.error(`Elemento modal com ID "${modalId}" não encontrado.`);
      return; // Interrompe a execução se o elemento não for encontrado
    }
    // Inicializa o modal do Bootstrap a partir do elemento DOM
    this.bootstrapModal = new bootstrap.Modal(this.modalElement);
    this.formElement = document.getElementById(formId);
    this.clienteApi = clienteApi;
    this.refreshGridCallback = refreshGridCallback;
    this.mode = "create"; // 'create' ou 'update'

    // Campos do formulário
    this.idInput = this.modalElement.querySelector("#cliente-id");
    this.nomeInput = this.modalElement.querySelector("#cliente-nome");
    this.cpfInput = this.modalElement.querySelector("#cliente-cpf");
    this.emailInput = this.modalElement.querySelector("#cliente-email");
    this.modalTitle = this.modalElement.querySelector("#clienteFormModalLabel");

    this.addEventListeners();
  }

  addEventListeners() {
    if (this.formElement) {
      this.formElement.addEventListener("submit", this.handleSubmit.bind(this));
    } else {
      console.error("Elemento do formulário não encontrado.");
    }
  }

  // Método para mostrar o modal
  show(mode, data = {}) {
    this.mode = mode;
    if (this.formElement) {
      this.formElement.reset(); // Limpa o formulário

      if (mode === "create") {
        this.modalTitle.textContent = "Adicionar Cliente";
        this.idInput.value = "";
      } else if (mode === "update") {
        this.modalTitle.textContent = "Editar Cliente";
        this.idInput.value = data.id || "";
        this.nomeInput.value = data.nome || "";
        this.cpfInput.value = data.cpf || "";
        this.emailInput.value = data.email || "";
      }
    }
    this.bootstrapModal.show(); // <-- Mostra o modal do Bootstrap
  }

  // Método para esconder o modal
  hide() {
    this.bootstrapModal.hide(); // <-- Esconde o modal do Bootstrap
  }

  async handleSubmit(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const clienteData = {
      id: this.idInput.value ? parseInt(this.idInput.value) : null,
      nome: this.nomeInput.value,
      cpf: this.cpfInput.value,
      email: this.emailInput.value,
    };

    try {
      const result = await this.clienteApi.save(clienteData);
      if (result.response) {
        alert(
          `Cliente ${
            this.mode === "create" ? "adicionado" : "atualizado"
          } com sucesso! ✅`
        );
        this.hide();
        if (this.refreshGridCallback) {
          this.refreshGridCallback();
        }
      } else {
        alert(
          `Erro ao salvar cliente: ${result.message || "Erro desconhecido."}`
        );
      }
    } catch (error) {
      console.error("Erro na requisição de salvamento:", error);
      alert(`Ocorreu um erro: ${error.message}.`);
    }
  }
}
