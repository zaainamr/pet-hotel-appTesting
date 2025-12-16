<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'type', 'capacity', 'rate_per_day', 'status', 'notes', 'image'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function updateStatusBasedOnBookings()
    {
        if ($this->status === 'maintenance') {
            return; // Don't change status if under maintenance
        }

        $confirmedBookingsCount = $this->bookings()->where('status', 'confirmed')->count();

        if ($confirmedBookingsCount >= $this->capacity) {
            $this->status = 'penuh';
        } elseif ($confirmedBookingsCount > 0) {
            $this->status = 'occupied';
        } else {
            $this->status = 'available';
        }

        $this->save();
    }
}
