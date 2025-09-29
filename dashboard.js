const canalId = 3062564;
let chart;
let valores = [];
let datas = [];
let tipoGrafico = 'bar';

const chartCtx = document.getElementById('chart').getContext('2d');
const nivelLixeira = document.getElementById('nivel');
const percentual = document.getElementById('percentual');
const dataTitulo = document.getElementById('data-titulo');
const selectDia = document.getElementById('selecionar-dia');

// --- Carrega dias disponíveis ---
async function carregarDias() {
    try {
        const res = await fetch(`https://api.thingspeak.com/channels/${canalId}/feeds.json?results=800`);
        const data = await res.json();

        const dias = data.feeds
            .filter(f => f.field1 !== null && f.field1 !== "")
            .map(f => new Date(f.created_at).toLocaleDateString());

        const diasUnicos = [...new Set(dias)];

        selectDia.innerHTML = '';
        diasUnicos.forEach(d => {
            const opt = document.createElement('option');
            opt.value = d;
            opt.text = d;
            selectDia.appendChild(opt);
        });

        if(diasUnicos.length > 0){
            selectDia.value = diasUnicos[diasUnicos.length - 1];
            carregarDados(selectDia.value);
        }
    } catch(err) {
        alert("Erro ao carregar dias: " + err);
    }
}

// --- Carrega dados do dia selecionado ---
async function carregarDados(diaSelecionado) {
    try {
        const res = await fetch(`https://api.thingspeak.com/channels/${canalId}/fields/1.json?results=800`);
        const data = await res.json();

        valores = [];
        datas = [];

        // Map para horários únicos (mantém último valor por hora)
        const horarioMap = new Map();
        data.feeds.forEach(f => {
            if(f.field1 === null || f.field1 === "") return;
            const d = new Date(f.created_at);
            if(d.toLocaleDateString() === diaSelecionado){
                const hora = d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
                horarioMap.set(hora, {data:d, valor:Number(f.field1)});
            }
        });

        // Ordena por hora
        const sorted = [...horarioMap.entries()].sort((a,b) => a[1].data - b[1].data);

        datas = sorted.map(e => e[1].data);
        valores = sorted.map(e => e[1].valor);

        if(datas.length > 0) dataTitulo.innerText = diaSelecionado;

        atualizarGrafico();
    } catch(err) {
        alert("Erro ao carregar dados: " + err);
    }
}

// --- Atualiza informações fixas da lixeira (último valor real do dia) ---
function atualizarInfoFixa() {
    if(valores.length === 0) return;
    const i = valores.length - 1;
    const valor = valores[i];
    const data = datas[i];

    nivelLixeira.style.height = valor + '%';
    percentual.innerText = valor + '%';
    document.getElementById('nivel-atual').innerText = valor + '%';
    document.getElementById('ultima-atualizacao').innerText = data.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});

    let status = valor <= 20 ? 'Vazio' : valor >= 80 ? 'Cheio' : 'Normal';
    document.getElementById('status-lixeira').innerText = status;
}

// --- Atualiza gráfico ---
function atualizarGrafico() {
    if(chart) chart.destroy();
    if(valores.length === 0) return;

    chart = new Chart(chartCtx, {
        type: tipoGrafico === 'step' ? 'line' : 'bar',
        data: {
            labels: datas.map(d => d.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})),
            datasets: [{
                label: 'Nível (%)',
                data: valores,
                backgroundColor: '#44633F',
                borderColor: '#3F4B3B',
                borderWidth: 1,
                fill: false,
                stepped: tipoGrafico === 'step',
                pointBackgroundColor: '#DCDABE',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            onHover: (evt, elements) => {
                if(elements.length > 0){
                    const index = elements[0].index;
                    // Apenas lixeira visual e percentual
                    const hoverValor = valores[index];
                    nivelLixeira.style.height = hoverValor + '%';
                    percentual.innerText = hoverValor + '%';
                } else {
                    // Volta para último valor fixo
                    atualizarInfoFixa();
                }
            },
            scales: {
                y: {min:0, max:100, title:{display:true,text:'Percentual (%)'}},
                x: {title:{display:true,text:'Hora'}}
            },
            plugins: {legend:{display:false}}
        }
    });

    // Mostra o último valor fixo do dia
    atualizarInfoFixa();
}

// --- Alterar tipo de gráfico ---
document.querySelectorAll('[data-tipo]').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        document.querySelectorAll('[data-tipo]').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        tipoGrafico = btn.dataset.tipo;
        atualizarGrafico();
    });
});

// --- Export CSV ---
document.getElementById('btnCSV').addEventListener('click', ()=>{
    if(datas.length === 0) return;
    let csv = "created_at,value\n";
    datas.forEach((d,i)=>{ csv += `${d.toISOString()},${valores[i]}\n`; });
    const blob = new Blob([csv], {type:'text/csv'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'dados_lixeira.csv';
    a.click();
    URL.revokeObjectURL(a.href);
});

// --- Evento select ---
selectDia.addEventListener('change', ()=> carregarDados(selectDia.value));

// --- Auto-refresh para o dia atual ---
setInterval(() => {
    const hoje = new Date().toLocaleDateString();
    if(selectDia.value === hoje){
        carregarDados(hoje);
    }
}, 20000); // atualiza a cada 20 segundos

// --- Inicializa ---
carregarDias();
