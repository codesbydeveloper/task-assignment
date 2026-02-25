<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class TransactionService
{
    public function processTransaction(User $user, array $data): Transaction
    {
        return DB::transaction(function () use ($user, $data) {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'amount' => $data['amount'],
                'currency' => $data['currency'] ?? 'USD',
                'status' => 'pending',
                'reference' => $data['reference'] ?? null,
                'meta' => $data['meta'] ?? null,
            ]);

            // Placeholder for additional business rules, external calls, etc.

            $transaction->status = 'completed';
            $transaction->save();

            Log::info('Transaction processed', ['transaction_id' => $transaction->id]);

            return $transaction;
        });
    }

    public function handleRollback(Transaction $transaction, ?Throwable $exception = null): void
    {
        DB::transaction(function () use ($transaction, $exception) {
            $transaction->status = 'rolled_back';
            $transaction->save();

            Log::warning('Transaction rolled back', [
                'transaction_id' => $transaction->id,
                'exception' => $exception?->getMessage(),
            ]);
        });
    }
}

