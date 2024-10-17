@include('dashboard.header')
<div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Cadastrar Produto</h3>
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
                  <a href="#">Produtos</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card"> 
                  <div class="card-header">
                    <h4 class="card-title">Cadastro de Produto</h4>
                  </div>
                  <form action="{{route('cad-produto')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                     <div class="form-group form-inline">
                          <label
                            for="inlineinput"
                         
                            class="col-md-3 col-form-label"
                            >Nome do Produto</label
                          >
                          <div class="col-md-9 p-0">
                            <input
                              type="text"
                              class="form-control input-full"
                              id="inlineinput"
                              name="nome"
                              placeholder="Insira o Nome do Produto"
                            />
                          </div>
                        </div>

                         <div class="form-group form-inline">
                          <label
                            for="inlineinput"
                            class="col-md-3 col-form-label"
                            >Valor do Produto</label
                          >
                          <div class="col-md-9 p-0">
                            <input
                              type="number"
                              class="form-control input-full"
                              id="inlineinput"
                              name="valor"
                              placeholder="Insira o Valor do Produto"
                            />
                          </div>
                        </div>
                      

                      
                        <div class="form-group">
                          <label for="defaultSelect">Quantidade ou Hora</label>
                          <select
                            class="form-select form-control"
                            name="quantidade_hora"
                          >
                         
                            <option value="hora">Hora</option>
                            <option value="quantidade">Quantidade</option>    
                           
                          </select>
                      </div>

                        
                    <div class="form-group">
                        <label for="productImage">Foto do Produto</label>
                        <input type="file" class="form-control" id="productImage" name="file" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <!-- Local onde a imagem será exibida -->
                    <div class="form-group">
                        <img id="imagePreview" src="" alt="Pré-visualização da Imagem" style="max-width: 100%; height: auto; display: none;">
                    </div>

                    <script>
                    function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function(){
                            var output = document.getElementById('imagePreview');
                            output.src = reader.result;
                            output.style.display = 'block'; // Exibe a imagem
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                    </script>
                    <div class="card-action">
                    <button class="btn btn-success" type="submit">Cadastrar Produto</button>
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
