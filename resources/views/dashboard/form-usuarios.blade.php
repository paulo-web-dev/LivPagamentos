@include('dashboard.header')
<div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Cadastrar Usuário</h3>
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
                  <a href="#">Usuário</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card"> 
                  <div class="card-header">
                    <h4 class="card-title">Cadastro de Usuários</h4>
                  </div>
                  <form action="{{route('cad-usuario')}}" method="post">
                  @csrf
                  <div class="card-body">
                     <div class="form-group form-inline">
                          <label
                            for="inlineinput"
                         
                            class="col-md-3 col-form-label"
                            >Nome Usuário</label
                          >
                          <div class="col-md-9 p-0">
                            <input
                              type="text"
                              class="form-control input-full"
                              id="inlineinput"
                              name="nome"
                              placeholder="Insira o Nome do Usuário"
                            />
                          </div>
                        </div>

                         <div class="form-group form-inline">
                          <label
                            for="inlineinput"
                            class="col-md-3 col-form-label"
                            >Email Usuário</label
                          >
                          <div class="col-md-9 p-0">
                            <input
                              type="email"
                              class="form-control input-full"
                              id="inlineinput"
                              name="email"
                              placeholder="Insira o Email do Usuário"
                            />
                          </div>
                        </div>
                      

                         <div class="form-group form-inline">
                          <label
                            for="inlineinput"
                            class="col-md-3 col-form-label"
                            >Senha Usuário</label
                          >
                          <div class="col-md-9 p-0">
                            <input
                              type="password"
                              class="form-control input-full"
                              id="inlineinput"
                              name="senha"
                              placeholder="Insira a Senha do Usuário"
                            />
                          </div>
                        </div>

                        

                        
                  </div>
                    <div class="card-action">
                    <button class="btn btn-success" type="submit">Cadastrar Usuario</button>
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
