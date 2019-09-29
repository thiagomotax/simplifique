function InsereDisciplina(id) {

      var idDisciplina = $('#rowInsereDisciplina_' + (id)).attr("data-id");
      var nomeDisciplina = $('#rowInsereDisciplina_' + (id)).attr("data-nome");
      var nomeProfessor = $('#rowInsereDisciplina_' + (id)).attr("data-nomeProfessor");
      var contato = $('#rowInsereDisciplina_' + (id)).attr("data-contato");
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
          type: "POST",
          url: "../view/viewAjaxFrequenciaAluno.php",
          data: {
                idDisciplina: idDisciplina
                },
          success: function (result) {
          alert(result);
          $('#disciplinaTitulo').val(nomeDisciplina);
          $('#professorTitulo').val(nomeProfessor);
          $('.informacoes').show();
          atualizarTabela();
          $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do Professor ");
          $('.modal .modal-dialog .modal-content #nome').val(nomeProfessor);
          $('.modal .modal-dialog .modal-content #contato').val(contato);
          $body.removeClass("loading");

              }
          });

      return false;
 }


 function InsereDisciplina2(id) {

      var idDisciplina = $('#rowInsereDisciplina_' + (id)).attr("data-id");
      var nomeDisciplina = $('#rowInsereDisciplina_' + (id)).attr("data-nome");
      var nomeProfessor = $('#rowInsereDisciplina_' + (id)).attr("data-nomeProfessor");
      var contato = $('#rowInsereDisciplina_' + (id)).attr("data-contato");
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
          type: "POST",
          url: "../view/viewAjaxCronogramaAluno.php",
          data: {
                idDisciplina: idDisciplina
                },
          success: function (result) {
          alert(result);
          $('#disciplinaTitulo').val(nomeDisciplina);
          $('#professorTitulo').val(nomeProfessor);
          $('.informacoes').show();
          atualizarTabela();
          $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do Professor ");
          $('.modal .modal-dialog .modal-content #nome').val(nomeProfessor);
          $('.modal .modal-dialog .modal-content #contato').val(contato);
          $body.removeClass("loading");

              }
          });

      return false;
 }
 
 
  function InsereDisciplina3(id) {

      var idDisciplina = $('#rowInsereDisciplina_' + (id)).attr("data-id");
      var nomeDisciplina = $('#rowInsereDisciplina_' + (id)).attr("data-nome");
      var nomeProfessor = $('#rowInsereDisciplina_' + (id)).attr("data-nomeProfessor");
      var contato = $('#rowInsereDisciplina_' + (id)).attr("data-contato");
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
          type: "POST",
          url: "../view/viewAjaxAnexoAluno.php",
          data: {
                idDisciplina: idDisciplina
                },
          success: function (result) {
          alert(result);
          $('#disciplinaTitulo').val(nomeDisciplina);
          $('#professorTitulo').val(nomeProfessor);
          $('.informacoes').show();
          atualizarTabela();  
          $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do Professor ");
          $('.modal .modal-dialog .modal-content #nome').val(nomeProfessor);
          $('.modal .modal-dialog .modal-content #contato').val(contato);
          $body.removeClass("loading");

              }
          });

      return false;
 }

 function verProfessor() {

    $('#verProfessor').modal('show');

  }

 
  /*function IniciaDownload(id) {

      var nomeFile = $('#rowDownload_' + (id - 1)).attr("data-nome");
      var tipoFile = $('#rowDownload_' + (id - 1)).attr("data-tipo");
      var localFile = $('#rowDownload_' + (id - 1)).attr("data-local");
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
          type: "POST",
          url: "../controller/Download.php",
          data: {
                nomeFile: nomeFile,
                tipoFile: tipoFile,
                localFile: localFile
                },
          success: function (result) {
          alert(result);
          $body.removeClass("loading");

              }
          });

      return false;
 }
 */
 
 
/* function excluirAluno(id) {
  var nome = $('#rowDeleteAluno_' + (id - 1)).attr("data-nome");
  var id = $('#rowDeleteAluno_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o aluno " + nome + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#D05BE2",
      confirmButtonText: "<i class='fa fa-times'></i> Excluir",
      cancelButtonText: "<i class='fa fa-check'></i> Cancelar",
      preConfirm: function () {
        $body = $("body");
        $body.addClass("loading");
          $.ajax({
              type: "POST",
              url: "../controller/ControllerAluno.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Aluno excluído com sucesso!", " Ver alunos", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir o aluno!", " Ver alunos", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }

              }
          });
      }
  });
  return false;
} */
  function alerta(type, title, button, footer, link){
    Swal.fire({
      type: type,
      showConfirmButton: false,
      html:
      '<button id="ok" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i>'+ button +'</button>',
      title: title,
      footer: '<a href="'+link+'">'+footer+'</a>'
    });
    $("#ok").click(function () {
      Swal.close();
    });
  }

  function atualizarTabela(){
    var table = $('#frequencia').DataTable();
    table.ajax.reload(null, false);
  }


