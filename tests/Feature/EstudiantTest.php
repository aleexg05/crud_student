<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pot_crear_un_estudiant()
    {
        $response = $this->post('/students', [
            'name' => 'Pau',
            'email' => 'pau@example.com',
            'address' => 'Carrer Major, 10',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('students', [
            'name' => 'Pau',
            'email' => 'pau@example.com',
            'address' => 'Carrer Major, 10',
        ]);
    }

    /** @test */
    public function pot_editar_un_estudiant()
    {
        $student = Student::factory()->create();

        $response = $this->put("/students/{$student->id}", [
            'name' => 'Clara',
            'email' => 'clara@example.com',
            'address' => 'Avinguda Catalunya, 25',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Clara',
            'email' => 'clara@example.com',
            'address' => 'Avinguda Catalunya, 25',
        ]);
    }

    /** @test */
    public function pot_eliminar_un_estudiant()
    {
        $student = Student::factory()->create();

        $response = $this->delete("/students/{$student->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]); 
    }
}
