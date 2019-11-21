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
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="js/calendar.js"></script>

</head>
<body>

<div id='calendar'></div>

<!-- Modal -->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <dt class="col-sm-3">ID do evento:</dt>
          <dd class="col-sm-9" id="id"></dd>

          <dt class="col-sm-3">Title:</dt>
          <dd class="col-sm-9" id="title"></dd>

          <dt class="col-sm-3">Color:</dt>
          <dd class="col-sm-9" id="color"></dd>

          <dt class="col-sm-3">Start:</dt>
          <dd class="col-sm-9" id="start"></dd>

          <dt class="col-sm-3">End:</dt>
          <dd class="col-sm-9" id="end"></dd>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>
