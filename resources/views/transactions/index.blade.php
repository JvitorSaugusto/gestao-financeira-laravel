@extends('layouts.app')

@section('title', 'Painel Financeiro - FinTech Gold')

@section('content')
<!-- Dashboard de Resumo Financeiro -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small fw-semibold">RECEITAS DO MÊS</span>
                <div class="p-2 rounded-circle bg-income-subtle">
                    <i class="bi bi-arrow-down-left fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold text-income mt-2 mb-0">
                R$ {{ number_format($totalIncome ?? 0, 2, ',', '.') }}
            </h3>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small fw-semibold">DESPESAS DO MÊS</span>
                <div class="p-2 rounded-circle bg-expense-subtle">
                    <i class="bi bi-arrow-up-right fs-5"></i>
                </div>
            </div>
            <h3 class="fw-bold text-expense mt-2 mb-0">
                R$ {{ number_format($totalExpense ?? 0, 2, ',', '.') }}
            </h3>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small fw-semibold">SALDO LÍQUIDO</span>
                <div class="p-2 rounded-circle bg-dark border border-secondary">
                    <i class="bi bi-bank fs-5 text-gold"></i>
                </div>
            </div>
            <h3 class="fw-bold {{ ($balance ?? 0) >= 0 ? 'text-income' : 'text-expense' }} mt-2 mb-0">
                R$ {{ number_format($balance ?? 0, 2, ',', '.') }}
            </h3>
        </div>
    </div>
</div>

<!-- Filtros de Mês, Ano e Tipo -->
<div class="card card-custom p-3 mb-4">
    <form action="{{ route('transactions.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Mês</label>
            <select name="month" class="form-select form-select-sm">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ sprintf('%02d', $m) }}" {{ request('month', date('m')) == sprintf('%02d', $m) ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Ano</label>
            <select name="year" class="form-select form-select-sm">
                @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label small text-muted mb-1">Tipo</label>
            <select name="type" class="form-select form-select-sm">
                <option value="">Todos os Tipos</option>
                <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Receita</option>
                <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Despesa</option>
            </select>
        </div>
        
        <div class="col-md-3 d-flex gap-2 align-self-end">
            <button type="submit" class="btn btn-gold btn-sm w-100">
                <i class="bi bi-filter me-1"></i> Filtrar
            </button>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm" title="Limpar Filtros">
                <i class="bi bi-x-lg"></i>
            </a>
        </div>
    </form>
</div>

<!-- Tabela de Extrato -->
<div class="card card-custom overflow-hidden">
    <div class="table-responsive">
        <table class="table table-dark-custom align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Data</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th class="text-end pe-4">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="ps-4 text-muted small">
                            {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}
                        </td>
                        <td class="fw-semibold">{{ $transaction->description }}</td>
                        <td>
                            <span class="badge bg-dark border border-secondary text-light">
                                {{ $transaction->category->name ?? 'Sem Categoria' }}
                            </span>
                        </td>
                        <td>
                            @if($transaction->type === 'income')
                                <span class="badge bg-income-subtle px-2 py-1">Receita</span>
                            @else
                                <span class="badge bg-expense-subtle px-2 py-1">Despesa</span>
                            @endif
                        </td>
                        <td class="fw-bold {{ $transaction->type === 'income' ? 'text-income' : 'text-expense' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-outline-secondary" title="Editar">
                                    <i class="bi bi-pencil text-gold"></i>
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Excluir" onclick="return confirm('Deseja realmente remover este lançamento?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            Nenhum lançamento encontrado para o período selecionado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($transactions->hasPages())
        <div class="card-footer bg-transparent border-top border-secondary py-3">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
@endsection