@include('dashboard.header')
<div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Usuários Cadastrados</h3>
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
                  <a href="#">Usuários</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Listagem de Usuários</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Saldo</th>
                            <th>Data de Cadastro</th>
                           
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Saldo</th>
                            <th>Data de Cadastro</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($usuarios as $usuario )
                         <tr>
                          <td>{{$usuario->name}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>R${{$usuario->saldo}}</td>
                            <td>{{$usuario->created_at}}</td>
                            <td>  <a  href="{{route('info-usuario', ['id' => $usuario->id])}}">Ver Mais</a></td>
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
