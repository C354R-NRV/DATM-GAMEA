$(document).ready(function () {
    toggleInfoPanel();
    var bkcontentHtml = $('#contenidoRecurso').html();

    $('#user-input').on('keydown', function (event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

    $('.mensajeBtnIa').click(sendMessage);


    var currentHighlightIndex = -1;
    var highlights = [];
    var antsearchText = '';
    var swSearch = 1;
    var antsearchText = '';

    $('#search-button').click(function () {
        presearch();
    });


    $('#search-input').on('keypress', function (e) {
        if (e.which === 13 || $('#search-input').val().length > 3) {
            presearch();
        }
    });

    function presearch() {
        console.log("presearch, swSearch:" + swSearch + ", antsearchText:" + antsearchText);
        if (antsearchText != $('#search-input').val().toLowerCase()) {
            highlights = [];
            antsearchText = $('#search-input').val().toLowerCase();
            swSearch = 1;
            $('#contenidoRecurso').html(normalizeString(bkcontentHtml));
        }
        if (swSearch) {
            swSearch = 0;
            antsearchText = $('#search-input').val().toLowerCase();
            performSearch();
        } else {
            navigateHighlights();
        }
    }

    function normalizeString(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    function performSearch() {
        var searchText = $('#search-input').val().toLowerCase();
        console.log("en performSearch, con searchText:" + searchText);
        var $content = $('#contenidoRecurso');
        var contentHtml = $content.html();

        if (searchText && ($('#search-input').val()).length > 3) {

            var highlightedContent = contentHtml.replace(new RegExp(normalizeString(searchText), 'gi'), function (match) {
                return '<span class="highlight">' + match + '</span>';
            });
            $content.html(highlightedContent);
            highlights = $content.find('.highlight');
            currentHighlightIndex = -1;
            navigateHighlights();
        } else {
            antsearchText = searchText;
            $content.html(contentHtml);
            highlights = [];
        }
    }

    function navigateHighlights() {

        if (highlights) {

            var $content = $('#contenidoRecurso');
            currentHighlightIndex = (currentHighlightIndex + 1) % highlights.length;
            var $currentHighlight = $(highlights[currentHighlightIndex]);

            $('.current-highlight').removeClass('current-highlight');
            $currentHighlight.addClass('current-highlight');

            $content.animate({
                scrollTop: $currentHighlight.offset().top - $content.offset().top + $content.scrollTop()
            }, 500);
        }
    }

});

function toggleInfoPanel() {
    const $infoPanel = $('#info-panel');
    const $mainContent = $('#main-content');
    const $showBtn = $('#show-btn');

    if ($infoPanel.hasClass('hidden')) {
        $('#contenBtn').html(' >> ');
        $infoPanel.removeClass('hidden');
        $mainContent.removeClass('col-12').addClass('col-6');

    } else {
        $('#contenBtn').html(' <img class="img-fluid" src="../img/ia.gif" style="height: 2rem;" alt=""> ');
        //$('.chat-box').html('');

        $infoPanel.addClass('hidden');
        $mainContent.removeClass('col-6').addClass('col-12');
        $showBtn.addClass('hidden');

        const $chatBox = $('#chat-box');
        let tituloPrincipal = $('#tituloPrincipal').html();
        const botMessage = $('<div>').addClass('chat-message').text(`Hola!, soy DATM inteligente, estoy lista para responder a tus consultas sobre: "${tituloPrincipal}"`);
        $chatBox.append(botMessage);
    }
}

var swVision = true;
function toggleVisionPanel() {

    if (swVision) {
        $('#contenBtnVision').html(' <img class="img-fluid" src="../img/sol.png" style="height: 2rem;" alt=""> ');
        $('.containermt-5').css({
            'background-color': '#ededed',
            'important': 'true'
        });
        $('#contenidoRecurso').css({
            'background-color': '#ededed',
            'color': '#19232b',
            'important': 'true'
        });
        $('#contenidoRecurso').find('h1, h2, h3, h4, h5').css({
            'color': '#19232b',
            'important': 'true'
        });
        swVision = false;

    } else {
        $('.containermt-5').css({
            'background-color': '#19232b',
        });
        $('#contenidoRecurso').css({
            'background-color': '#19232b',
            'color': '#cbcbcb',
            'important': 'true'
        });
        $('#contenidoRecurso').find('h1, h2, h3, h4, h5').css({
            'color': '#cbcbcb',
            'important': 'true'
        });
        $('#contenBtnVision').html(' <img class="img-fluid" src="../img/luna.png" style="height: 2rem;" alt=""> ');
        swVision = true;
    }
    bkcontentHtml = $('#contenidoRecurso').html();
}

function sendMessage() {
    const userInput = $('#user-input').val().trim();
    if (userInput === '') return;

    const $chatBox = $('#chat-box');
    const userMessage = $('<div>').addClass('chat-message text-end').text(`${userInput}`);

    $chatBox.append(userMessage);
    datos = '&modalidad=chat' +'&promptUser=' + userInput + "&recurso=" + $('#recurso_').val() + "&tituloPrincipal=" + $('#tituloPrincipal').html();
    console.log(datos);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "html",
        contentType: "application/x-www-form-urlencoded",
        url: "../php/apiGemini.php",
        data: datos,
        beforeSend: function () {
            loadGralOn();
            console.log("cargando...");
        },
        success: function (response) {
            console.log(response);

            /*dat = $.parseJSON(response);
            console.log(dat.promt);
            console.log(dat.detalles); */

            loadGralOff();
            const botMessage = $('<div>').addClass('chat-message').html(`${response}`);
            $chatBox.append(botMessage);
            setTimeout(function () {
                $chatBox.scrollTop($chatBox.prop('scrollHeight'));
            }, 100);

        },
        timeout: 16000,
        error: function () { }
    });
    $('#user-input').val('');
    setTimeout(function () {
        $chatBox.scrollTop($chatBox.prop('scrollHeight'));
    }, 100);
}