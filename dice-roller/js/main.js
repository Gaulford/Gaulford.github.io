(function() {
  this.timeRemove = 0;
  this.ctrlError = (function(_this) {
    return function(instantClean) {
      if (instantClean) {
        return $(".error").fadeOut(300);
      } else {
        clearTimeout(_this.timeRemove);
        $(".error").empty();
        $(".error").fadeIn(300);
        return _this.timeRemove = setTimeout(function() {
          return $(".error").fadeOut(300, function() {
            return $(this).empty();
          });
        }, 5000);
      }
    };
  })(this);
  this.msgTeste = (function(_this) {
    return function(msg, sucessos) {
      switch (msg) {
        case "sorte":
          return $("<li><p><strong>" + _this.infoTeste.nome + "</strong>: rolou um teste de sorte.</p><p><strong>Resultado:</strong> <em>" + sucessos + "</em></p></li>").prependTo(".lista-resultados");
        case "init":
          return $("<li><p><strong>" + _this.infoTeste.nome + "</strong>: rolou iniciativa.</p><p><strong>Resultado:</strong> <em>Iniciativa " + sucessos + "</em></p></li>").prependTo(".lista-resultados");
        case "vantage":
          _this.ctrlError();
          return $("<p>Você precisa de pelo menos 1 ponto em Atributos ou Habilidades para conseguir realizar o teste.</p>").appendTo(".error");
        case "no-dice":
          _this.ctrlError();
          return $("<p>Você não possuí dados para realizar o teste.</p>").appendTo(".error");
        default:
          return $("<li><p><strong>" + _this.infoTeste.nome + "</strong>: rolou <strong>" + _this.infoTeste.rolagemPadrao + "</strong> dados para " + _this.infoTeste.acao + ".</p><p><strong>Resultado:</strong> <em>" + sucessos + "</em></p></li>").prependTo(".lista-resultados");
      }
    };
  })(this);
  this.rolarDados = (function(_this) {
    return function(fail) {
      var count, dice, failure, i, len, resultado, rolagem, rolagens;
      count = new Number(1.);
      failure = new Number(0);
      rolagens = new Array();
      resultado = new Array();
      while (count <= _this.infoTeste.rolagemPadrao) {
        dice = Math.round(Math.random() * (10 - 1) + 1);
        if (dice === 10) {
          rolagens.push(dice);
        } else if (dice === 1) {
          rolagens.push(dice);
          failure++;
          count++;
        } else {
          rolagens.push(dice);
          count++;
        }
      }
      console.log(rolagens);
      for (i = 0, len = rolagens.length; i < len; i++) {
        rolagem = rolagens[i];
        if (rolagem >= _this.infoTeste.dificuldade) {
          resultado.push(rolagem);
        }
      }
      if (fail) {
        resultado = resultado.length + _this.infoTeste.sucessosAuto - failure;
      } else {
        resultado = resultado.length + _this.infoTeste.sucessosAuto;
      }
      if (resultado === 0) {
        resultado = "Falha.";
        return msgTeste("default", resultado);
      } else if (resultado < 0) {
        resultado = "Falha Crítica.";
        return msgTeste("default", resultado);
      } else {
        resultado = resultado + " Sucessos.";
        return msgTeste("default", resultado);
      }
    };
  })(this);
  this.iniciativa = (function(_this) {
    return function() {
      var iniciativa, resultado;
      iniciativa = Math.round(Math.random() * 10);
      resultado = _this.infoTeste.atributo + _this.infoTeste.habilidade + iniciativa;
      return msgTeste("init", resultado);
    };
  })(this);
  this.sorte = (function(_this) {
    return function() {
      var resultado;
      resultado = Math.round(Math.random() * (10 - 1) + 1);
      if (resultado === 10) {
        return msgTeste("sorte", resultado = "Sucesso");
      } else if (resultado === 1) {
        return msgTeste("sorte", resultado = "Falha crítica");
      } else {
        return msgTeste("sorte", resultado = "Falha");
      }
    };
  })(this);
  this.init = (function(_this) {
    return function() {
      return $("#rolar,#iniciativa,#sorte").on("click", function(event) {
        var targetID;
        targetID = event.target.id;
        event.preventDefault();
        _this.ctrlError(true);
        _this.infoTeste = {
          nome: $("#nome").val(),
          acao: $("#acao").val(),
          atributo: Number($("#atributo").val()),
          habilidade: Number($("#habilidade").val()),
          vantagens: Number($("#vantagens").val()),
          penalidade: Number($("#penalidades").val()),
          sucessosAuto: Number($("#sucesso").val()),
          dificuldade: Number($("#dificuldade").val()),
          rolagemPadrao: new Number()
        };
        _this.infoTeste.rolagemPadrao = _this.infoTeste.atributo + _this.infoTeste.habilidade + _this.infoTeste.vantagens - _this.infoTeste.sucessosAuto - _this.infoTeste.penalidade;
        if (targetID === "rolar") {
          if ((_this.infoTeste.atributo <= 0 && _this.infoTeste.habilidade <= 0) && _this.infoTeste.vantagens > 0) {
            _this.msgTeste("vantage");
          } else if (_this.infoTeste.rolagemPadrao <= 0) {
            _this.msgTeste("no-dice");
          } else {
            rolarDados();
          }
        }
        if (targetID === "iniciativa") {
          return iniciativa();
        } else {
          return sorte();
        }
      });
    };
  })(this);
  return $(function() {
    return init();
  });
})();
