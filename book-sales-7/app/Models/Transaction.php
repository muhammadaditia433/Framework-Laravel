<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['order_number', 'customer_id', 'book_id', 'total_amount'];

    // Relasi: satu transaksi dimiliki oleh satu customer (tabel users)
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi: satu transaksi untuk satu buku
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
