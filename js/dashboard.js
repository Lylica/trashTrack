const canalId = 3062564;
let chart;
let valores = [];
let datas = [];
let tipoGrafico = 'bar';
let todosOsDias = []; // Armazena todos os dias únicos carregados

// Elementos Desktop
const chartCtx = document.getElementById('chart').getContext('2d');
const dataTitulo = document.getElementById('data-titulo');
const selectDiaDesktop = document.getElementById('selecionar-dia');
const btnCSVDesktop = document.getElementById('btnCSV');
const btnsTipoGraficoDesktop = document.querySelectorAll('.barra-lateral .btn-group [data-tipo]');

// Elementos Mobile
const selectDiaMobile = document.getElementById('selecionar-dia-mobile');
const btnCSVMobile = document.getElementById('btnCSV-mobile');
const btnsTipoGraficoMobile = document.querySelectorAll('.sidebar-mobile .btn-group [data-tipo]');

// Variáveis da Sidebar Mobile (movidas para o topo para uso nas funções de clique)
const side = document.getElementById("sidebar-mobile"); 
const close = document.getElementById("close-sidebar");

// Função auxiliar para ler variáveis CSS
function lerVariavelCSS(nome) {
    // Tenta ler a variável. O trim() remove espaços em branco que o getPropertyValue pode retornar.
    return getComputedStyle(document.documentElement).getPropertyValue(nome).trim();
}

// --- Carrega dias disponíveis ---
async function carregarDias() {
    try {
        // Busca um grande número de resultados para extrair todos os dias únicos disponíveis
        const res = await fetch(`https://api.thingspeak.com/channels/${canalId}/feeds.json?results=800`);
        const data = await res.json();

        // Mapeia e filtra os dias de feeds válidos
        const dias = data.feeds
            .filter(f => f.field1 !== null && f.field1 !== "")
            .map(f => new Date(f.created_at).toLocaleDateString('pt-BR')); // Usando pt-BR para consistência

        todosOsDias = [...new Set(dias)];

        // Limpa e popula ambos os selects
        selectDiaDesktop.innerHTML = '';
        selectDiaMobile.innerHTML = '';
        
        todosOsDias.forEach(d => {
            const optDesktop = document.createElement('option');
            optDesktop.value = d;
            optDesktop.text = d;
            
            const optMobile = optDesktop.cloneNode(true);

            selectDiaDesktop.appendChild(optDesktop);
            selectDiaMobile.appendChild(optMobile);
        });

        if(todosOsDias.length > 0){
            // Seleciona o dia mais recente (último da lista)
            const diaMaisRecente = todosOsDias[todosOsDias.length - 1];
            selectDiaDesktop.value = diaMaisRecente;
            selectDiaMobile.value = diaMaisRecente;
            carregarDados(diaMaisRecente);
        }
    } catch(err) {
        console.error("Erro ao carregar dias:", err);
        alert("Erro ao carregar dias disponíveis. Verifique a conexão com o ThingSpeak.");
    }
}

// --- Carrega dados do dia selecionado ---
async function carregarDados(diaSelecionado) {
    try {
        // Busca os dados de campo 1 (nível), é mais eficiente que buscar todos os feeds
        const res = await fetch(`https://api.thingspeak.com/channels/${canalId}/fields/1.json?results=800`);
        const data = await res.json();

        valores = [];
        datas = [];

        // Usa um Map para garantir apenas o último valor de cada horário único
        const horarioMap = new Map();
        data.feeds.forEach(f => {
            if(f.field1 === null || f.field1 === "") return;
            const d = new Date(f.created_at);
            // Compara o dia no formato pt-BR
            if(d.toLocaleDateString('pt-BR') === diaSelecionado){
                const hora = d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
                // Armazena o objeto Date completo e o valor
                horarioMap.set(hora, {data: d, valor: Number(f.field1)});
            }
        });

        // Converte o Map para um array e ordena pelo timestamp completo (data)
        const sorted = [...horarioMap.entries()].sort((a, b) => a[1].data - b[1].data);

        datas = sorted.map(e => e[1].data);
        valores = sorted.map(e => e[1].valor);

        if(datas.length > 0) {
            dataTitulo.innerText = `Nível da Lixeira em ${diaSelecionado}`;
        } else {
            dataTitulo.innerText = `Nível da Lixeira (Sem dados para ${diaSelecionado})`;
        }

        atualizarGrafico();
    } catch(err) {
        console.error("Erro ao carregar dados:", err);
        alert("Erro ao carregar dados do dia: " + diaSelecionado);
    }
}

// --- Atualiza informações fixas ---
function atualizarInfoFixa() {
    const nivelAtualElement = document.getElementById('nivel-atual');
    const ultimaAtualizacaoElement = document.getElementById('ultima-atualizacao');
    const statusLixeiraElement = document.getElementById('status-lixeira');

    // Usa a função auxiliar para ler as cores do CSS
    const corPrimariaEscura = lerVariavelCSS('--cor-primaria-escura');
    const corDestaque = lerVariavelCSS('--cor-destaque');
    const corAlerta = lerVariavelCSS('--cor-alerta');


    if(valores.length === 0) {
        nivelAtualElement.innerText = '0%';
        ultimaAtualizacaoElement.innerText = '--:--';
        statusLixeiraElement.innerText = 'Sem dados';
        statusLixeiraElement.style.color = corPrimariaEscura; // Cor padrão
        return;
    }
    
    const i = valores.length - 1;
    const valor = valores[i];
    const data = datas[i];

    nivelAtualElement.innerText = valor + '%';
    ultimaAtualizacaoElement.innerText = data.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});

    let status = 'Normal';
    let statusColor = corDestaque; // Verde Destaque
    
    if (valor <= 20) {
        status = 'Vazio';
        statusColor = corPrimariaEscura; // Cor neutra
    } else if (valor >= 80) {
        status = 'Cheio';
        statusColor = corAlerta; // Vermelho/Alerta
    }
    
    statusLixeiraElement.innerText = status;
    statusLixeiraElement.style.color = statusColor;
}

// --- Atualiza gráfico ---
function atualizarGrafico() {
    if(chart) chart.destroy();
    
    if(valores.length === 0) {
        atualizarInfoFixa();
        return;
    }

    // Leitura das variáveis CSS para o Chart.js
    const COR_DESTAQUE = lerVariavelCSS('--cor-destaque'); // #44633F
    const COR_TERCIARIA = lerVariavelCSS('--cor-terciaria-clara'); // #DCDABE
    
    // RGBA do COR_DESTAQUE (#44633F -> rgb(68, 99, 63)) com 20% de opacidade para preenchimento de linha
    const COR_DESTAQUE_SUAVE = 'rgba(68, 99, 63, 0.2)'; 
    const COR_GRID = 'rgba(0, 0, 0, 0.1)';

    const labels = datas.map(d => d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}));
    
    chart = new Chart(chartCtx, {
        type: tipoGrafico === 'step' ? 'line' : 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nível (%)',
                data: valores,
                // Bar: Fundo Sólido. Line/Step: Fundo Suave e Linha Sólida.
                backgroundColor: tipoGrafico === 'bar' ? COR_DESTAQUE : COR_DESTAQUE_SUAVE, 
                borderColor: COR_DESTAQUE,
                borderWidth: tipoGrafico === 'step' ? 3 : 1,
                fill: tipoGrafico === 'step' ? 'origin' : false, // Preenche a área abaixo da linha
                stepped: tipoGrafico === 'step',
                pointBackgroundColor: COR_TERCIARIA, // Cor clara do header/footer/configs para os pontos
                pointRadius: tipoGrafico === 'step' ? 4 : 0, // Pontos visíveis apenas na linha
                tension: 0.4, // Suaviza a linha (ignorado se stepped=true)
            }]
        },
        options: {
            responsive: true,
            // Mantém a proporção apenas se não for step line (para evitar alongamento excessivo)
            maintainAspectRatio: tipoGrafico === 'bar', 
            scales: {
                y: {
                    min: 0, 
                    max: 100, 
                    title: {
                        display: true, 
                        text: 'Percentual (%)', 
                        font: {family: 'Montserrat', size: 14}
                    },
                    // Grade vertical mais suave
                    grid: { borderColor: COR_GRID }
                },
                x: {
                    title: {
                        display: true, 
                        text: 'Hora', 
                        font: {family: 'Montserrat', size: 14}
                    },
                    grid: { display: false } // Sem grid vertical para barras
                }
            },
            plugins: {
                legend: {display: false},
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y + '%';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });

    atualizarInfoFixa();
}

// --- Lógica unificada para Alterar tipo de gráfico ---
function configurarBotoesTipoGrafico(botoes) {
    botoes.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const novoTipo = e.currentTarget.dataset.tipo;
            
            // Remove a classe 'active' de TODOS os botões, tanto desktop quanto mobile
            document.querySelectorAll('[data-tipo]').forEach(b => b.classList.remove('active'));
            
            // Adiciona a classe 'active' apenas aos botões que foram clicados (e o seu par)
            document.querySelectorAll(`[data-tipo="${novoTipo}"]`).forEach(b => b.classList.add('active'));
            
            tipoGrafico = novoTipo;
            atualizarGrafico();

            // Lógica para fechar a sidebar mobile APÓS a seleção
            if (side && side.classList.contains('show')) {
                side.classList.remove('show');
            }
        });
    });
}

// --- Export CSV ---
function exportarCSV() {
    if(datas.length === 0) {
        alert("Não há dados para exportar.");
        return;
    }
    let csv = "created_at,value\n";
    const diaSelecionado = selectDiaDesktop.value;
    
    datas.forEach((d, i) => { 
        // Formato ISO para precisão na exportação
        csv += `${d.toISOString()},${valores[i]}\n`; 
    });
    
    const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = `dados_lixeira_${diaSelecionado.replace(/\//g, '-')}.csv`;
    a.click();
    URL.revokeObjectURL(a.href);
}

// --- Eventos e Sincronização ---

// 1. Sincroniza e Carrega Dados ao mudar o select (Desktop -> Mobile)
selectDiaDesktop.addEventListener('change', () => {
    selectDiaMobile.value = selectDiaDesktop.value;
    carregarDados(selectDiaDesktop.value);
});

// 2. Sincroniza e Carrega Dados ao mudar o select (Mobile -> Desktop)
selectDiaMobile.addEventListener('change', () => {
    const novoDia = selectDiaMobile.value;
    selectDiaDesktop.value = novoDia;
    carregarDados(novoDia);
    
    // Fecha a sidebar mobile após mudar o dia
    if (side && side.classList.contains('show')) {
        side.classList.remove('show');
    }
});

// 3. Botões de Tipo de Gráfico
configurarBotoesTipoGrafico(btnsTipoGraficoDesktop);
configurarBotoesTipoGrafico(btnsTipoGraficoMobile);

// 4. Botões de CSV
btnCSVDesktop.addEventListener('click', exportarCSV);
btnCSVMobile.addEventListener('click', exportarCSV);

// --- Auto-refresh para o dia atual ---
setInterval(() => {
    const hoje = new Date().toLocaleDateString('pt-BR');
    // Verifica se o dia atual está selecionado e se o dia de hoje está na lista de dias (para evitar recarregar desnecessariamente)
    if(selectDiaDesktop.value === hoje && todosOsDias.includes(hoje)){
        carregarDados(hoje);
    }
}, 30000); // Aumentado para 30 segundos (melhor para API externa)


// --- Evento de Redimensionamento (Auto-Update) ---
let resizeTimeout;
window.addEventListener('resize', () => {
    // Limpa o timeout anterior para que a função só execute após o usuário parar de redimensionar
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        // Força uma re-renderização do gráfico para reavaliar as opções de aspecto
        atualizarGrafico();
    }, 250); // Atraso de 250ms
});


// --- Inicializa ---
carregarDias();

// --- Sidebar mobile ---
const mob = document.getElementById("btn-mobile-menu");
// 'side' e 'close' já estão no escopo global
mob.onclick = () => side.classList.add("show");
close.onclick = () => side.classList.remove("show");