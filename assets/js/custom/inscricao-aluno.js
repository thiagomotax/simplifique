function aceitarInscricao(id) {
  var nome = $('#rowAceitarInscricaoAluno_' + (id - 1)).attr("data-nome");
  var idI = $('#rowAceitarInscricaoAluno_' + (id - 1)).attr("data-idI");
  var idC = $('#rowAceitarInscricaoAluno_' + (id - 1)).attr("data-idC");
  var idU = $('#rowAceitarInscricaoAluno_' + (id - 1)).attr("data-idU");

  Swal.fire({
      title: "Deseja realmente aceitar a inscrição de " + nome + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#D05BE2",
      confirmButtonText: "<i class='fa fa-times'></i> Aceitar",
      cancelButtonText: "<i class='fa fa-check'></i> Cancelar",
      preConfirm: function () {
        $body = $("body");
        $body.addClass("loading");
          $.ajax({
              type: "POST",
              url: "../controller/ControllerInscricaoAluno.php",
              data: {
                  acao: "aceitar",
                  idI: idI,
                  idU: idU,
                  idC: idC
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Inscrição Aceita com sucesso!", " Ver inscrições", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao aceitar a inscrição!", " Ver inscrições", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }

              }
          });
      }
  });
  return false;
}

function rejeitarInscricao(id) {
  var nome = $('#rowRejeitarInscricaoAluno_' + (id - 1)).attr("data-nome");
  var id = $('#rowRejeitarInscricaoAluno_' + (id - 1)).attr("data-idI");

  Swal.fire({
      title: "Deseja realmente rejeitar a inscrição de " + nome + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#D05BE2",
      confirmButtonText: "<i class='fa fa-times'></i> Rejeitar",
      cancelButtonText: "<i class='fa fa-check'></i> Cancelar",
      preConfirm: function () {
        $body = $("body");
        $body.addClass("loading");
          $.ajax({
              type: "POST",
              url: "../controller/ControllerInscricaoAluno.php",
              data: {
                  acao: "rejeitar",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Inscrição rejeitada com sucesso!", " Ver inscrições", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao rejeitar a inscrição!", " Ver inscrições", "Adicionar novo aluno", "viewAdicionarAluno.php");
                    atualizarTabela();
                  }

              }
          });
      }
  });
  return false;
}
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
    var table = $('#listar_inscricoes_alunos').DataTable();
    table.ajax.reload(null, false);
  }
