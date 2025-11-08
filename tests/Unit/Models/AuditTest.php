<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_audit_log()
    {
        $user = User::factory()->create();
        
        $audit = Audit::create([
            'user_id' => $user->id,
            'action' => 'create',
            'auditable_type' => 'App\Models\Colaborador',
            'auditable_id' => 1,
            'event' => 'created',
            'old_values' => null,
            'new_values' => json_encode(['nome' => 'João Silva']),
        ]);

        $this->assertDatabaseHas('audits', [
            'user_id' => $user->id,
            'action' => 'create',
            'model_type' => 'App\Models\Colaborador',
            'model_id' => 1,
        ]);
    }

    /** @test */
    public function it_belongs_to_user()
    {
        $user = User::factory()->create();
        $audit = Audit::create([
            'user_id' => $user->id,
            'action' => 'create',
            'model_type' => 'App\Models\Colaborador',
            'model_id' => 1,
        ]);

        $this->assertInstanceOf(User::class, $audit->user);
        $this->assertEquals($user->id, $audit->user->id);
    }

    /** @test */
    public function it_stores_changes_correctly()
    {
        $user = User::factory()->create();
        $oldValues = ['nome' => 'João'];
        $newValues = ['nome' => 'João Silva'];
        
        $audit = Audit::create([
            'user_id' => $user->id,
            'action' => 'update',
            'model_type' => 'App\Models\Colaborador',
            'model_id' => 1,
            'old_values' => json_encode($oldValues),
            'new_values' => json_encode($newValues),
        ]);

        $this->assertEquals($oldValues, json_decode($audit->old_values, true));
        $this->assertEquals($newValues, json_decode($audit->new_values, true));
    }
}