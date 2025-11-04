// Função de callback que será executada quando a API do Google Maps for carregada
        function initMap() {
            // Localização que queremos centralizar (Ex: Coordenadas de São Paulo)
            const myLatLng = { lat: -23.5505, lng: -46.6333 };

            // Cria um novo objeto de mapa
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12, // Nível de zoom
                center: myLatLng, // Centraliza o mapa na localização definida
            });

            // (Opcional) Adiciona um marcador (pin) no mapa
            new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: "São Paulo!",
            });
        }