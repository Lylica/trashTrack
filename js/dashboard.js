// =========================================
// VARIÁVEIS DE ESTADO E CONFIGURAÇÃO
// =========================================
const canalId = 3062564;
let chart = null; // Inicializado como null
let valores = [];
let datas = [];
let tipoGrafico = 'bar'; // Tipo inicial de gráfico
let todosOsDias = []; // Armazena todos os dias únicos carregados
const AUTO_REFRESH_INTERVAL = 30000; // 30 segundos

// Referências DOM (Inicializadas em init())
let chartCtx = null;
let dataTitulo = null;
let selectDiaDesktop = null;
let selectDiaMobile = null;
let side = null; // Sidebar Mobile

// =========================================
// FUNÇÕES AUXILIARES
// =========================================

/**
 * Lê variáveis CSS para uso no JavaScript (e.g., para Chart.js).
 * @param {string} nome O nome da variável CSS (ex: '--cor-destaque').
 * @returns {string} O valor da variável CSS.
 */
const lerVariavelCSS = (nome) => {
    // Tenta ler a variável. O trim() remove espaços em branco.
    return getComputedStyle(document.documentElement).getPropertyValue(nome).trim();
};

/**
 * Sincroniza o valor entre os selects de desktop e mobile e carrega os dados.
 * @param {HTMLSelectElement} origem O select que disparou a mudança.
 * @param {HTMLSelectElement} destino O select que deve ser atualizado.
 * @param {boolean} fecharSidebar Indica se a sidebar deve ser fechada (true para mobile).
 */
const sincronizarEcarregarDados = async (origem, destino, fecharSidebar = false) => {
    const novoDia = origem.value;
    destino.value = novoDia;
    await carregarDados(novoDia);
    
    // Fecha a sidebar mobile APÓS a seleção, se for o caso
    if (fecharSidebar && side && side.classList.contains('show')) {
        side.classList.remove('show');
    }
};

/**
 * Configura os event listeners para os botões de tipo de gráfico e sincroniza estados.
 * @param {NodeListOf<Element>} botoes Coleção de botões.
 */
const configurarBotoesTipoGrafico = (botoes) => {
    if (!botoes) return;

    botoes.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const novoTipo = e.currentTarget.dataset.tipo;
            
            // Remove a classe 'active' de TODOS os botões
            document.querySelectorAll('[data-tipo]').forEach(b => b.classList.remove('active'));
            
            // Adiciona a classe 'active' ao botão clicado e ao seu par (desktop/mobile)
            document.querySelectorAll(`[data-tipo="${novoTipo}"]`).forEach(b => b.classList.add('active'));
            
            tipoGrafico = novoTipo;
            atualizarGrafico();

            // Fecha a sidebar mobile APÓS a seleção
            if (side && side.classList.contains('show')) {
                side.classList.remove('show');
            }
        });
    });
};


// =========================================
// FUNÇÕES DE DADOS E LÓGICA
// =========================================

/**
 * Carrega todos os dias com dados disponíveis e popula os seletores de dia.
 */
const carregarDias = async () => {
    if (!selectDiaDesktop || !selectDiaMobile) return;

    try {
        // Tenta pegar mais resultados para cobrir o máximo de dias possível
        const res = await fetch(`https://api.thingspeak.com/channels/${canalId}/feeds.json?results=800`);
        const data = await res.json();

        // Extrai e filtra dias válidos
        const dias = data.feeds
            .filter(f => f.field1 !== null && f.field1 !== "")
            .map(f => new Date(f.created_at).toLocaleDateString('pt-BR')); 

        todosOsDias = [...new Set(dias)];

        // Ordena os dias (do mais antigo para o mais recente)
        todosOsDias.sort((a, b) => { 
            // Converte DD/MM/AAAA para objeto Date para comparação
            const [da, ma, aa] = a.split('/').map(Number);
            const [db, mb, ab] = b.split('/').map(Number);
            return new Date(aa, ma - 1, da).getTime() - new Date(ab, mb - 1, db).getTime();
        });

        // Limpa e popula ambos os selects
        selectDiaDesktop.innerHTML = '';
        selectDiaMobile.innerHTML = '';
        
        todosOsDias.forEach(d => {
            const optDesktop = document.createElement('option');
            optDesktop.value = d;
            optDesktop.text = d;
            
            selectDiaDesktop.appendChild(optDesktop);
            // Usar cloneNode(true) é mais limpo que criar um novo option do zero
            selectDiaMobile.appendChild(optDesktop.cloneNode(true)); 
        });

        if(todosOsDias.length > 0){
            // Seleciona o dia mais recente
            const diaMaisRecente = todosOsDias[todosOsDias.length - 1];
            selectDiaDesktop.value = diaMaisRecente;
            selectDiaMobile.value = diaMaisRecente;
            await carregarDados(diaMaisRecente);
        } else {
             // Caso não haja dados
            if (dataTitulo) dataTitulo.innerText = "Nível da Lixeira (Nenhum dado disponível)";
            // Adiciona a option para informar a falta de dados
            const optVazio = '<option disabled selected>Nenhum dia disponível</option>';
            if (selectDiaDesktop) selectDiaDesktop.innerHTML = optVazio;
            if (selectDiaMobile) selectDiaMobile.innerHTML = optVazio;
            atualizarGrafico(); // Atualiza o bloco info para 'Sem dados'
        }
    } catch(err) {
        console.error("Erro ao carregar dias:", err);
        if (dataTitulo) dataTitulo.innerText = "Erro: Falha ao carregar dias disponíveis.";
        const optErro = '<option disabled selected>Erro ao carregar</option>';
        if (selectDiaDesktop) selectDiaDesktop.innerHTML = optErro;
        if (selectDiaMobile) selectDiaMobile.innerHTML = optErro;
    }
};

/**
 * Carrega dados de nível do ThingSpeak para o dia selecionado.
 * @param {string} diaSelecionado O dia no formato 'DD/MM/AAAA' a ser carregado.
 */
const carregarDados = async (diaSelecionado) => {
    if (!dataTitulo || !chartCtx) return;

    try {
        // Se for o dia atual, buscamos menos resultados (mais recente) para performance
        const hoje = new Date().toLocaleDateString('pt-BR');
        const resultsCount = (hoje === diaSelecionado) ? 150 : 800;
        
        const res = await fetch(`https://api.thingspeak.com/channels/${canalId}/fields/1.json?results=${resultsCount}`);
        const data = await res.json();

        // Limpa os arrays globais
        valores = [];
        datas = [];

        // Filtra e armazena apenas o último valor de cada horário único no dia
        const horarioMap = new Map();
        data.feeds.forEach(f => {
            const valorField = f.field1;
            if(valorField === null || valorField === "") return;

            const d = new Date(f.created_at);
            
            if(d.toLocaleDateString('pt-BR') === diaSelecionado){
                const hora = d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
                // Armazena o timestamp completo e o valor
                horarioMap.set(hora, {data: d, valor: Number(valorField)});
            }
        });

        // Ordena pelo timestamp completo (precisão)
        const sorted = [...horarioMap.entries()].sort((a, b) => a[1].data.getTime() - b[1].data.getTime());

        // Mapeia para os arrays globais
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
        dataTitulo.innerText = `Erro ao carregar dados do dia: ${diaSelecionado}`;
        atualizarGrafico(); // Atualiza o gráfico/info bloco com dados vazios
    }
};

/**
 * Atualiza os blocos de informação (Nível Atual, Última Atualização, Status).
 */
const atualizarInfoFixa = () => {
    const nivelAtualElement = document.getElementById('nivel-atual');
    const ultimaAtualizacaoElement = document.getElementById('ultima-atualizacao');
    const statusLixeiraElement = document.getElementById('status-lixeira');

    if (!nivelAtualElement || !ultimaAtualizacaoElement || !statusLixeiraElement) return;

    // Reset de classes
    statusLixeiraElement.classList.remove('status-cheio', 'status-normal', 'status-vazio');

    // Se não houver dados
    if(valores.length === 0) {
        nivelAtualElement.innerHTML = '<strong>0%</strong>';
        ultimaAtualizacaoElement.innerHTML = '<strong>--:--</strong>';
        statusLixeiraElement.classList.add('status-vazio');
        statusLixeiraElement.innerText = 'Sem dados';
        return;
    }
    
    const i = valores.length - 1;
    const valor = valores[i];
    const data = datas[i];

    nivelAtualElement.innerHTML = `<strong>${valor}%</strong>`;
    ultimaAtualizacaoElement.innerHTML = `<strong>${data.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</strong>`;

    let status = 'Normal';
    
    if (valor <= 20) {
        status = 'Vazio';
        statusLixeiraElement.classList.add('status-vazio');
    } else if (valor >= 80) {
        status = 'Cheio';
        statusLixeiraElement.classList.add('status-cheio'); 
    } else {
        statusLixeiraElement.classList.add('status-normal'); 
    }
    
    statusLixeiraElement.innerText = status;
};

/**
 * Destrói e recria o gráfico Chart.js com os dados e tipo selecionados.
 */
const atualizarGrafico = () => {
    if (!chartCtx) return;

    if(chart) chart.destroy();
    
    // Se não há dados, apenas atualiza as informações fixas e sai
    if(valores.length === 0) {
        atualizarInfoFixa();
        return;
    }

    // Leitura das variáveis CSS para cores e fontes
    const COR_DESTAQUE = lerVariavelCSS('--cor-destaque'); 
    const COR_PONTO = lerVariavelCSS('--cor-neutra-clara'); 
    const COR_GRID_BORDER = lerVariavelCSS('--cor-primaria-escura');
    const COR_DESTAQUE_RGB_VALUE = lerVariavelCSS('--cor-primaria-escura-rgb'); 
    const COR_DESTAQUE_SUAVE = `rgba(${COR_DESTAQUE_RGB_VALUE}, 0.2)`; 
    const FONT_FAMILY = lerVariavelCSS('--fonte-principal').replace(/'/g, '').split(',')[0].trim(); // Pega apenas 'Montserrat'

    const labels = datas.map(d => d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}));
    
    chart = new Chart(chartCtx, {
        type: tipoGrafico === 'step' ? 'line' : 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nível (%)',
                data: valores,
                backgroundColor: tipoGrafico === 'bar' ? COR_DESTAQUE : COR_DESTAQUE_SUAVE, 
                borderColor: COR_DESTAQUE,
                borderWidth: tipoGrafico === 'step' ? 3 : 1,
                fill: tipoGrafico === 'step' ? 'origin' : false, 
                stepped: tipoGrafico === 'step',
                pointBackgroundColor: COR_PONTO, 
                pointBorderColor: COR_DESTAQUE,
                pointRadius: tipoGrafico === 'step' ? 4 : 0, 
                tension: 0.4, 
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: tipoGrafico === 'bar', // Mantém a proporção apenas se for 'bar'
            scales: {
                y: {
                    min: 0, 
                    max: 100, 
                    title: {
                        display: true, 
                        text: 'Percentual (%)', 
                        font: {family: FONT_FAMILY, size: 14}
                    },
                    grid: { 
                        borderColor: COR_GRID_BORDER, 
                        drawOnChartArea: true, 
                        drawTicks: false,
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        font: {family: FONT_FAMILY}
                    }
                },
                x: {
                    title: {
                        display: true, 
                        text: 'Hora', 
                        font: {family: FONT_FAMILY, size: 14}
                    },
                    grid: { display: false },
                    ticks: {
                        font: {family: FONT_FAMILY}
                    }
                }
            },
            plugins: {
                legend: {display: false},
                tooltip: {
                    titleFont: { family: FONT_FAMILY },
                    bodyFont: { family: FONT_FAMILY },
                    callbacks: {
                        label: (context) => {
                            let label = context.dataset.label || '';
                            if (label) label += ': ';
                            if (context.parsed.y !== null) label += context.parsed.y + '%';
                            return label;
                        }
                    }
                }
            }
        }
    });

    atualizarInfoFixa();
};

/**
 * Exporta os dados atualmente carregados para um arquivo CSV.
 */
const exportarCSV = () => {
    if(datas.length === 0) {
        dataTitulo.innerText = "ATENÇÃO: Não há dados para exportar no dia selecionado.";
        setTimeout(() => {
            const diaSelecionado = selectDiaDesktop ? selectDiaDesktop.value : 'Nível da Lixeira';
            dataTitulo.innerText = `Nível da Lixeira em ${diaSelecionado}`;
        }, 3000);
        return;
    }
    let csv = "created_at,value\n";
    const diaSelecionado = selectDiaDesktop ? selectDiaDesktop.value : 'dados';
    
    datas.forEach((d, i) => { 
        csv += `${d.toISOString()},${valores[i]}\n`; 
    });
    
    const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = `dados_lixeira_${diaSelecionado.replace(/\//g, '-')}.csv`;
    a.click();
    URL.revokeObjectURL(a.href);
};


// =========================================
// INICIALIZAÇÃO
// =========================================

/**
 * Função principal de inicialização, chamada após o carregamento completo do DOM.
 */
const init = () => {
    // 1. Acesso e Checagem de Elementos Críticos (Atribuição a Globais)
    const chartElement = document.getElementById('chart');
    const close = document.getElementById("close-sidebar");
    const mob = document.getElementById("btn-mobile-menu");

    if (!chartElement || typeof Chart === 'undefined') {
        console.error("Canvas 'chart' não encontrado ou Chart.js não carregado.");
        return;
    }
    
    chartCtx = chartElement.getContext('2d');
    dataTitulo = document.getElementById('data-titulo');
    selectDiaDesktop = document.getElementById('selecionar-dia');
    selectDiaMobile = document.getElementById('selecionar-dia-mobile');
    side = document.getElementById("sidebar-mobile"); 
    
    const btnCSVDesktop = document.getElementById('btnCSV');
    const btnsTipoGraficoDesktop = document.querySelectorAll('.barra-lateral .btn-group [data-tipo]');
    const btnCSVMobile = document.getElementById('btnCSV-mobile');
    const btnsTipoGraficoMobile = document.querySelectorAll('.sidebar-mobile .btn-group [data-tipo]');

    // 2. Event Listeners de Sincronização de Data (DRY: Usando a função unificada)
    if(selectDiaDesktop && selectDiaMobile) {
        selectDiaDesktop.addEventListener('change', () => 
            sincronizarEcarregarDados(selectDiaDesktop, selectDiaMobile, false)
        );
        selectDiaMobile.addEventListener('change', () => 
            sincronizarEcarregarDados(selectDiaMobile, selectDiaDesktop, true) // Fecha a sidebar
        );
    }

    // 3. Event Listeners para Tipo de Gráfico e CSV
    configurarBotoesTipoGrafico(btnsTipoGraficoDesktop);
    configurarBotoesTipoGrafico(btnsTipoGraficoMobile);

    if(btnCSVDesktop) btnCSVDesktop.addEventListener('click', exportarCSV);
    if(btnCSVMobile) btnCSVMobile.addEventListener('click', exportarCSV);

    // 4. Lógica da Sidebar Mobile
    if (mob && side && close) {
        mob.onclick = () => side.classList.add("show");
        close.onclick = () => side.classList.remove("show");
        // Fechar a sidebar clicando fora (opcional, mas bom para UX)
        // document.addEventListener('click', (e) => {
        //     if (side.classList.contains('show') && !side.contains(e.target) && !mob.contains(e.target)) {
        //         side.classList.remove('show');
        //     }
        // });
    }

    // 5. Auto-refresh (30 segundos)
    setInterval(() => {
        const hoje = new Date().toLocaleDateString('pt-BR');
        // Só recarrega se o dia atual estiver selecionado E for um dos dias disponíveis
        if(selectDiaDesktop && selectDiaDesktop.value === hoje && todosOsDias.includes(hoje)){
            carregarDados(hoje);
        }
    }, AUTO_REFRESH_INTERVAL); 

    // 6. Redimensionamento
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(atualizarGrafico, 250); // Debounce
    });

    // 7. Carga Inicial de Dados
    carregarDias();
};

// Inicia o aplicativo após o carregamento completo do DOM
window.addEventListener('load', init);