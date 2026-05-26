<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text to Speech</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        button {
            background-color: #16a7c4;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button:hover {
            background-color: #1397b3;
        }
        .status {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            background-color: #e8f5e9;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Text to Speech</h1>
        
        <div class="form-group">
            <label for="text-input">Texto a sintetizar:</label>
            <textarea id="text-input">Hola, este es un ejemplo de texto a voz.</textarea>
        </div>
        
        <div class="form-group">
            <label for="language-filter">Idioma:</label>
            <select id="language-filter">
                <option value="es-US" selected>Español (Estados Unidos)</option>
                <option value="es">Español (todos)</option>
                <option value="es-ES">Español (España)</option>
                <option value="es-MX">Español (México)</option>
                <option value="en-US">Inglés (Estados Unidos)</option>
            </select>
        </div>
        
        <div class="controls">
            <button id="speak-btn">Reproducir</button>
            <button id="stop-btn">Detener</button>
        </div>
        
        <div id="status" class="status"></div>
    </div>

    <script>
        $(document).ready(function() {
            var voices = [];
            var selectedVoice = null;
            
            // Inicializar la síntesis de voz
            function initSpeechSynthesis() {
                if ('speechSynthesis' in window) {
                    // Cargar voces cuando estén disponibles
                    window.speechSynthesis.onvoiceschanged = function() {
                        loadVoices();
                    };
                    
                    // Intentar cargar voces inmediatamente (para navegadores que ya las tienen cargadas)
                    loadVoices();
                } else {
                    showStatus("Tu navegador no soporta la API de síntesis de voz.", "error");
                }
            }
            
            // Cargar las voces disponibles
            function loadVoices() {
                voices = window.speechSynthesis.getVoices();
                selectVoiceByLanguage($('#language-filter').val());
            }
            
            // Seleccionar voz según el idioma
            function selectVoiceByLanguage(language) {
                // Primero buscar una coincidencia exacta
                selectedVoice = voices.find(voice => voice.lang === language);
                
                // Si no hay coincidencia exacta, buscar una que comience con el código de idioma
                if (!selectedVoice && language.includes('-')) {
                    const baseLanguage = language.split('-')[0];
                    selectedVoice = voices.find(voice => voice.lang.startsWith(baseLanguage));
                }
                
                // Si aún no hay coincidencia, usar la primera voz disponible
                if (!selectedVoice && voices.length > 0) {
                    selectedVoice = voices[0];
                }
                
                if (selectedVoice) {
                    showStatus("Voz seleccionada: " + selectedVoice.name, "success");
                }
            }
            
            // Función para sintetizar el texto
            function textToSpeech() {
                const text = $('#text-input').val();
                
                if (!text) {
                    showStatus("Por favor, ingresa un texto para reproducir.", "error");
                    return;
                }
                
                // Detener cualquier reproducción en curso
                window.speechSynthesis.cancel();
                
                // Crear un nuevo objeto de síntesis de voz
                const utterance = new SpeechSynthesisUtterance(text);
                
                // Asignar la voz seleccionada si existe
                if (selectedVoice) {
                    utterance.voice = selectedVoice;
                } else {
                    // Si no hay voz seleccionada, establecer el idioma
                    utterance.lang = $('#language-filter').val();
                }
                
                // Configurar parámetros
                utterance.rate = 0.9;  // Velocidad (un poco más lento que el valor predeterminado)
                utterance.pitch = 1.0; // Tono
                utterance.volume = 1.0; // Volumen
                
                // Eventos
                utterance.onstart = function() {
                    showStatus("Reproduciendo...", "info");
                };
                
                utterance.onend = function() {
                    showStatus("Reproducción completada.", "success");
                };
                
                utterance.onerror = function(event) {
                    showStatus("Error en la reproducción: " + event.error, "error");
                };
                
                // Reproducir
                window.speechSynthesis.speak(utterance);
            }
            
            // Mostrar mensaje de estado
            function showStatus(message, type) {
                var $status = $('#status');
                $status.text(message);
                $status.css('background-color', 
                    type === 'error' ? '#ffebee' :
                    type === 'success' ? '#e8f5e9' : '#e3f2fd');
                $status.show();
                
                // Ocultar después de 5 segundos si es un mensaje de éxito
                if (type === 'success') {
                    setTimeout(function() {
                        $status.fadeOut();
                    }, 5000);
                }
            }
            
            // Eventos
            $('#language-filter').on('change', function() {
                selectVoiceByLanguage($(this).val());
            });
            
            // Botón reproducir
            $('#speak-btn').on('click', function() {
                textToSpeech();
            });
            
            // Botón detener
            $('#stop-btn').on('click', function() {
                window.speechSynthesis.cancel();
                showStatus('Reproducción detenida.', 'info');
            });
            
            // Inicializar
            initSpeechSynthesis();
        });
    </script>
</body>
</html>