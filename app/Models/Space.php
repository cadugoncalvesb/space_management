<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Space extends Model
{
    use LogsActivity;
    protected $fillable = [
      'local_id',
      'name',
      'type',
      'capacity',
      'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Registra todas as colunas (outra opção: logOnly(['name', ...]))
            ->logOnlyDirty() // Só registra se algo realmente for alterado
            ->dontLogEmptyChanges() // Bloqueia logs vazios
            ->setDescriptionForEvent(fn(string $eventName) => "Espaço foi {$eventName}"); // Traduz o evento: created = criado, updated = atualizado, deleted = deletado
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class)->withPivot('quantity')->withTimestamps();
    }
}
