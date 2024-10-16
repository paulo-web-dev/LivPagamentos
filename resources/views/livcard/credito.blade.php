@include('livcard.header')
<div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Adicionar Saldo</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Adicionar Saldo</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card"> 
                  <div class="card-header">
                    <h4 class="card-title">Adicionar Crédito</h4>
                  </div>
              <form id="adicionaCreditoForm" method="post">
    @csrf
    <div class="card-body">

        <div class="form-group">
            <label for="quantidadeSelect">Valor de Crédito</label>
            <select class="form-control" name="credito" id="quantidadeSelect">
                @for ($i = 1; $i < 11; $i++)
                    <option value="{{ $i*50 }}">R${{ $i*50 }},00</option>
                @endfor
            </select>
        </div>
            <div class="form-group">
                <label for="cpf_titular">CPF</label>
                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF do titular do cartão">
            </div>
        <!-- Celular -->
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" name="celular" id="celular" placeholder="Digite seu celular" >
        </div>

        <!-- Forma de pagamento -->
        <div class="form-group">
            <label for="paymentMethod">Forma de pagamento</label>
            <select class="form-control" name="billingType" id="billingType" onchange="toggleCartaoFields()">
                <option value="pix">Pix</option>
                <option value="boleto">Boleto</option>
                <option value="cartao">Cartão de Crédito</option>
            </select>
        </div>

        <!-- Campos para cartão de crédito (inicialmente ocultos) -->
        <div id="cartaoFields" style="display: none;">
            <div class="form-group">
                <label for="titular_cartao">Titular do Cartão</label>
                <input type="text" class="form-control" name="titular_cartao" id="titular_cartao" placeholder="Nome completo do titular">
            </div>

            <div class="form-group">
                <label for="numero_cartao">Número do Cartão</label>
                <input type="text" class="form-control" name="numero_cartao" id="numero_cartao" placeholder="Número do cartão">
            </div>

         <div class="form-group">
            <label for="vencimento_cartao">Data de Vencimento</label>
            <div class="d-flex">
                <!-- Select para o mês -->
                <select class="form-control mr-2" name="mes_vencimento" id="mes_vencimento" >
                    <option value="">Mês</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
                </select>

                <!-- Select para o ano -->
                <select class="form-control" name="ano_vencimento" id="ano_vencimento" >
                    <option value="">Ano</option>
                    @for ($i = 2024; $i <= 2034; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>


            <div class="form-group">
                <label for="ccv">CCV</label>
                <input type="text" class="form-control" name="ccv" id="ccv" placeholder="Código de segurança (CCV)">
            </div>

         

           

            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço completo">
            </div>
        </div>
    </div>

    <div class="card-footer text-right">
        <button class="btn btn-success" type="submit">Avançar</button>
    </div>
</form>

<!-- Modal de resultado -->
<div class="modal fade" id="resultadoModal" tabindex="-1" aria-labelledby="resultadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultadoModalLabel">Resultado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="resultadoMensagem">
                <!-- Mensagem será inserida aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para enviar a requisição AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Captura o evento de submissão do formulário
        $('#adicionaCreditoForm').submit(function(e) {
            e.preventDefault(); // Impede o envio padrão do formulário

            // Envia os dados do formulário usando AJAX
            $.ajax({
                url: "{{ route('livcard-adicionar-credito') }}", // A rota especificada
                method: "POST",
                data: $(this).serialize(), // Serializa os dados do formulário
                success: function(response) {
                    // Exibe o retorno da requisição no modal
                    
                    $('#resultadoMensagem').text('Crédito adicionado com sucesso!'); // Mensagem de sucesso
                    $('#resultadoModal').modal('show'); // Exibe o modal
                    const jsonResponse = response;
                    const data = JSON.parse(jsonResponse);
                   
                    if (data.invoiceUrl) {
                        window.location.href = data.invoiceUrl;
                    } else {
                       setTimeout(function() {
                        window.location.href = "{{ route('livcard-home') }}"; // Rota para redirecionamento
                    }, 4000);
                    }
                      
                },
                error: function(xhr) {
                    // Exibe mensagem de erro no modal
                    $('#resultadoMensagem').text('Ocorreu um erro: ' + xhr.responseText); // Mensagem de erro
                    $('#resultadoModal').modal('show'); // Exibe o modal
                }
            });
        });
    });
</script>

<!-- Script para exibir/ocultar os campos do cartão de crédito -->
<script>
    function toggleCartaoFields() {
        var paymentMethod = document.getElementById("billingType").value;
        var cartaoFields = document.getElementById("cartaoFields");

        if (paymentMethod === "cartao") {
            cartaoFields.style.display = "block";
        } else {
            cartaoFields.style.display = "none";
        }
    }
</script>


           
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


    @include('dashboard.footer')
    
    <script>
      $("#lineChart").sparkline([1002, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
