<?php

namespace Tests\Feature;

use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecetaTest extends TestCase
{
    use RefreshDatabase;

    public function test_se_puede_instanciar_y_asociar_una_receta_con_sus_ingredientes()
    {
        $harina = Ingrediente::create(['nombre' => 'Harina de trigo']);
        $azucar = Ingrediente::create(['nombre' => 'Azúcar']);

        $receta = Receta::create([
            'titulo' => 'Panqueques caseros',
            'porciones' => 4,
            'instrucciones' => 'Mezclar los ingredientes secos, añadir líquidos y cocinar a fuego medio.'
        ]);

        $receta->ingredientes()->attach([
            $harina->id => ['cantidad' => 2.0, 'unidad_medida' => 'tazas'],
            $azucar->id => ['cantidad' => 0.5, 'unidad_medida' => 'tazas'],
        ]);

        $this->assertEquals('Panqueques caseros', $receta->titulo);
        $this->assertCount(2, $receta->ingredientes);

        $this->assertDatabaseHas('receta_ingrediente', [
            'receta_id' => $receta->id,
            'ingrediente_id' => $harina->id,
            'cantidad' => 2.0,
            'unidad_medida' => 'tazas',
        ]);
    }
}
