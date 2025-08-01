class FornecedorFormModal {
  constructor(modalId, formId, fornecedorApi, refreshGridCallback) {
    this.modalElement = document.getElementById(modalId);
    if (!this.modalElement) {
      console.error(`Elemento modal com ID "${modalId}" não encontrado.`);
      return; // Interrompe a execução se o elemento não for encontrado
    }
    this.bootstrapModal = new bootstrap.Modal(this.modalElement);
    this.formElement = document.getElementById(formId);
    this.fornecedorApi = fornecedorApi;
    this.refreshGridCallback = refreshGridCallback;
    this.mode = "create";
    this.idInput = this.modalElement.querySelector("#fornecedor-id");
    this.nomeInput = this.modalElement.querySelector("#fornecedor-nome");
    this.cnpjInput = this.modalElement.querySelector("#fornecedor-cpnj");
    this.emailInput = this.modalElement.querySelector("#fornecedor-email");
    this.modalTitle = this.modalElement.querySelector(
      "#fornecedorFormModalLabel"
    );

    this.addEventListeners();
  }

  addEventListeners() {
    if (this.formElement) {
      this.formElement.addEventListener("submit", this.handleSubmit.bind(this));
    } else {
      console.error("Elemento do formulário não encontrado.");
    }
  }
  show(mode, data = {}) {
    this.mode = mode;
    if (this.formElement) {
      this.formElement.reset(); // Limpa o formulário

      if (mode === "create") {
        this.modalTitle.textContent = "Adicionar Fornecedor";
        this.idInput.value = "";
      } else if (mode === "update") {
        this.modalTitle.textContent = "Editar Fornecedor";
        this.idInput.value = data.id || "";
        this.nomeInput.value = data.nome || "";
        this.cnpjInput.value = data.cnpj || "";
        this.emailInput.value = data.email || "";
      }
    }
    this.bootstrapModal.show(); // <-- Mostra o modal do Bootstrap
  }

  hide() {
    this.bootstrapModal.hide(); // <-- Esconde o modal do Bootstrap
  }

  async handleSubmit(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const fornecedorData = {
      id: this.idInput.value ? parseInt(this.idInput.value) : null,
      nome: this.nomeInput.value,
      cnpj: this.cnpjInput.value,
      email: this.emailInput.value,
    };

    try {
      const result = await this.fornecedorApi.save(fornecedorData);
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
