<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href='packages/core/main.min.css' rel='stylesheet'/>
<link href='packages/daygrid/main.css' rel='stylesheet'/>
<link href='packages/timegrid/main.css' rel='stylesheet'/>
<link href='css/style.css' rel='stylesheet'/>
<script src='packages/core/main.min.js'></script>
<script src='packages/core/locales/pt-br.js'></script>
<script src='packages/interaction/main.js'></script>
<script src='packages/daygrid/main.js'></script>
<script src='packages/timegrid/main.js'></script>

<!-- O Slim exclui os efeitos então tirei o slim do link e funcionou. Não precisei pegar o jquery do google<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


</head>
<body>
<?php
  if(isset( $_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
?>
<div id='calendar'></div>

<!-- Modal Visualizar-->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<!-- Modal View-Edit -->
<div class="modal-body">

  <div class="view-event">
    <dl class="row">
      <dt class="col-sm-3">ID do evento:</dt>
      <dd class="col-sm-9" id="id"></dd>

      <dt class="col-sm-3">Title:</dt>
      <dd class="col-sm-9" id="title"></dd>

      <dt class="col-sm-3">Color:</dt>
      <dd class="col-sm-9"><input type="color" id="color" name="color" value="#ff0000"></dd>
      
      <dt class="col-sm-3">Start:</dt>
      <dd class="col-sm-9" id="start"></dd>

      <dt class="col-sm-3">End:</dt>
      <dd class="col-sm-9" id="end"></dd>
    </dl>
    <button class="btn btn-warning btn-cancel-view">Editar</button>
  </div>

  <div class="form-edit">
    <form id="editevent" name="editevent" method="POST" enctype="multipart/form-data">            
      <input type="hidden"  name="id" id="id" placeholder="id">

      <div class="form-group row">                
        <label class="col-sm-2 col-form-label">Title:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="title" id="title" placeholder="title">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Color:</label>
        <div class="col-sm-10">
          Select your favorite color: 
          <input type="color" id="color" name="color" value="#ff0000"><br><br>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Start</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="start" id="start"  onkeypress="DataHora(event, this)">
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">End</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="end" id="end" onkeypress="DataHora(event, this)">
        </div>
      </div>

      <div class="form-group row">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cancel-edit">Cancel</button>
          <button type="submit" id="EditEvent" name="EditEvent" value="EditEvent" class="btn btn-success">Save Changes</button>
        </div>
      </div>  
    </form>
  </div>
</div>

<!-- Modal Cadastrar-->
<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span id="msg-cad"></span>
          <form id="addevent" name="addevent" method="POST" enctype="multipart/form-data">
      
            <div class="form-group row">
            
              <label class="col-sm-2 col-form-label">Title:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title" id="title" placeholder="title">
              </div>
            </div>
          
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Color:</label>
              <div class="col-sm-10">
              Select your favorite color: 
              <input type="color" id="color" name="color" value="#ff0000"><br><br>
                <!-- <select name="color" id="color" class="form-control form-control-lg">
                  <option value="">Selecione</option>
                  <option value="#000000">Preto</option>
                  <option value="#ffffff">Branco</option>
                  <option value="#0071c5">Azul Turquesa</option>
                </select> -->
              </div>
            </div>
          
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Start</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="start" id="start"  onkeypress="DataHora(event, this)">
              </div>
            </div>
          
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">End</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="end" id="end" onkeypress="DataHora(event, this)">
              </div>
            </div>

            <div class="form-group row">

            <!-- <input type="submit" id="CadEvent" name="CadEvent" value="CadEvent" class="btn btn-success"> -->
              <button type="submit" id="CadEvent" name="CadEvent" value="CadEvent" class="btn btn-success">Cadastrar</button>
            </div>
          </form>
      </div>

    </div>
  </div>
</div>

<script src="js/calendar.js"></script>
</body>
</html>
