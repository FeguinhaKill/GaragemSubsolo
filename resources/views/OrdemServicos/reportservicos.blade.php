<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Ordens de Serviço</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #111;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #1D9E75;
        }

        .header h1 { font-size: 20px; font-weight: 700; color: #1D9E75; }
        .header p  { font-size: 12px; color: #6b7280; margin-top: 4px; }

        .header-right { text-align: right; font-size: 12px; color: #6b7280; }

        .resumo { display: flex; gap: 1rem; margin-bottom: 1.5rem; }

        .resumo-card {
            flex: 1;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .resumo-card p:first-child {
            font-size: 11px; color: #6b7280;
            text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px;
        }

        .resumo-card p:last-child { font-size: 16px; font-weight: 600; color: #111; }

        table { width: 100%; border-collapse: collapse; }

        thead tr { background-color: #f3f4f6; }

        th {
            text-align: left; padding: 8px 10px;
            font-size: 11px; text-transform: uppercase;
            letter-spacing: 0.04em; color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
        }

        td { padding: 8px 10px; border-bottom: 1px solid #e5e7eb; font-size: 12px; }

        tr:last-child td { border-bottom: none; }

        .badge {
            display: inline-block; padding: 2px 8px;
            border-radius: 4px; font-size: 11px; font-weight: 500;
        }

        .badge-aberta   { background: #D1FAE5; color: #065F46; }
        .badge-fechada  { background: #FEF3C7; color: #92400E; }
        .badge-atrasado { background: #FEE2E2; color: #991B1B; }
        .badge-outro    { background: #F3F4F6; color: #374151; }

        .total-row td { font-weight: 600; background: #f9fafb; }

        .footer {
            margin-top: 2rem; padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            font-size: 11px; color: #9ca3af;
            display: flex; justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="header">
        <div>
            <h1>Garage Subsolo</h1>
            <p>Relatório de Ordens de Serviço</p>
        </div>
        <div class="header-right">
            <p>Gerado em {{ now()->format('d/m/Y H:i') }}</p>
            <p>Total de registros: {{ $ordens->count() }}</p>
        </div>
    </div>

    @php
        $totalGeral   = $ordens->sum('valor_total');
        $totalAbertas = $ordens->where('status', 'aberta')->count();
        $totalFechadas = $ordens->where('status', 'fechada')->count();
        $totalAtrasadas = $ordens->where('status', 'atrasado')->count();
    @endphp

    <div class="resumo">
        <div class="resumo-card">
            <p>Valor Total Geral</p>
            <p>R$ {{ number_format($totalGeral, 2, ',', '.') }}</p>
        </div>
        <div class="resumo-card">
            <p>Abertas</p>
            <p style="color: #065F46;">{{ $totalAbertas }}</p>
        </div>
        <div class="resumo-card">
            <p>Fechadas</p>
            <p style="color: #92400E;">{{ $totalFechadas }}</p>
        </div>
        <div class="resumo-card">
            <p>Atrasadas</p>
            <p style="color: #991B1B;">{{ $totalAtrasadas }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Usuário</th>
                <th>Funcionário</th>
                <th>Data Abertura</th>
                <th>Data Fechamento</th>
                <th>Status</th>
                <th>Valor Total</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordens as $item)
                <tr>
                    <td>{{ $loop->iteration }}º</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->usuario->nome ?? '-' }}</td>
                    <td>{{ $item->funcionario->usuario->nome ?? '-' }}</td>
                    <td>{{ $item->data_abertura ? $item->data_abertura->format('d/m/Y') : '-' }}</td>
                    <td>{{ $item->data_fechamento ? $item->data_fechamento->format('d/m/Y') : '-' }}</td>
                    <td>
                        @if($item->status === 'aberta')
                            <span class="badge badge-aberta">Aberta</span>
                        @elseif($item->status === 'fechada')
                            <span class="badge badge-fechada">Fechada</span>
                        @elseif($item->status === 'atrasado')
                            <span class="badge badge-atrasado">Atrasado</span>
                        @else
                            <span class="badge badge-outro">{{ ucfirst($item->status) }}</span>
                        @endif
                    </td>
                    <td><strong>R$ {{ number_format($item->valor_total, 2, ',', '.') }}</strong></td>
                    <td style="max-width: 200px; color: #6b7280;">
                        {{ \Illuminate\Support\Str::limit($item->descricao, 60) }}
                    </td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="7" style="text-align: right;">Total Geral</td>
                <td>R$ {{ number_format($totalGeral, 2, ',', '.') }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <span>Garage Subsolo — Sistema de Aluguel de Bicicletas</span>
        <span>{{ now()->format('d/m/Y') }}</span>
    </div>

</body>
</html>
