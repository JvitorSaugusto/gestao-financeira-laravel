@extends('layouts.app')

@section('title', 'Novo Lançamento - FinTech Gold')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-gold mb-0">Cadastrar Lançamento</h3>
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>

        <div class="card card-custom p-4">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Descrição <span class="text-gold">*</span></label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="Ex: Pagamento de Fornecedor X">
                        @error('description') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="type" class="form-label fw-semibold">Tipo de Lançamento <span class="text-gold">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Receita (+)</option>
                            <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Despesa (-)</option>
                        </select>
                        @error('type') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-semibold">Categoria <span class="text-gold">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                            <option value="" selected disabled>Selecione a categoria...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->type === 'income' ? 'Receita' : 'Despesa' }})
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="amount" class="form-label fw-semibold">Valor (R$) <span class="text-gold">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="0.00">
                        @error('amount') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="date" class="form-label fw-semibold">Data <span class="text-gold">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                        @error('date') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 text-end pt-3">
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-gold px-4">
                            <i class="bi bi-check-lg me-1"></i> Salvar Lançamento
                        </button>
                    </div>

                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection