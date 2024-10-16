@include('livcard.header')
        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Seja Bem Vindo a Área LivCard</h3>
                <h6 class="op-7 mb-2">{{$usuario->name}}</h6>
              </div>
              {{-- <div class="ms-md-auto py-2 py-md-0">
                <a href="{{route('form-transacao')}}" class="btn btn-label-info btn-round me-2">Adicionar Transação </a>
                <a href="{{route('form-usuario')}}" class="btn btn-primary btn-round">Adicionar Usuários</a>
              </div> --}}
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">ID do Usuário</p>
                          <h4 class="card-title">{{$usuario->id}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
 
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Saldo</p>
                          <h4 class="card-title">R$ {{$usuario->saldo}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
         
            
            <div class="row">
           
              <div class="col-md-8">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Transações Recentes</div>
                      <div class="card-tools">
                        <div class="dropdown">
                          <button
                            class="btn btn-icon btn-clean me-0"
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                          >
                            <a class="dropdown-item" href="#">Ver Todas</a>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Produto</th>
                           
                            <th scope="col" class="text-end">Quantidade</th>
                            
                               <th scope="col" class="text-end">Valor</th>
                            <th scope="col" class="text-end">Status</th>
                             <th scope="col" class="text-end">Data</th>
                          </tr>
                        </thead>
                        <tbody> 

                        @foreach ($usuario->transacoes as $transacao)
                            
                        
                          <tr>

                        
                            <td class="text-end">{{$transacao->produto->nome}}</td>
                            <td class="text-end">{{$transacao->quantidade}}</td>
                             
                            <td class="text-end">R${{$transacao->valor}}</td>
                            <td class="text-end">
                              <span class="badge badge-success">Completada</span>
                            </td>
                            <td class="text-end">{{$transacao->created_at}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
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
