@include('dashboard.header')
<div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Cadastrar Transação</h3>
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
                  <a href="#">Transações</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card"> 
                  <div class="card-header">
                    <h4 class="card-title">Cadastro de Transações</h4>
                  </div>
                  <form action="{{route('cad-transacao-credito')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                          <label for="defaultSelect">Usuário</label>
                          <select
                            class="form-select form-control"
                            name="usuario"
                          >
                          @foreach ($users as $user)
                              <option value="{{$user->id}}">{{$user->name}} - R${{$user->saldo}}</option>
                          @endforeach
                            
                           
                          </select>
                      </div>

                          
                      

                          <div class="form-group">
                          <label for="defaultSelect">Valor</label>
                          <select
                            class="form-select form-control"
                            name="valor"
                          >
                          @for ($i = 1; $i < 11 ; $i++)
                               <option value="{{$i*50}}">R${{$i*50}},00</option>
                          @endfor
                             
                          
                            
                           
                          </select>
                      </div>
                  </div>
                    <div class="card-action">
                    <button class="btn btn-success" type="submit">Realizar Transação</button>
                    {{-- <button class="btn btn-danger">Cancel</button> --}}
                  </div>
                  </form>
                </div>
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
