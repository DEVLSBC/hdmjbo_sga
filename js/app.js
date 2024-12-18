
function mostrarPaciente(){
    
    const nome = document.getElementById("nomePaciente");
    const sala = document.getElementById("salaPaciente");
    const prio = document.getElementById("prioPaciente");

    const printNome = document.createElement('span');
    printNome.textContent = nome.textContent + sala.textContent;

    alert("O paciente "+nome.textContent+" foi chamado!");

}

/*

// Função responsável por atribuir os valores dos respectivos IDs a suas variáveis.

    var audioChamada = $("#audioChamada");
    var nome = document.querySelector("#cadastro");
    var local = document.querySelector("#sala");
    var prio = document.querySelector("#prio");
    var nomepen = document.querySelector("#cadastropen");
    var localpen = document.querySelector("#salapen");
    var priopen = document.querySelector("#priopen");
    
// Função responsável por dar play no arquivo de som assim como chamar a API do navegador responsável por falar
// o ultimo paciente cadastrado, assim como sua respectiva sala de destino.
    function chamar(){
        audioChamada.trigger("play");
        var apisala = "Dirija-se ao " + local.textContent;
        var apiprio = "Prioridade " + prio.textContent;
        setTimeout(function() {
             // código a ser executado após 1 segundo
            let ut = new SpeechSynthesisUtterance(nome.textContent);
            window.speechSynthesis.speak(ut);
            let ut2 = new SpeechSynthesisUtterance(apisala);
            window.speechSynthesis.speak(ut2);
            let ut3 = new SpeechSynthesisUtterance(apiprio);
            window.speechSynthesis.speak(ut3);
         }, 1000);
    }

// Função responsável por dar play no arquivo de som assim como chamar a API do navegador responsável por falar
// o penultimo paciente cadastrado, assim como sua respectiva sala de destino.
    function chamarpen(){
        audioChamada.trigger("play");
        var apisalapen = "Dirija-se ao " + localpen.textContent;
        var apipriopen = "Prioridade " + priopen.textContent;
        setTimeout(function() {
             // código a ser executado após 1 segundo
            let ut = new SpeechSynthesisUtterance(nomepen.textContent);
            window.speechSynthesis.speak(ut);
            let ut2 = new SpeechSynthesisUtterance(apisalapen);
            window.speechSynthesis.speak(ut2);
            let ut3 = new SpeechSynthesisUtterance(apipriopen);
            window.speechSynthesis.speak(ut3);
         }, 1000);
    }
*/