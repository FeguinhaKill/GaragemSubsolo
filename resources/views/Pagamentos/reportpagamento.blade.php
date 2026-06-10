<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Pagamentos de Serviços</title>
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

        .header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1D9E75;
        }

        .header p {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .header-right {
            text-align: right;
            font-size: 12px;
            color: #6b7280;
        }

        .resumo {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .resumo-card {
            flex: 1;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .resumo-card p:first-child {
            font-size: 11px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }

        .resumo-card p:last-child {
            font-size: 16px;
            font-weight: 600;
            color: #111;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.5rem;
        }

        thead tr {
            background-color: #f3f4f6;
        }

        th {
            text-align: left;
            padding: 8px 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
        }

        tr:last-child td { border-bottom: none; }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-pago      { background: #D1FAE5; color: #065F46; }
        .badge-andamento { background: #FEF3C7; color: #92400E; }
        .badge-atrasado  { background: #FEE2E2; color: #991B1B; }
        .badge-outro     { background: #F3F4F6; color: #374151; }

        .footer {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            font-size: 11px;
            color: #9ca3af;
            display: flex;
            justify-content: space-between;
        }

        .total-row td {
            font-weight: 600;
            background: #f9fafb;
        }
    </style>
</head>

<body>

    <div class="header">
        <div>
            <h1>Garage Subsolo</h1>
            <p>Relatório de Pagamentos de Serviços</p>
        </div>
        <div class="header-right">
            <p>Gerado em {{ now()->format('d/m/Y H:i') }}</p>
            <p>Total de registros: {{ $pagamento->count() }}</p>
        </div>
    </div>

    {{-- resumo --}}
    @php
        $totalBruto = $pagamento->sum('valor_bruto');
        $totalLiquido = $pagamento->sum('valor_total');
        $totalPago = $pagamento->where('status', 'pago')->sum('valor_total');
        $totalPendente = $pagamento->whereIn('status', ['pendente', 'em_andamento', 'atrasado'])->sum('valor_total');
    @endphp

    <div class="resumo">
        <div class="resumo-card">
            <p>Total Bruto</p>
            <p>R$ {{ number_format($totalBruto, 2, ',', '.') }}</p>
        </div>
        <div class="resumo-card">
            <p>Total Líquido</p>
            <p>R$ {{ number_format($totalLiquido, 2, ',', '.') }}</p>
        </div>
        <div class="resumo-card">
            <p>Total Pago</p>
            <p style="color: #065F46;">R$ {{ number_format($totalPago, 2, ',', '.') }}</p>
        </div>
        <div class="resumo-card">
            <p>Total Pendente</p>
            <p style="color: #991B1B;">R$ {{ number_format($totalPendente, 2, ',', '.') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>OS</th>
                <th>Usuário</th>
                <th>Forma Pagamento</th>
                <th>Valor Bruto</th>
                <th>Valor Total</th>
                <th>Status</th>
                <th>Vencimento</th>
                <th>Pago em</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagamento as $item)
                <tr>
                    <td>{{ $loop->iteration }}º</td>
                    <td>{{ $item->id }}</td>
                    <td>OS #{{ $item->ordemServico->id ?? '-' }}</td>
                    <td>{{ $item->usuario->nome ?? '-' }}</td>
                    <td>{{ $item->formaPagamento->nome ?? '-' }}</td>
                    <td>R$ {{ number_format($item->valor_bruto, 2, ',', '.') }}</td>
                    <td><strong>R$ {{ number_format($item->valor_total, 2, ',', '.') }}</strong></td>
                    <td>
                        @if($item->status === 'pago')
                            <span class="badge badge-pago">Pago</span>
                        @elseif($item->status === 'em_andamento')
                            <span class="badge badge-andamento">Em Andamento</span>
                        @elseif($item->status === 'atrasado')
                            <span class="badge badge-atrasado">Atrasado</span>
                        @else
                            <span class="badge badge-outro">{{ ucfirst($item->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $item->data_vencimento ? \Carbon\Carbon::parse($item->data_vencimento)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $item->data_pago ? \Carbon\Carbon::parse($item->data_pago)->format('d/m/Y H:i') : '-' }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="6" style="text-align: right;">Total Geral</td>
                <td>R$ {{ number_format($totalLiquido, 2, ',', '.') }}</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <span>Garage Subsolo —</span>
        <span>{{ now()->format('d/m/Y') }}</span>
    </div>

</body>
</html>
