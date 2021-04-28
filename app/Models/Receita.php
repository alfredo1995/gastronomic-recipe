<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;
    //$fillable os atributos preenchidos
    
    protected $table = 'receitas';
    protected $fillable=['receita', 'Cadastrar_Receita', 'user_id'];

   

    public function user() {
        //relacionamento de muitos pra um
        return $this->belongsTo(User::class);
    }
}
