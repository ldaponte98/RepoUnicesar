<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerceroGrupo extends Model
{
    protected $table = 'tercero_grupo';
    protected $primaryKey = 'id_tercero_grupo';

    public function grupo()
	{
		return $this->belongsTo(Grupo::class, 'id_grupo');
	}

	public function tercero()
	{
	    return $this->belongsTo(Tercero::class, 'id_tercero');
	}
}
